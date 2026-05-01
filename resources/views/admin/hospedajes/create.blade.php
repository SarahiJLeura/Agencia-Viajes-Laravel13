@extends('layouts.app')

@section('title', 'Crear Hospedaje - Admin')

@section('content')
<div class="flex">
    @include('admin.layouts.sidebar')
    
    <div class="flex-1 p-6 lg:p-8 max-w-2xl">
        <h1 class="font-headline-lg text-on-background mb-6">Nuevo Hospedaje</h1>
        
        <form method="POST" action="{{ route('admin.hospedajes.store') }}" enctype="multipart/form-data" class="bg-white rounded-xl p-6 border border-[#EBECF0] ocean-shadow">
            @csrf
            
            <div class="space-y-4">
                <div>
                    <label class="block font-label-lg mb-2">Nombre del Hospedaje *</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" required>
                    @error('nombre') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label class="block font-label-lg mb-2">Dirección *</label>
                    <input type="text" name="direccion" value="{{ old('direccion') }}" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" required>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-label-lg mb-2">Capacidad (personas) *</label>
                        <input type="number" name="capacidad" value="{{ old('capacidad') }}" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" required>
                    </div>
                    <div>
                        <label class="block font-label-lg mb-2">Tipo *</label>
                        <select name="tipo" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" required>
                            <option value="">Seleccionar...</option>
                            <option value="Hotel">Hotel</option>
                            <option value="Resort">Resort</option>
                            <option value="Hostal">Hostal</option>
                            <option value="Airbnb">Airbnb</option>
                            <option value="Cabaña">Cabaña</option>
                        </select>
                    </div>
                </div>
                
                <div>
                    <label class="block font-label-lg mb-2">Destinos asociados</label>
                    <select name="destinos[]" multiple class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" size="5">
                        @foreach($destinos as $destino)
                            <option value="{{ $destino->id }}" {{ in_array($destino->id, old('destinos', [])) ? 'selected' : '' }}>
                                {{ $destino->nombre }} - {{ $destino->ciudad }}, {{ $destino->pais }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-slate-400 mt-1">Ctrl+Click para seleccionar múltiples destinos</p>
                </div>
                
                <div>
                    <label class="block font-label-lg mb-2">Imagen</label>
                    <input type="file" name="imagenes" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" accept="image/*">
                </div>
            </div>
            
            <div class="flex gap-3 mt-8 pt-4 border-t border-[#EBECF0]">
                <button type="submit" class="bg-primary text-white px-6 py-3 rounded-lg font-semibold">Guardar Hospedaje</button>
                <a href="{{ route('admin.hospedajes.index') }}" class="px-6 py-3 border border-slate-300 rounded-lg font-semibold hover:bg-slate-50">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection