@extends('layouts.app')

@section('title', 'Editar Hospedaje - Admin')

@section('content')
<div class="flex">
    
    <div class="flex-1 p-6 lg:p-8 max-w-2xl">
        <h1 class="font-headline-lg text-on-background mb-6">Editar Hospedaje</h1>
        
        <form method="POST" action="{{ route('admin.hospedajes.update', $hospedaje) }}" enctype="multipart/form-data" class="bg-white rounded-xl p-6 border border-[#EBECF0] ocean-shadow">
            @csrf
            @method('PUT')
            
            <div class="space-y-4">
                <div>
                    <label class="block font-label-lg mb-2">Nombre del Hospedaje *</label>
                    <input type="text" name="nombre" value="{{ old('nombre', $hospedaje->nombre) }}" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" required>
                </div>
                
                <div>
                    <label class="block font-label-lg mb-2">Dirección *</label>
                    <input type="text" name="direccion" value="{{ old('direccion', $hospedaje->direccion) }}" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" required>
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-label-lg mb-2">Capacidad (personas) *</label>
                        <input type="number" name="capacidad" value="{{ old('capacidad', $hospedaje->capacidad) }}" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" required>
                    </div>
                    <div>
                        <label class="block font-label-lg mb-2">Tipo *</label>
                        <select name="tipo" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" required>
                            <option value="Hotel" {{ $hospedaje->tipo == 'Hotel' ? 'selected' : '' }}>Hotel</option>
                            <option value="Resort" {{ $hospedaje->tipo == 'Resort' ? 'selected' : '' }}>Resort</option>
                            <option value="Hostal" {{ $hospedaje->tipo == 'Hostal' ? 'selected' : '' }}>Hostal</option>
                            <option value="Airbnb" {{ $hospedaje->tipo == 'Airbnb' ? 'selected' : '' }}>Airbnb</option>
                            <option value="Cabaña" {{ $hospedaje->tipo == 'Cabaña' ? 'selected' : '' }}>Cabaña</option>
                        </select>
                    </div>
                </div>
                
                <div>
                    <label class="block font-label-lg mb-2">Destinos asociados</label>
                    <select name="destinos[]" multiple class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" size="5">
                        @foreach($destinos as $destino)
                            <option value="{{ $destino->id }}" {{ $hospedaje->destinos->contains($destino->id) ? 'selected' : '' }}>
                                {{ $destino->nombre }} - {{ $destino->ciudad }}, {{ $destino->pais }}
                            </option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label class="block font-label-lg mb-2">Imagen actual</label>
                    @if($hospedaje->imagenes)
                        <div class="mb-3">
                            <img src="{{ Storage::url($hospedaje->imagenes) }}" class="w-32 h-32 object-cover rounded-lg">
                        </div>
                    @endif
                    <input type="file" name="imagenes" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" accept="image/*">
                </div>
            </div>
            
            <div class="flex gap-3 mt-8 pt-4 border-t border-[#EBECF0]">
                <button type="submit" class="bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold">Actualizar Hospedaje</button>
                <a href="{{ route('admin.hospedajes.index') }}" class="px-6 py-3 border border-slate-300 rounded-lg font-semibold hover:bg-slate-50">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection