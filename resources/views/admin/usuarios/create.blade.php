@extends('layouts.app')

@section('title', 'Crear Usuario - Admin')

@section('content')
<div class="flex">
    @include('admin.layouts.sidebar')
    
    <div class="flex-1 p-6 lg:p-8 max-w-2xl">
        <h1 class="font-headline-lg text-on-background mb-6">Nuevo Usuario</h1>
        
        <form method="POST" action="{{ route('admin.usuarios.store') }}" class="bg-white rounded-xl p-6 border border-[#EBECF0] ocean-shadow">
            @csrf
            
            <div class="space-y-4">
                <div>
                    <label class="block font-label-lg mb-2">Nombre completo *</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" required>
                    @error('name') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label class="block font-label-lg mb-2">Correo electrónico *</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" required>
                    @error('email') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label class="block font-label-lg mb-2">Contraseña *</label>
                    <input type="password" name="password" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" required>
                    @error('password') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
                </div>
                
                <div>
                    <label class="block font-label-lg mb-2">Rol *</label>
                    <select name="role" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" required>
                        <option value="user">Cliente</option>
                        <option value="admin">Administrador</option>
                    </select>
                </div>
            </div>
            
            <div class="flex gap-3 mt-8 pt-4 border-t border-[#EBECF0]">
                <button type="submit" class="bg-primary text-white px-6 py-3 rounded-lg font-semibold">Crear Usuario</button>
                <a href="{{ route('admin.usuarios.index') }}" class="px-6 py-3 border border-slate-300 rounded-lg font-semibold hover:bg-slate-50">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection