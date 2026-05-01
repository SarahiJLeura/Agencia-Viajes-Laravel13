@extends('layouts.app')

@section('title', 'Admin Dashboard - GlobalQuest')

@section('content')
<div class="flex">
    <!-- Sidebar Admin -->
    <aside class="hidden lg:block w-72 bg-white border-r border-[#EBECF0] min-h-screen p-6">
        <div class="mb-8">
            <h3 class="font-headline-md text-primary">Panel Admin</h3>
            <p class="text-sm text-slate-500">Gestión completa del sistema</p>
        </div>
        <nav class="space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-blue-50 text-primary rounded-lg">
                <span class="material-symbols-outlined">dashboard</span>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.usuarios.index') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-surface-container-low rounded-lg transition-colors">
                <span class="material-symbols-outlined">group</span>
                <span>Usuarios</span>
            </a>
            <a href="{{ route('admin.destinos.index') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-surface-container-low rounded-lg transition-colors">
                <span class="material-symbols-outlined">map</span>
                <span>Destinos</span>
            </a>
            <a href="{{ route('admin.hospedajes.index') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-surface-container-low rounded-lg transition-colors">
                <span class="material-symbols-outlined">hotel</span>
                <span>Hospedajes</span>
            </a>
            <a href="{{ route('admin.viajes.index') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-surface-container-low rounded-lg transition-colors">
                <span class="material-symbols-outlined">luggage</span>
                <span>Viajes</span>
            </a>
        </nav>
    </aside>
    
    <!-- Main Content -->
    <div class="flex-1 p-6 lg:p-8">
        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl p-6 border border-[#EBECF0] ocean-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 text-sm uppercase">Usuarios</p>
                        <p class="text-3xl font-bold text-on-surface">{{ $totalUsuarios }}</p>
                    </div>
                    <div class="p-3 bg-blue-50 rounded-xl">
                        <span class="material-symbols-outlined text-primary">group</span>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-6 border border-[#EBECF0] ocean-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 text-sm uppercase">Viajes</p>
                        <p class="text-3xl font-bold text-on-surface">{{ $totalViajes }}</p>
                    </div>
                    <div class="p-3 bg-orange-50 rounded-xl">
                        <span class="material-symbols-outlined text-secondary-container">luggage</span>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-6 border border-[#EBECF0] ocean-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 text-sm uppercase">Destinos</p>
                        <p class="text-3xl font-bold text-on-surface">{{ $totalDestinos }}</p>
                    </div>
                    <div class="p-3 bg-teal-50 rounded-xl">
                        <span class="material-symbols-outlined text-tertiary">map</span>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl p-6 border border-[#EBECF0] ocean-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-slate-500 text-sm uppercase">Hospedajes</p>
                        <p class="text-3xl font-bold text-on-surface">{{ $totalHospedajes }}</p>
                    </div>
                    <div class="p-3 bg-purple-50 rounded-xl">
                        <span class="material-symbols-outlined text-purple-600">hotel</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Gráficas -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <div class="bg-white rounded-xl p-6 border border-[#EBECF0] ocean-shadow">
                <h3 class="font-headline-md mb-4">Viajes por Destino</h3>
                <canvas id="destinosChart" height="200"></canvas>
            </div>
            <div class="bg-white rounded-xl p-6 border border-[#EBECF0] ocean-shadow">
                <h3 class="font-headline-md mb-4">Ingresos Mensuales</h3>
                <canvas id="ingresosChart" height="200"></canvas>
            </div>
        </div>
        
        <!-- Viajes Recientes -->
        <div class="bg-white rounded-xl border border-[#EBECF0] ocean-shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-[#EBECF0]">
                <h3 class="font-headline-md">Viajes Recientes</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[#E6EFFC]">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Cliente</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Destino</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Fechas</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-primary uppercase">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-[#EBECF0]">
                        @foreach($viajesRecientes as $viaje)
                        <tr class="hover:bg-slate-50">
                            <td class="px-6 py-4">{{ $viaje->user->name }}</td>
                            <td class="px-6 py-4">{{ $viaje->destino->nombre }}</td>
                            <td class="px-6 py-4">{{ $viaje->fecha_inicio->format('d/m/Y') }} - {{ $viaje->fecha_fin->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 font-bold">${{ number_format($viaje->precio_total, 2) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    new Chart(document.getElementById('destinosChart'), {
        type: 'bar',
        data: {
            labels: @json($viajesPorDestino->pluck('nombre')->toArray()),
            datasets: [{
                label: 'Número de viajes',
                data: @json($viajesPorDestino->pluck('total')->toArray()),
                backgroundColor: '#0052cc',
                borderRadius: 8
            }]
        },
        options: { responsive: true }
    });
    
    new Chart(document.getElementById('ingresosChart'), {
        type: 'line',
        data: {
            labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
            datasets: [{
                label: 'Ingresos ($)',
                data: @json($ingresosPorMes->pluck('total')->toArray()),
                borderColor: '#fd8b00',
                backgroundColor: 'rgba(253, 139, 0, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: { responsive: true }
    });
</script>
@endpush
@endsection