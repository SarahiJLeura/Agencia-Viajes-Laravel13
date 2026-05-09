@extends('layouts.app')

@section('title', 'Gestión de Destinos - Admin')

@section('content')
<div class="flex">
    
    <div class="flex-1 p-6 lg:p-8">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="font-headline-lg text-on-background">Gestión de Destinos</h1>
                <p class="text-slate-500">Administra los destinos turísticos</p>
            </div>
            <a href="{{ route('admin.destinos.create') }}" class="bg-blue-700 text-white px-5 py-2 rounded-lg flex items-center gap-2">
                <span class="material-symbols-outlined">add</span>
                Nuevo Destino
            </a>
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
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Imagen</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Ciudad / País</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Hospedajes</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Creado</th>
                            <th class="px-6 py-3 text-right text-xs font-bold text-primary uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#EBECF0]">
                        @forelse($destinos as $destino)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">
                                @if($destino->imagenes)
                                    <img src="{{ Storage::url($destino->imagenes) }}" class="w-12 h-12 rounded-lg object-cover">
                                @else
                                    <div class="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center">
                                        <span class="material-symbols-outlined text-slate-400">image</span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-semibold">{{ $destino->nombre }}</td>
                            <td class="px-6 py-4">
                                {{ $destino->ciudad }}, {{ $destino->pais }}
                                @if($destino->direccion)
                                    <p class="text-xs text-slate-400 mt-1">{{ $destino->direccion }}</p>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 bg-blue-100 text-blue-700 rounded-full text-xs">
                                    {{ $destino->hospedajes->count() }} hospedajes
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-slate-500">
                                {{ $destino->created_at->format('d/m/Y') }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.destinos.edit', $destino) }}" class="p-2 text-slate-400 hover:text-primary rounded-lg transition-colors">
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </a>
                                    <form method="POST" action="{{ route('admin.destinos.destroy', $destino) }}" class="inline" onsubmit="return confirm('¿Eliminar este destino? Se eliminarán también sus relaciones.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-slate-400 hover:text-error rounded-lg transition-colors">
                                            <span class="material-symbols-outlined text-sm">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-500">
                                No hay destinos registrados
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-[#EBECF0]">
                {{ $destinos->links() }}
            </div>
        </div>
    </div>
</div>
@endsection