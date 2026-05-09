{{-- resources/views/admin/transportes/index.blade.php --}}
@extends('layouts.app')

@section('title', 'Gestión de Transportes - Admin')

@section('content')
<div class="flex">
    
    <div class="flex-1 p-6 lg:p-8">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="font-headline-lg text-on-background">Gestión de Transportes</h1>
                <p class="text-slate-500">Administra los vehículos de la flota</p>
            </div>
            <a href="{{ route('admin.transportes.create') }}" class="bg-blue-700 text-white px-5 py-2 rounded-lg flex items-center gap-2">
                <span class="material-symbols-outlined">add</span>
                Nuevo Transporte
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
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Tipo</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Placa</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Capacidad</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Modelo</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Estado</th>
                            <th class="px-6 py-3 text-right text-xs font-bold text-primary uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#EBECF0]">
                        @forelse($transportes as $transporte)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">
                                <span class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary">
                                        @switch($transporte->tipo)
                                            @case('Aéreo') flight @break
                                            @case('Terrestre') directions_bus @break
                                            @case('Marítimo') directions_boat @break
                                            @default directions_car
                                        @endswitch
                                    </span>
                                    {{ $transporte->tipo }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-mono text-sm">{{ $transporte->placa }}</td>
                            <td class="px-6 py-4">
                                <span class="flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">group</span>
                                    {{ $transporte->capacidad }}
                                </span>
                            </td>
                            <td class="px-6 py-4">{{ $transporte->modelo ?? '—' }}</td>
                            <td class="px-6 py-4">
                                @if($transporte->activo)
                                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs font-bold">Activo</span>
                                @else
                                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs font-bold">Inactivo</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('admin.transportes.edit', $transporte) }}" class="p-2 text-slate-400 hover:text-primary rounded-lg transition-colors">
                                        <span class="material-symbols-outlined text-sm">edit</span>
                                    </a>
                                    <form method="POST" action="{{ route('admin.transportes.destroy', $transporte) }}" class="inline" onsubmit="return confirm('¿Eliminar este transporte?')">
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
                            <td colspan="8" class="px-6 py-12 text-center text-slate-500">
                                No hay transportes registrados
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-[#EBECF0]">
                {{ $transportes->links() }}
            </div>
        </div>
        
        <!-- API Status Card -->
        <div class="mt-6 bg-blue-50 rounded-xl p-4 border border-blue-200">
            <div class="flex items-center gap-3">
                <span class="material-symbols-outlined text-primary">api</span>
                <div>
                    <h4 class="font-semibold text-primary">API de Transportes</h4>
                    <p class="text-sm text-slate-600">Endpoint: <code class="bg-white px-2 py-1 rounded">GET /api/transportes</code></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection