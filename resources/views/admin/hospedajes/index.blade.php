@extends('layouts.app')

@section('title', 'Gestión de Hospedajes - Admin')

@section('content')
<div class="flex">
    
    <div class="flex-1 p-6 lg:p-8">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="font-headline-lg text-on-background">Gestión de Hospedajes</h1>
                <p class="text-slate-500">Administra hoteles, resorts y alojamientos</p>
            </div>
            <a href="{{ route('admin.hospedajes.create') }}" class="bg-blue-700 text-white px-5 py-2 rounded-lg flex items-center gap-2">
                <span class="material-symbols-outlined">add</span>
                Nuevo Hospedaje
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
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Tipo</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Capacidad</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Destinos</th>
                            <th class="px-6 py-3 text-right text-xs font-bold text-primary uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#EBECF0]">
                        @forelse($hospedajes as $hospedaje)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">
                                @if($hospedaje->imagenes)
                                    <img src="{{ Storage::url($hospedaje->imagenes) }}" class="w-12 h-12 rounded-lg object-cover">
                                @else
                                    <div class="w-12 h-12 bg-slate-100 rounded-lg flex items-center justify-center">
                                        <span class="material-symbols-outlined text-slate-400">hotel</span>
                                    </div>
                                @endif
                            </td>
                            <td class="px-6 py-4 font-semibold">{{ $hospedaje->nombre }}</td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-1 rounded-full text-xs font-bold
                                    @if($hospedaje->tipo == 'Hotel') bg-blue-100 text-blue-700
                                    @elseif($hospedaje->tipo == 'Resort') bg-green-100 text-green-700
                                    @else bg-purple-100 text-purple-700 @endif">
                                    {{ $hospedaje->tipo }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $hospedaje->capacidad }} personas</td>
                            <td class="px-6 py-4">
                                <div class="flex flex-wrap gap-1">
                                    @foreach($hospedaje->destinos->take(2) as $destino)
                                        <span class="px-2 py-0.5 bg-slate-100 rounded-full text-xs">{{ $destino->nombre }}</span>
                                    @endforeach
                                    @if($hospedaje->destinos->count() > 2)
                                        <span class="px-2 py-0.5 bg-slate-100 rounded-full text-xs">+{{ $hospedaje->destinos->count() - 2 }}</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.hospedajes.edit', $hospedaje) }}" class="p-2 text-slate-400 hover:text-primary rounded-lg transition-colors">
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </a>
                                    <form method="POST" action="{{ route('admin.hospedajes.destroy', $hospedaje) }}" class="inline" onsubmit="return confirm('¿Eliminar este hospedaje?')">
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
                                No hay hospedajes registrados
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-[#EBECF0]">
                {{ $hospedajes->links() }}
            </div>
        </div>
    </div>
</div>
@endsection