@extends('layouts.app')

@section('title', 'Mis Viajes - GlobalQuest')

@section('content')
<div class="max-w-[1280px] mx-auto px-6 py-8">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h1 class="font-display-md text-on-background">Mis Viajes</h1>
            <p class="text-on-surface-variant">Gestiona todas tus aventuras y reservas</p>
        </div>
        <a href="{{ route('viajes.create') }}" class="bg-blue-700 text-white px-5 py-2 rounded-lg flex items-center gap-2 hover:bg-on-primary-fixed-variant transition-colors">
            <span class="material-symbols-outlined">add</span>
            Nuevo Viaje
        </a>
    </div>
    
    <!-- Filtros -->
    <div class="flex gap-3 mb-6 overflow-x-auto pb-2">
        <button class="filter-btn px-4 py-2 rounded-full text-sm font-semibold bg-blue-700 text-white" data-filter="all">Todos</button>
        <button class="filter-btn px-4 py-2 rounded-full text-sm font-semibold bg-slate-100 text-slate-600 hover:bg-blue-700/10" data-filter="upcoming">Próximos</button>
        <button class="filter-btn px-4 py-2 rounded-full text-sm font-semibold bg-slate-100 text-slate-600 hover:bg-blue-700/10" data-filter="current">En curso</button>
        <button class="filter-btn px-4 py-2 rounded-full text-sm font-semibold bg-slate-100 text-slate-600 hover:bg-blue-700/10" data-filter="completed">Completados</button>
    </div>
    
    @if($viajes->count() > 0)
        <div class="space-y-4">
            @foreach($viajes as $viaje)
                @php
                    $status = 'upcoming';
                    $statusText = 'Próximo';
                    $statusColor = 'blue';
                    $daysUntil = now()->diffInDays($viaje->fecha_inicio, false);
                    
                    if($viaje->fecha_inicio <= now() && $viaje->fecha_fin >= now()) {
                        $status = 'current';
                        $statusText = 'En curso';
                        $statusColor = 'green';
                    } elseif($viaje->fecha_fin < now()) {
                        $status = 'completed';
                        $statusText = 'Completado';
                        $statusColor = 'gray';
                    } elseif($daysUntil <= 7 && $daysUntil > 0) {
                        $statusText = '¡Próximamente!';
                        $statusColor = 'orange';
                    }
                @endphp
                
                <div class="bg-white rounded-xl border border-[#EBECF0] ocean-shadow hover:shadow-lg transition-all viaje-card" data-status="{{ $status }}">
                    <div class="flex flex-col md:flex-row">
                        <!-- Imagen -->
                        <div class="md:w-64 h-48 md:h-auto relative">
                            <img src="{{ $viaje->destino->imagenes ? Storage::url($viaje->destino->imagenes) : 'https://placehold.co/400x300/0052cc/white?text=' . urlencode($viaje->destino->nombre) }}" 
                                 alt="{{ $viaje->destino->nombre }}" 
                                 class="w-full h-full object-cover rounded-t-xl md:rounded-l-xl md:rounded-r-none">
                            <div class="absolute top-4 left-4 px-3 py-1 rounded-full text-xs font-bold bg-{{ $statusColor }}-500 text-white">
                                {{ $statusText }}
                            </div>
                        </div>
                        
                        <!-- Detalles -->
                        <div class="flex-1 p-6">
                            <div class="flex flex-wrap justify-between items-start gap-4">
                                <div>
                                    <div class="flex items-center gap-2 text-slate-500 text-sm mb-1">
                                        <span class="material-symbols-outlined text-sm">location_on</span>
                                        <span>{{ $viaje->destino->ciudad }}, {{ $viaje->destino->pais }}</span>
                                    </div>
                                    <h3 class="font-headline-lg text-on-background">{{ $viaje->destino->nombre }}</h3>
                                    <div class="flex flex-wrap gap-4 mt-3">
                                        <div class="flex items-center gap-1 text-sm text-slate-500">
                                            <span class="material-symbols-outlined text-sm">calendar_today</span>
                                            <span>{{ $viaje->fecha_inicio->format('d/m/Y') }} - {{ $viaje->fecha_fin->format('d/m/Y') }}</span>
                                        </div>
                                        <div class="flex items-center gap-1 text-sm text-slate-500">
                                            <span class="material-symbols-outlined text-sm">hotel</span>
                                            <span>{{ $viaje->hospedaje->nombre }}</span>
                                        </div>
                                        <div class="flex items-center gap-1 text-sm text-slate-500">
                                            <span class="material-symbols-outlined text-sm">group</span>
                                            <span>{{ $viaje->cantidad_personas }} personas</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-slate-400">Total del viaje</p>
                                    <p class="text-2xl font-bold text-primary">${{ number_format($viaje->precio_total, 0) }}</p>
                                    <p class="text-xs text-slate-400">+ impuestos incluidos</p>
                                </div>
                            </div>
                            
                            <div class="flex flex-wrap gap-3 mt-6 pt-4 border-t border-[#EBECF0]">
                                <a href="{{ route('viajes.show', $viaje) }}" class="px-4 py-2 bg-blue-700 text-white rounded-lg text-sm font-semibold hover:bg-on-primary-fixed-variant transition-colors">
                                    Ver Detalles
                                </a>
                                <a href="{{ route('viajes.pdf', $viaje) }}" target="_blank" class="px-4 py-2 border-2 border-primary text-primary rounded-lg text-sm font-semibold hover:bg-blue-700/10 transition-colors flex items-center gap-1">
                                    <span class="material-symbols-outlined text-sm">picture_as_pdf</span>
                                    Descargar PDF
                                </a>
                                @if($status == 'upcoming')
                                    <button class="px-4 py-2 border-2 border-error text-error rounded-lg text-sm font-semibold hover:bg-error/10 transition-colors">
                                        Cancelar Viaje
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <div class="mt-8">
            {{ $viajes->links() }}
        </div>
    @else
        <div class="bg-white rounded-xl p-12 text-center border border-[#EBECF0] ocean-shadow">
            <span class="material-symbols-outlined text-6xl text-slate-300">luggage</span>
            <h3 class="font-headline-md mt-4 text-slate-500">No tienes viajes registrados</h3>
            <p class="text-slate-400 mt-2">¡Es momento de planificar tu próxima aventura!</p>
            <a href="{{ route('viajes.create') }}" class="inline-block mt-6 bg-primary text-white px-6 py-3 rounded-lg font-semibold hover:bg-on-primary-fixed-variant transition-colors">
                Planificar mi primer viaje
            </a>
        </div>
    @endif
</div>

@push('scripts')
<script>
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const filter = btn.dataset.filter;
            
            // Update active button styles
            document.querySelectorAll('.filter-btn').forEach(b => {
                b.classList.remove('bg-primary', 'text-white');
                b.classList.add('bg-slate-100', 'text-slate-600');
            });
            btn.classList.remove('bg-slate-100', 'text-slate-600');
            btn.classList.add('bg-primary', 'text-white');
            
            // Filter cards
            document.querySelectorAll('.viaje-card').forEach(card => {
                if (filter === 'all' || card.dataset.status === filter) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });
</script>
@endpush
@endsection