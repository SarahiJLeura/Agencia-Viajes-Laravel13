@extends('layouts.app')

@section('title', 'Destinos - GlobalQuest')

@section('content')
<div class="max-w-[1280px] mx-auto px-6 py-8">
    <!-- Header -->
    <div class="text-center mb-12">
        <h1 class="font-display-md text-on-background">Explora Nuestros Destinos</h1>
        <p class="text-on-surface-variant mt-2 max-w-2xl mx-auto">Descubre los lugares más increíbles del mundo y comienza a planificar tu próxima aventura</p>
    </div>
    
    <!-- Filtros -->
    <div class="flex flex-wrap gap-3 mb-8 justify-center">
        <button class="filter-btn px-5 py-2 rounded-full bg-primary text-white" data-filter="all">Todos</button>
        <button class="filter-btn px-5 py-2 rounded-full bg-slate-100 text-slate-600 hover:bg-primary/10" data-filter="playa">🏖️ Playa</button>
        <button class="filter-btn px-5 py-2 rounded-full bg-slate-100 text-slate-600 hover:bg-primary/10" data-filter="montaña">🏔️ Montaña</button>
        <button class="filter-btn px-5 py-2 rounded-full bg-slate-100 text-slate-600 hover:bg-primary/10" data-filter="ciudad">🌆 Ciudad</button>
        <button class="filter-btn px-5 py-2 rounded-full bg-slate-100 text-slate-600 hover:bg-primary/10" data-filter="cultura">🏛️ Cultura</button>
    </div>
    
    <!-- Grid de Destinos -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($destinos as $destino)
        <div class="destino-card bg-white rounded-xl overflow-hidden border border-[#EBECF0] ocean-shadow group hover:scale-[1.02] transition-all cursor-pointer" data-category="{{ $destino->categoria ?? 'ciudad' }}">
            <div class="h-64 overflow-hidden relative">
                <img src="{{ $destino->imagenes ? Storage::url($destino->imagenes) : 'https://placehold.co/400x300/0052cc/white?text=' . urlencode($destino->nombre) }}" 
                     alt="{{ $destino->nombre }}" 
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                <div class="absolute bottom-4 left-4 text-white opacity-0 group-hover:opacity-100 transition-opacity">
                    <a href="{{ route('viajes.create', ['destino_id' => $destino->id]) }}" 
                       class="px-4 py-2 bg-white text-primary rounded-lg text-sm font-semibold hover:bg-primary hover:text-white transition-colors">
                        Ver Paquetes
                    </a>
                </div>
            </div>
            <div class="p-5">
                <div class="flex items-center justify-between mb-2">
                    <div class="flex items-center gap-1 text-slate-500 text-sm">
                        <span class="material-symbols-outlined text-sm">location_on</span>
                        <span>{{ $destino->ciudad }}, {{ $destino->pais }}</span>
                    </div>
                    <div class="flex gap-0.5">
                        <span class="material-symbols-outlined text-sm text-yellow-400">star</span>
                        <span class="material-symbols-outlined text-sm text-yellow-400">star</span>
                        <span class="material-symbols-outlined text-sm text-yellow-400">star</span>
                        <span class="material-symbols-outlined text-sm text-yellow-400">star</span>
                        <span class="material-symbols-outlined text-sm text-yellow-400">star_half</span>
                    </div>
                </div>
                <h3 class="font-headline-md mb-2">{{ $destino->nombre }}</h3>
                <p class="text-slate-500 text-sm line-clamp-2">{{ $destino->descripcion ?? 'Descubre este increíble destino lleno de magia y aventuras únicas.' }}</p>
                <div class="mt-4 pt-3 border-t border-[#EBECF0] flex items-center justify-between">
                    <div>
                        <p class="text-xs text-slate-400">Desde</p>
                        <p class="text-xl font-bold text-primary">${{ number_format($destino->precio_desde ?? 499, 0) }}</p>
                    </div>
                    <button onclick="window.location='{{ route('viajes.create', ['destino_id' => $destino->id]) }}'" 
                            class="px-4 py-2 border-2 border-primary text-primary rounded-lg text-sm font-semibold hover:bg-primary hover:text-white transition-colors">
                        Reservar
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    
    <!-- Paginación -->
    <div class="mt-8">
        {{ $destinos->links() }}
    </div>
</div>

@push('scripts')
<script>
    document.querySelectorAll('.filter-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const filter = btn.dataset.filter;
            
            // Update active styles
            document.querySelectorAll('.filter-btn').forEach(b => {
                b.classList.remove('bg-primary', 'text-white');
                b.classList.add('bg-slate-100', 'text-slate-600');
            });
            btn.classList.remove('bg-slate-100', 'text-slate-600');
            btn.classList.add('bg-primary', 'text-white');
            
            // Filter destinations
            document.querySelectorAll('.destino-card').forEach(card => {
                if (filter === 'all' || card.dataset.category === filter) {
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