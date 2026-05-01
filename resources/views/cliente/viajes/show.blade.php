@extends('layouts.app')

@section('title', 'Detalle del Viaje - GlobalQuest')

@section('content')
<div class="max-w-[1280px] mx-auto px-6 py-8">
    <!-- Breadcrumb -->
    <div class="flex items-center gap-2 text-sm text-slate-500 mb-6">
        <a href="{{ route('dashboard') }}" class="hover:text-primary">Dashboard</a>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <a href="{{ route('viajes.index') }}" class="hover:text-primary">Mis Viajes</a>
        <span class="material-symbols-outlined text-sm">chevron_right</span>
        <span class="text-primary">Detalle del Viaje</span>
    </div>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Header Image -->
            <div class="relative rounded-2xl overflow-hidden h-64">
                <img src="{{ $viaje->destino->imagenes ? Storage::url($viaje->destino->imagenes) : 'https://placehold.co/1200x400/0052cc/white?text=' . urlencode($viaje->destino->nombre) }}" 
                     alt="{{ $viaje->destino->nombre }}" 
                     class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                <div class="absolute bottom-6 left-6 text-white">
                    <div class="flex items-center gap-2 text-sm mb-2">
                        <span class="material-symbols-outlined text-sm">location_on</span>
                        <span>{{ $viaje->destino->ciudad }}, {{ $viaje->destino->pais }}</span>
                    </div>
                    <h1 class="font-display-md">{{ $viaje->destino->nombre }}</h1>
                </div>
            </div>
            
            <!-- Itinerario -->
            <div class="bg-white rounded-xl p-6 border border-[#EBECF0] ocean-shadow">
                <h2 class="font-headline-md mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">schedule</span>
                    Itinerario del Viaje
                </h2>
                <div class="space-y-4">
                    <div class="flex flex-wrap gap-6 pb-4 border-b border-[#EBECF0]">
                        <div>
                            <p class="text-xs text-slate-400 uppercase">Fecha de inicio</p>
                            <p class="font-semibold">{{ $viaje->fecha_inicio->format('l, d \\d\\e F \\d\\e Y') }}</p>
                            <p class="text-sm text-slate-500">{{ $viaje->fecha_inicio->format('H:i') }} hrs</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 uppercase">Fecha de regreso</p>
                            <p class="font-semibold">{{ $viaje->fecha_fin->format('l, d \\d\\e F \\d\\e Y') }}</p>
                            <p class="text-sm text-slate-500">{{ $viaje->fecha_fin->format('H:i') }} hrs</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 uppercase">Duración</p>
                            <p class="font-semibold">{{ $viaje->fecha_inicio->diffInDays($viaje->fecha_fin) }} días</p>
                            <p class="text-sm text-slate-500">{{ $viaje->cantidad_personas }} viajeros</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-2">
                        <div class="flex gap-3">
                            <div class="w-12 h-12 bg-blue-50 rounded-xl flex items-center justify-center">
                                <span class="material-symbols-outlined text-primary">flight_takeoff</span>
                            </div>
                            <div>
                                <p class="font-semibold">Transporte</p>
                                <p class="text-sm text-slate-500">
                                    @if($viaje->transporte_id)
                                        Transporte reservado
                                    @else
                                        Transporte por definir
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="flex gap-3">
                            <div class="w-12 h-12 bg-orange-50 rounded-xl flex items-center justify-center">
                                <span class="material-symbols-outlined text-secondary-container">hotel</span>
                            </div>
                            <div>
                                <p class="font-semibold">Alojamiento</p>
                                <p class="text-sm text-slate-500">{{ $viaje->hospedaje->nombre }}</p>
                                <p class="text-xs text-slate-400">{{ $viaje->hospedaje->tipo }} · {{ $viaje->hospedaje->direccion }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Detalles de la Reserva -->
            <div class="bg-white rounded-xl p-6 border border-[#EBECF0] ocean-shadow">
                <h2 class="font-headline-md mb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">receipt</span>
                    Detalles de la Reserva
                </h2>
                <div class="space-y-3">
                    @foreach($viaje->detalles as $detalle)
                    <div class="flex justify-between py-2 border-b border-[#EBECF0] last:border-0">
                        <span class="text-slate-600">{{ $detalle->concepto }}</span>
                        <span class="font-semibold">${{ number_format($detalle->costo, 2) }}</span>
                    </div>
                    @endforeach
                    <div class="flex justify-between pt-3 mt-2 border-t-2 border-[#EBECF0]">
                        <span class="font-bold text-lg">Total</span>
                        <span class="font-bold text-xl text-primary">${{ number_format($viaje->precio_total, 2) }}</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status Card -->
            <div class="bg-gradient-to-r from-primary to-primary-container text-white rounded-xl p-6">
                <div class="flex items-center gap-3 mb-4">
                    <span class="material-symbols-outlined text-3xl">check_circle</span>
                    <div>
                        <p class="text-sm opacity-90">Estado de la reserva</p>
                        <p class="text-xl font-bold">Confirmado</p>
                    </div>
                </div>
                <p class="text-sm opacity-90">Se ha enviado un correo de confirmación a {{ auth()->user()->email }}</p>
            </div>
            
            <!-- Acciones Rápidas -->
            <div class="bg-white rounded-xl p-6 border border-[#EBECF0] ocean-shadow">
                <h3 class="font-headline-md mb-4">Acciones Rápidas</h3>
                <div class="space-y-3">
                    <a href="{{ route('viajes.pdf', $viaje) }}" target="_blank" 
                       class="flex items-center justify-between w-full px-4 py-3 bg-blue-50 text-primary rounded-lg hover:bg-blue-100 transition-colors">
                        <span class="flex items-center gap-2">
                            <span class="material-symbols-outlined">picture_as_pdf</span>
                            Descargar Itinerario PDF
                        </span>
                        <span class="material-symbols-outlined">download</span>
                    </a>
                    <button class="flex items-center justify-between w-full px-4 py-3 bg-slate-50 text-slate-600 rounded-lg hover:bg-slate-100 transition-colors">
                        <span class="flex items-center gap-2">
                            <span class="material-symbols-outlined">share</span>
                            Compartir viaje
                        </span>
                        <span class="material-symbols-outlined">share</span>
                    </button>
                    <button class="flex items-center justify-between w-full px-4 py-3 bg-slate-50 text-slate-600 rounded-lg hover:bg-slate-100 transition-colors">
                        <span class="flex items-center gap-2">
                            <span class="material-symbols-outlined">support_agent</span>
                            Contactar soporte
                        </span>
                        <span class="material-symbols-outlined">chevron_right</span>
                    </button>
                </div>
            </div>
            
            <!-- Hospedaje Info -->
            <div class="bg-white rounded-xl p-6 border border-[#EBECF0] ocean-shadow">
                <h3 class="font-headline-md mb-3">Información del Hospedaje</h3>
                <div class="flex items-start gap-3">
                    <div class="w-16 h-16 rounded-xl overflow-hidden flex-shrink-0">
                        @if($viaje->hospedaje->imagenes)
                            <img src="{{ Storage::url($viaje->hospedaje->imagenes) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                                <span class="material-symbols-outlined text-slate-400">hotel</span>
                            </div>
                        @endif
                    </div>
                    <div>
                        <p class="font-semibold">{{ $viaje->hospedaje->nombre }}</p>
                        <p class="text-sm text-slate-500">{{ $viaje->hospedaje->tipo }}</p>
                        <p class="text-xs text-slate-400 mt-1">{{ $viaje->hospedaje->direccion }}</p>
                    </div>
                </div>
            </div>
            
            <!-- ¿Necesitas Ayuda? -->
            <div class="bg-gradient-to-r from-secondary to-secondary-container text-white rounded-xl p-6">
                <div class="flex items-center gap-3 mb-3">
                    <span class="material-symbols-outlined text-3xl">support_agent</span>
                    <h3 class="font-headline-md">¿Necesitas ayuda?</h3>
                </div>
                <p class="text-sm opacity-90 mb-4">Nuestro equipo de soporte está disponible 24/7 para ayudarte con cualquier duda.</p>
                <button class="w-full bg-white/20 backdrop-blur py-2 rounded-lg font-semibold hover:bg-white/30 transition-colors">
                    Contactar Soporte
                </button>
            </div>
        </div>
    </div>
</div>
@endsection