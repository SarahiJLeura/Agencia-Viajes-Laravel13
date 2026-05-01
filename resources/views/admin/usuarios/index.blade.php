@extends('layouts.app')

@section('title', 'Gestión de Usuarios - Admin')

@section('content')
<div class="flex">
    @include('admin.layouts.sidebar')
    
    <div class="flex-1 p-6 lg:p-8">
        <div class="flex justify-between items-center mb-6 flex-wrap gap-4">
            <div>
                <h1 class="font-headline-lg text-on-background">Gestión de Usuarios</h1>
                <p class="text-slate-500">Administra los usuarios del sistema</p>
            </div>
            <div class="flex gap-3">
                <form method="POST" action="{{ route('admin.usuarios.importar') }}" enctype="multipart/form-data" class="inline">
                    @csrf
                    <label class="cursor-pointer bg-white border-2 border-primary text-primary px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-blue-50 transition-colors">
                        <span class="material-symbols-outlined">upload</span>
                        Importar CSV
                        <input type="file" name="csv_file" accept=".csv" class="hidden" onchange="this.form.submit()">
                    </label>
                </form>
                <a href="{{ route('admin.usuarios.exportar') }}" class="bg-white border-2 border-primary text-primary px-4 py-2 rounded-lg flex items-center gap-2 hover:bg-blue-50 transition-colors">
                    <span class="material-symbols-outlined">download</span>
                    Exportar CSV
                </a>
                <a href="{{ route('admin.usuarios.create') }}" class="bg-primary text-white px-5 py-2 rounded-lg flex items-center gap-2">
                    <span class="material-symbols-outlined">add</span>
                    Nuevo Usuario
                </a>
            </div>
        </div>
        
        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl p-4 mb-6">
                {{ session('success') }}
            </div>
        @endif
        
        <div class="bg-white rounded-xl border border-[#EBECF0] ocean-shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#E6EFFC]">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Rol</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Estado</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Registro</th>
                            <th class="px-6 py-3 text-right text-xs font-bold text-primary uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#EBECF0]">
                        @forelse($usuarios as $usuario)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 text-sm">#{{ $usuario->id }}</td>
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-full bg-primary/10 flex items-center justify-center text-primary font-bold text-sm">
                                        {{ strtoupper(substr($usuario->name, 0, 1)) }}
                                    </div>
                                    <span class="font-semibold">{{ $usuario->name }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm">{{ $usuario->email }}</td>
                            <td class="px-6 py-4">
                                @if($usuario->isAdmin())
                                    <span class="px-2 py-1 bg-purple-100 text-purple-700 rounded-full text-xs font-bold">Administrador</span>
                                @else
                                    <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs font-bold">Cliente</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($usuario->deleted_at)
                                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold">Eliminado</span>
                                @else
                                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">Activo</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500">{{ $usuario->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.usuarios.edit', $usuario) }}" class="p-2 text-slate-400 hover:text-primary rounded-lg transition-colors">
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </a>
                                    @if(!$usuario->deleted_at)
                                        <form method="POST" action="{{ route('admin.usuarios.destroy', $usuario) }}" class="inline" onsubmit="return confirm('¿Eliminar este usuario?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 text-slate-400 hover:text-error rounded-lg transition-colors">
                                                <span class="material-symbols-outlined text-sm">delete</span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-slate-500">
                                No hay usuarios registrados
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-[#EBECF0]">
                {{ $usuarios->links() }}
            </div>
        </div>
        
        <!-- CSV Format Guide -->
        <div class="mt-6 bg-blue-50 rounded-xl p-4 border border-blue-200">
            <div class="flex items-start gap-3">
                <span class="material-symbols-outlined text-primary">info</span>
                <div>
                    <h4 class="font-semibold text-primary">Formato CSV para importar usuarios</h4>
                    <p class="text-sm text-slate-600 mt-1">El archivo CSV debe tener las siguientes columnas:</p>
                    <code class="block bg-white p-2 rounded text-xs mt-2 font-mono">name,email,password,role</code>
                    <p class="text-xs text-slate-500 mt-2">Ejemplo: Juan Pérez,juan@mail.com,password123,user</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection