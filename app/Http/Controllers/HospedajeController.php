<?php

namespace App\Http\Controllers;

use App\Models\Destino;
use App\Models\Hospedaje;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HospedajeController extends Controller
{
    public function index()
    {
        $hospedajes = Hospedaje::with('destinos')->paginate(10);
        return view('admin.hospedajes.index', compact('hospedajes'));
    }

    public function create()
    {
        $destinos = Destino::all();
        return view('admin.hospedajes.create', compact('destinos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string',
            'capacidad' => 'required|integer|min:1',
            'tipo' => 'required|string',
            'imagenes' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'destinos' => 'array',
            'destinos.*' => 'exists:destinos,id',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('imagenes')) {
            $path = $request->file('imagenes')->store('hospedajes', 'public');
            $data['imagenes'] = $path;
        }

        $hospedaje = Hospedaje::create($data);
        
        if ($request->has('destinos')) {
            $hospedaje->destinos()->attach($request->destinos);
        }

        return redirect()->route('admin.hospedajes.index')
            ->with('success', 'Hospedaje creado exitosamente');
    }

    public function edit(Hospedaje $hospedaje)
    {
        $destinos = Destino::all();
        return view('admin.hospedajes.edit', compact('hospedaje', 'destinos'));
    }

    public function update(Request $request, Hospedaje $hospedaje)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'direccion' => 'required|string',
            'capacidad' => 'required|integer|min:1',
            'tipo' => 'required|string',
            'imagenes' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'destinos' => 'array',
            'destinos.*' => 'exists:destinos,id',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('imagenes')) {
            if ($hospedaje->imagenes) {
                Storage::disk('public')->delete($hospedaje->imagenes);
            }
            $path = $request->file('imagenes')->store('hospedajes', 'public');
            $data['imagenes'] = $path;
        }

        $hospedaje->update($data);
        $hospedaje->destinos()->sync($request->destinos ?? []);

        return redirect()->route('admin.hospedajes.index')
            ->with('success', 'Hospedaje actualizado exitosamente');
    }

    public function destroy(Hospedaje $hospedaje)
    {
        if ($hospedaje->imagenes) {
            Storage::disk('public')->delete($hospedaje->imagenes);
        }
        $hospedaje->delete();
        
        return redirect()->route('admin.hospedajes.index')
            ->with('success', 'Hospedaje eliminado exitosamente');
    }

    public function apiHospedajes()
    {
        $hospedajes = Hospedaje::with('destinos')->get();
        return response()->json($hospedajes);
    }
}