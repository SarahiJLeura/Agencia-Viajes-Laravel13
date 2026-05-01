<?php

namespace App\Http\Controllers;

use App\Models\Destino;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestinoController extends Controller
{
    public function index()
    {
        $destinos = Destino::with('hospedajes')->paginate(10);
        return view('admin.destinos.index', compact('destinos'));
    }

    public function create()
    {
        return view('admin.destinos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
            'direccion' => 'nullable|string',
            'imagenes' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('imagenes')) {
            $path = $request->file('imagenes')->store('destinos', 'public');
            $data['imagenes'] = $path;
        }

        Destino::create($data);

        return redirect()->route('admin.destinos.index')
            ->with('success', 'Destino creado exitosamente');
    }

    public function edit(Destino $destino)
    {
        return view('admin.destinos.edit', compact('destino'));
    }

    public function update(Request $request, Destino $destino)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
            'pais' => 'required|string|max:255',
            'direccion' => 'nullable|string',
            'imagenes' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();
        
        if ($request->hasFile('imagenes')) {
            if ($destino->imagenes) {
                Storage::disk('public')->delete($destino->imagenes);
            }
            $path = $request->file('imagenes')->store('destinos', 'public');
            $data['imagenes'] = $path;
        }

        $destino->update($data);

        return redirect()->route('admin.destinos.index')
            ->with('success', 'Destino actualizado exitosamente');
    }

    public function destroy(Destino $destino)
    {
        if ($destino->imagenes) {
            Storage::disk('public')->delete($destino->imagenes);
        }
        $destino->delete();
        
        return redirect()->route('admin.destinos.index')
            ->with('success', 'Destino eliminado exitosamente');
    }

    public function apiDestinos()
    {
        $destinos = Destino::all();
        return response()->json($destinos);
    }
}