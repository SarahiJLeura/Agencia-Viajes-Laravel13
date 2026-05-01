@extends('layouts.app')

@section('title', 'Crear Destino - Admin')

@section('content')
<div class="flex">
    @include('admin.layouts.sidebar')
    
    <div class="flex-1 p-6 lg:p-8 max-w-2xl">
        <h1 class="font-headline-lg text-on-background mb-6">Nuevo Destino</h1>
        
        <form method="POST" action="{{ route('admin.destinos.store') }}" enctype="multipart/form-data" class="bg-white rounded-xl p-6 border border-[#EBECF0] ocean-shadow">
            @csrf
            
            <div class="space-y-4">
                <div>
                    <label class="block font-label-lg mb-2">Nombre del Destino *</label>
                    <input type="text" name="nombre" value="{{ old('nombre') }}" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" required>
                    @error('nombre') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-label-lg mb-2">Ciudad *</label>
                        <input type="text" name="ciudad" value="{{ old('ciudad') }}" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" required>
                        @error('ciudad') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block font-label-lg mb-2">País *</label>
                        <input type="text" name="pais" value="{{ old('pais') }}" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" required>
                        @error('pais') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                
                <div>
                    <label class="block font-label-lg mb-2">Dirección (opcional)</label>
                    <input type="text" name="direccion" value="{{ old('direccion') }}" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" placeholder="Calle, número, zona">
                </div>
                
                <div>
                    <label class="block font-label-lg mb-2">Imagen</label>
                    <input type="file" name="imagenes" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" accept="image/*">
                    <p class="text-xs text-slate-400 mt-1">Formatos: JPG, PNG (máx 2MB)</p>
                    @error('imagenes') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
            
            <div class="flex gap-3 mt-8 pt-4 border-t border-[#EBECF0]">
                <button type="submit" class="bg-primary text-white px-6 py-3 rounded-lg font-semibold">Guardar Destino</button>
                <a href="{{ route('admin.destinos.index') }}" class="px-6 py-3 border border-slate-300 rounded-lg font-semibold hover:bg-slate-50">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection