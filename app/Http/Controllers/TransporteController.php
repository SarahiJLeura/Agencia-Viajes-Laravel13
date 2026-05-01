<?php

namespace App\Http\Controllers;

use App\Models\Transporte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class TransporteController extends Controller
{   
    // Vista principal de gestión de transportes
    public function index()
    {
        $transportes = Transporte::paginate(15);
        return view('admin.transportes.index', compact('transportes'));
    }

    // Formulario para crear transporte
    public function create()
    {
        return view('admin.transportes.create');
    }

    // Guardar nuevo transporte
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipo' => 'required|string|in:Aéreo,Terrestre,Marítimo',
            'placa' => 'required|string|unique:transportes,placa',
            'capacidad' => 'required|integer|min:1|max:500',
            'modelo' => 'nullable|string|max:255',
            'activo' => 'boolean',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['activo'] = $request->has('activo');

        Transporte::create($data);

        return redirect()->route('admin.transportes.index')
            ->with('success', 'Transporte creado exitosamente');
    }

    // Formulario para editar transporte
    public function edit(Transporte $transporte)
    {
        return view('admin.transportes.edit', compact('transporte'));
    }

    // Actualizar transporte
    public function update(Request $request, Transporte $transporte)
    {
        $validator = Validator::make($request->all(), [
            'tipo' => 'required|string|in:Aéreo,Terrestre,Marítimo',
            'placa' => 'required|string|unique:transportes,placa,' . $transporte->id,
            'capacidad' => 'required|integer|min:1|max:500',
            'modelo' => 'nullable|string|max:255',
            'activo' => 'boolean',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['activo'] = $request->has('activo');

        $transporte->update($data);

        return redirect()->route('admin.transportes.index')
            ->with('success', 'Transporte actualizado exitosamente');
    }

    // Eliminar transporte (soft delete)
    public function destroy(Transporte $transporte)
    {
        if ($transporte->imagenes) {
            Storage::disk('public')->delete($transporte->imagenes);
        }
        $transporte->delete();

        return redirect()->route('admin.transportes.index')
            ->with('success', 'Transporte eliminado exitosamente');
    }

    /**
     * ==========================================
     * MÉTODOS PARA API (para consumo interno)
     * ==========================================
     */
    
    // Obtener todos los transportes (API) - Para clientes
    public function apiIndex()
    {
        $transportes = Transporte::where('activo', true)
            ->select('id', 'tipo', 'placa', 'capacidad', 'modelo')
            ->get();
        
        return response()->json([
            'success' => true,
            'data' => $transportes,
            'total' => $transportes->count()
        ]);
    }

    // Obtener un transporte específico (API)
    public function apiShow($id)
    {
        $transporte = Transporte::where('activo', true)->find($id);
        
        if (!$transporte) {
            return response()->json([
                'success' => false,
                'message' => 'Transporte no encontrado'
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => $transporte
        ]);
    }

    // Buscar transportes por tipo (API)
    public function apiByType($tipo)
    {
        $transportes = Transporte::where('activo', true)
            ->where('tipo', $tipo)
            ->get();
        
        return response()->json([
            'success' => true,
            'data' => $transportes
        ]);
    }

    // Buscar transportes con capacidad mínima (API)
    public function apiByCapacity(Request $request)
    {
        $capacity = $request->get('capacidad', 1);
        
        $transportes = Transporte::where('activo', true)
            ->where('capacidad', '>=', $capacity)
            ->get();
        
        return response()->json([
            'success' => true,
            'data' => $transportes
        ]);
    }
}