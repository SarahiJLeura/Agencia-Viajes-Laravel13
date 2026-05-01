<?php

namespace App\Http\Controllers;

use App\Mail\ConfirmacionViaje;
use App\Models\Destino;
use App\Models\DetallesViaje;
use App\Models\Transporte;
use App\Models\Hospedaje;
use App\Models\Viaje;
use App\Services\TransporteApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ViajeController extends Controller
{
    protected $transporteApi;

    public function __construct(TransporteApiService $transporteApi)
    {
        $this->transporteApi = $transporteApi;
    }

    public function index()
    {
        $viajes = Viaje::where('user_id', Auth::id())
            ->with(['destino', 'hospedaje'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('cliente.viajes.index', compact('viajes'));
    }

    public function create()
    {
        $destinos = Destino::all();
        $transportes = $this->transporteApi->obtenerTransportes();
        
        return view('cliente.viajes.create', compact('destinos', 'transportes'));
    }

    public function indexAdmin()
    {
        $viajes = Viaje::with(['user', 'destino', 'hospedaje'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('admin.viajes.index', compact('viajes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'destino_id' => 'required|exists:destinos,id',
            'hospedaje_id' => 'required|exists:hospedajes,id',
            'transporte_id' => 'nullable|exists:transportes,id', // Ahora existe en BD
            'fecha_inicio' => 'required|date|after:today',
            'fecha_fin' => 'required|date|after:fecha_inicio',
            'cantidad_personas' => 'required|integer|min:1',
            'tipo_viaje' => 'required|string',
        ]);

        // Obtener precios
        $destino = Destino::find($request->destino_id);
        $hospedaje = Hospedaje::find($request->hospedaje_id);
        
        // Calcular precio
        $dias = now()->parse($request->fecha_inicio)->diffInDays($request->fecha_fin);
        $precioHospedaje = 100 * $dias * $request->cantidad_personas;
        
        // Obtener precio del transporte si se seleccionó
        $precioTransporte = 0;
        $transporteData = null;
        if ($request->transporte_id) {
            $transporte = Transporte::find($request->transporte_id);
            if ($transporte) {
                $precioTransporte = $transporte->tarifa_base > 0 ? $transporte->tarifa_base : 200;
                $transporteData = $transporte;
            }
        }
        
        $precioTotal = $precioHospedaje + $precioTransporte;

        $viaje = Viaje::create([
            'user_id' => Auth::id(),
            'destino_id' => $request->destino_id,
            'hospedaje_id' => $request->hospedaje_id,
            'transporte_id' => $request->transporte_id,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'cantidad_personas' => $request->cantidad_personas,
            'tipo_viaje' => $request->tipo_viaje,
            'precio_total' => $precioTotal,
        ]);

        // Crear detalles del viaje
        DetallesViaje::create([
            'viaje_id' => $viaje->id,
            'concepto' => 'Hospedaje: ' . $hospedaje->nombre,
            'costo' => $precioHospedaje,
        ]);
        
        if ($request->transporte_id && $transporteData) {
            DetallesViaje::create([
                'viaje_id' => $viaje->id,
                'concepto' => 'Transporte: ' . $transporteData->tipo . ' - ' . $transporteData->placa,
                'costo' => $precioTransporte,
            ]);
        }

        // Enviar correo con PDF
        try {
            $pdf = $this->generarPDF($viaje);
            Mail::to(Auth::user()->email)->send(new ConfirmacionViaje($viaje, $pdf));
            
            return redirect()->route('viajes.show', $viaje)
                ->with('success', '¡Viaje confirmado! Se ha enviado un correo con los detalles y PDF adjunto.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Hubo un problema al enviar el correo: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function show(Viaje $viaje)
    {
        if ($viaje->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }
        
        $viaje->load(['destino', 'hospedaje', 'detalles']);
        
        return view('cliente.viajes.show', compact('viaje'));
    }

    public function generarPDF($viaje)
    {
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.viaje', [
            'viaje' => $viaje,
            'user' => Auth::user(),
            'fecha' => now(),
        ]);
        
        $pdf->setPaper('a4', 'portrait');
        
        return $pdf;
    }

    public function descargarPDF(Viaje $viaje)
    {
        if ($viaje->user_id !== Auth::id() && !Auth::user()->isAdmin()) {
            abort(403);
        }
        
        $pdf = $this->generarPDF($viaje);
        return $pdf->download('viaje_' . $viaje->id . '.pdf');
    }
}