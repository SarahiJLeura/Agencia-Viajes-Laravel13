@extends('layouts.app')

@section('title', 'Gestión de Viajes - Admin')

@section('content')
<div class="flex">
    @include('admin.layouts.sidebar')
    
    <div class="flex-1 p-6 lg:p-8">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="font-headline-lg text-on-background">Gestión de Viajes</h1>
                <p class="text-slate-500">Administra todas las reservas de viajes</p>
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
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Cliente</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Destino</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Hospedaje</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Fechas</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Personas</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Estado</th>
                            <th class="px-6 py-3 text-right text-xs font-bold text-primary uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#EBECF0]">
                        @forelse($viajes as $viaje)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4 text-sm">#{{ $viaje->id }}</td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="font-semibold">{{ $viaje->user->name }}</p>
                                    <p class="text-xs text-slate-400">{{ $viaje->user->email }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">{{ $viaje->destino->nombre }}</td>
                            <td class="px-6 py-4">{{ $viaje->hospedaje->nombre }}</td>
                            <td class="px-6 py-4 text-sm">
                                {{ $viaje->fecha_inicio->format('d/m/Y') }}<br>
                                <span class="text-xs text-slate-400">a {{ $viaje->fecha_fin->format('d/m/Y') }}</span>
                            </td>
                            <td class="px-6 py-4">{{ $viaje->cantidad_personas }}</td>
                            <td class="px-6 py-4 font-bold text-primary">${{ number_format($viaje->precio_total, 2) }}</td>
                            <td class="px-6 py-4">
                                @php
                                    $estado = 'Confirmado';
                                    $color = 'green';
                                    if($viaje->fecha_inicio < now() && $viaje->fecha_fin > now()) {
                                        $estado = 'En curso';
                                        $color = 'blue';
                                    } elseif($viaje->fecha_fin < now()) {
                                        $estado = 'Completado';
                                        $color = 'gray';
                                    } elseif($viaje->deleted_at) {
                                        $estado = 'Cancelado';
                                        $color = 'red';
                                    }
                                @endphp
                                <span class="px-2 py-1 rounded-full text-xs font-bold bg-{{ $color }}-100 text-{{ $color }}-700">
                                    {{ $estado }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('viajes.show', $viaje) }}" class="p-2 text-slate-400 hover:text-primary rounded-lg transition-colors inline-block">
                                    <span class="material-symbols-outlined text-sm">visibility</span>
                                </a>
                             </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="px-6 py-12 text-center text-slate-500">
                                No hay viajes registrados
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="px-6 py-4 border-t border-[#EBECF0]">
                {{ $viajes->links() }}
            </div>
        </div>
        
        <!-- Stats Summary -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">
            <div class="bg-gradient-to-r from-primary to-primary-container text-white rounded-xl p-4">
                <p class="text-sm opacity-90">Total Viajes</p>
                <p class="text-2xl font-bold">{{ $viajes->total() }}</p>
            </div>
            <div class="bg-gradient-to-r from-secondary to-secondary-container text-white rounded-xl p-4">
                <p class="text-sm opacity-90">Ingresos Totales</p>
                <p class="text-2xl font-bold">${{ number_format($viajes->sum('precio_total'), 0) }}</p>
            </div>
        </div>
    </div>
</div>
@endsection