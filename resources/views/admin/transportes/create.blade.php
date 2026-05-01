{{-- resources/views/admin/transportes/create.blade.php --}}
@extends('layouts.app')

@section('title', 'Crear Transporte - Admin')

@section('content')
<div class="flex">
    @include('admin.layouts.sidebar')
    
    <div class="flex-1 p-6 lg:p-8 max-w-2xl">
        <h1 class="font-headline-lg text-on-background mb-6">Nuevo Transporte</h1>
        
        <form method="POST" action="{{ route('admin.transportes.store') }}" enctype="multipart/form-data" class="bg-white rounded-xl p-6 border border-[#EBECF0] ocean-shadow">
            @csrf
            
            <div class="space-y-4">
                <div>
                    <label class="block font-label-lg mb-2">Tipo de Transporte *</label>
                    <select name="tipo" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" required>
                        <option value="">Seleccionar...</option>
                        <option value="Aéreo"> Aéreo (Avión)</option>
                        <option value="Terrestre"> Terrestre (Bus/Camión)</option>
                        <option value="Terrestre"> Terrestre (Auto/Taxi)</option>
                        <option value="Marítimo"> Marítimo (Barco)</option>
                    </select>
                    @error('tipo') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label class="block font-label-lg mb-2">Placa/Matrícula *</label>
                    <input type="text" name="placa" value="{{ old('placa') }}" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" placeholder="ABC-123" required>
                    @error('placa') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label class="block font-label-lg mb-2">Capacidad (pasajeros) *</label>
                    <input type="number" name="capacidad" value="{{ old('capacidad') }}" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" placeholder="50" required>
                    @error('capacidad') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block font-label-lg mb-2">Modelo</label>
                        <input type="text" name="modelo" value="{{ old('modelo') }}" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" placeholder="Boeing 737">
                    </div>
                </div>
                
                <div class="flex items-center gap-3">
                    <input type="checkbox" name="activo" id="activo" checked class="w-5 h-5 text-primary rounded">
                    <label for="activo" class="font-label-lg">Activo (disponible para reservas)</label>
                </div>
            </div>
            
            <div class="flex gap-3 mt-8 pt-4 border-t border-[#EBECF0]">
                <button type="submit" class="bg-primary text-white px-6 py-3 rounded-lg font-semibold">Guardar Transporte</button>
                <a href="{{ route('admin.transportes.index') }}" class="px-6 py-3 border border-slate-300 rounded-lg font-semibold hover:bg-slate-50">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection