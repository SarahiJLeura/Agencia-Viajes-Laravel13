@extends('layouts.app')

@section('title', 'Editar Destino - Admin')

@section('content')
<div class="flex">
    @include('admin.layouts.sidebar')
    
    <div class="flex-1 p-6 lg:p-8 max-w-2xl">
        <h1 class="font-headline-lg text-on-background mb-6">Editar Destino</h1>
        
        <form method="POST" action="{{ route('admin.destinos.update', $destino) }}" enctype="multipart/form-data" class="bg-white rounded-xl p-6 border border-[#EBECF0] ocean-shadow">
            @csrf
            @method('PUT')
            
            <div class="space-y-4">
                <div>
                    <label class="block font-label-lg mb-2">Nombre del Destino *</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $destino->nombre) }}" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" required>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-label-lg mb-2">Ciudad *</label>
                        <input type="text" name="ciudad" value="{{ old('ciudad', $destino->ciudad) }}" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" required>
                    </div>
                    <div>
                        <label class="block font-label-lg mb-2">País *</label>
                        <input type="text" name="pais" value="{{ old('pais', $destino->pais) }}" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" required>
                    </div>
                </div>
                
                <div>
                    <label class="block font-label-lg mb-2">Dirección (opcional)</label>
                    <input type="text" name="direccion" value="{{ old('direccion', $destino->direccion) }}" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary">
                </div>
                
                <div>
                    <label class="block font-label-lg mb-2">Imagen actual</label>
                    @if($destino->imagenes)
                        <div class="mb-3">
                            <img src="{{ Storage::url($destino->imagenes) }}" class="w-32 h-32 object-cover rounded-lg">
                        </div>
                    @endif
                    <input type="file" name="imagenes" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" accept="image/*">
                    <p class="text-xs text-slate-400 mt-1">Dejar en blanco para mantener la imagen actual</p>
                </div>
            </div>
            
            <div class="flex gap-3 mt-8 pt-4 border-t border-[#EBECF0]">
                <button type="submit" class="bg-primary text-white px-6 py-3 rounded-lg font-semibold">Actualizar Destino</button>
                <a href="{{ route('admin.destinos.index') }}" class="px-6 py-3 border border-slate-300 rounded-lg font-semibold hover:bg-slate-50">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection