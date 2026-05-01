@extends('layouts.app')

@section('title', 'Dashboard - GlobalQuest')

@section('content')
<div class="max-w-[1280px] mx-auto px-6 py-8">
    <!-- Hero Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-lg mb-xl">
        <div class="md:col-span-2 bg-white rounded-xl p-lg border border-[#EBECF0] ocean-shadow">
            <h2 class="font-headline-lg text-on-background mb-sm">¡Bienvenido, {{ auth()->user()->name }}!</h2>
            <p class="font-body-md text-on-surface-variant">Tu próxima aventura te espera. ¿Listo para explorar?</p>
        </div>
        <div class="bg-surface-container-low rounded-xl p-lg border border-outline-variant">
            <span class="font-label-sm uppercase tracking-widest text-primary font-bold">Viajes Realizados</span>
            <div class="text-4xl font-display-md text-primary mt-xs">{{ $proximosViajes->count() ?? 0 }}</div>
        </div>
    </div>
    
    <!-- Gráficas -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-xl mb-xl">
        <div class="bg-white rounded-xl p-lg border border-[#EBECF0] ocean-shadow">
            <h3 class="font-headline-md mb-lg">Viajes por Mes</h3>
            <canvas id="viajesChart" height="200"></canvas>
        </div>
        <div class="bg-white rounded-xl p-lg border border-[#EBECF0] ocean-shadow">
            <h3 class="font-headline-md mb-lg">Gastos por Mes</h3>
            <canvas id="gastosChart" height="200"></canvas>
        </div>
    </div>
    
    <!-- Próximos Viajes -->
    <section class="mb-xl">
        <div class="flex justify-between items-center mb-6">
            <h2 class="font-headline-lg text-on-background">Próximos Viajes</h2>
            <a href="{{ route('viajes.create') }}" class="text-primary font-label-lg flex items-center gap-1">
                Planificar Viaje
                <span class="material-symbols-outlined">arrow_forward</span>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-lg">
            @forelse($proximosViajes as $viaje)
                <div class="bg-white rounded-xl overflow-hidden border border-[#EBECF0] ocean-shadow">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ $viaje->destino->imagenes ? Storage::url($viaje->destino->imagenes) : 'https://placehold.co/400x300' }}" alt="{{ $viaje->destino->nombre }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-lg">
                        <h3 class="font-headline-md">{{ $viaje->destino->nombre }}</h3>
                        <div class="flex items-center gap-2 text-on-surface-variant text-sm mt-2">
                            <span class="material-symbols-outlined text-sm">calendar_today</span>
                            <span>{{ $viaje->fecha_inicio->format('d/m/Y') }} - {{ $viaje->fecha_fin->format('d/m/Y') }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-on-surface-variant text-sm mt-1">
                            <span class="material-symbols-outlined text-sm">person</span>
                            <span>{{ $viaje->cantidad_personas }} personas</span>
                        </div>
                        <div class="mt-4 pt-4 border-t border-[#EBECF0] flex justify-between items-center">
                            <span class="text-primary font-bold">${{ number_format($viaje->precio_total, 2) }}</span>
                            <a href="{{ route('viajes.show', $viaje) }}" class="text-primary-container font-label-sm">Ver detalles</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <span class="material-symbols-outlined text-6xl text-slate-300">luggage</span>
                    <p class="mt-4 text-slate-500">No tienes viajes programados</p>
                    <a href="{{ route('viajes.create') }}" class="mt-4 inline-block bg-primary text-white px-6 py-3 rounded-lg">Planificar mi primer viaje</a>
                </div>
            @endforelse
        </div>
    </section>
    
    <!-- Destinos Recomendados -->
    <section>
        <h2 class="font-headline-lg text-on-background mb-6">Destinos Recomendados para Ti</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-lg">
            @foreach($destinosRecomendados as $destino)
                <div class="bg-white rounded-xl overflow-hidden border border-[#EBECF0] ocean-shadow group cursor-pointer hover:scale-[1.02] transition-transform">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ $destino->imagenes ? Storage::url($destino->imagenes) : 'https://placehold.co/400x300' }}" alt="{{ $destino->nombre }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-lg">
                        <h3 class="font-headline-md">{{ $destino->nombre }}</h3>
                        <p class="text-on-surface-variant text-sm">{{ $destino->ciudad }}, {{ $destino->pais }}</p>
                        <button onclick="window.location='{{ route('viajes.create', ['destino' => $destino->id]) }}'" class="mt-4 w-full bg-primary text-white py-2 rounded-lg font-label-lg ocean-shadow hover:bg-on-primary-fixed-variant transition-colors">
                            Explorar
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
</div>

@push('scripts')
<script>
    // Gráfica de viajes por mes
    const viajesCtx = document.getElementById('viajesChart')?.getContext('2d');
    if (viajesCtx) {
        new Chart(viajesCtx, {
            type: 'bar',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                datasets: [{
                    label: 'Viajes',
                    data: @json($viajesPorMes->pluck('total')->toArray()),
                    backgroundColor: '#0052cc',
                    borderRadius: 8
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'top' } }
            }
        });
    }
    
    // Gráfica de gastos por mes
    const gastosCtx = document.getElementById('gastosChart')?.getContext('2d');
    if (gastosCtx) {
        new Chart(gastosCtx, {
            type: 'line',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                datasets: [{
                    label: 'Gastos ($)',
                    data: @json($gastosPorMes->pluck('total')->toArray()),
                    borderColor: '#fd8b00',
                    backgroundColor: 'rgba(253, 139, 0, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: { legend: { position: 'top' } }
            }
        });
    }
</script>
@endpush
@endsection