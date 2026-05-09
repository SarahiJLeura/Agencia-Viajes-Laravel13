@extends('layouts.app')

@section('title', 'Planificar Viaje - GlobalQuest')

@section('content')
<div class="max-w-[1280px] mx-auto px-6 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="font-display-md text-on-background">Planificar un Nuevo Viaje</h1>
        <p class="text-on-surface-variant">Completa los detalles para comenzar tu aventura</p>
    </div>
    
    @if(session('error'))
        <div class="bg-error-container border border-error text-error rounded-xl p-4 mb-6">
            {{ session('error') }}
        </div>
    @endif
    
    <form method="POST" action="{{ route('viajes.store') }}" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf
        
        <!-- Formulario Principal -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Paso 1: Destino -->
            <div class="bg-white rounded-xl p-6 border border-[#EBECF0] ocean-shadow">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-blue-700 text-white rounded-full flex items-center justify-center font-bold">1</div>
                    <h2 class="font-headline-md">¿A dónde quieres viajar?</h2>
                </div>
                
                <div class="relative">
                    <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">search</span>
                    <select name="destino_id" id="destino_id" class="w-full pl-12 pr-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" required>
                        <option value="">Selecciona un destino...</option>
                        @foreach($destinos as $destino)
                            <option value="{{ $destino->id }}" {{ request('destino_id') == $destino->id ? 'selected' : '' }}>
                                {{ $destino->nombre }} - {{ $destino->ciudad }}, {{ $destino->pais }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error('destino_id') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
                
                <!-- Destino Preview -->
                <div id="destino-preview" class="mt-4 hidden">
                    <div class="flex items-center gap-3 p-3 bg-blue-50 rounded-lg">
                        <span class="material-symbols-outlined text-primary">location_on</span>
                        <div>
                            <p class="font-semibold text-primary">Destino seleccionado</p>
                            <p id="destino-nombre" class="text-sm"></p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Paso 2: Fechas -->
            <div class="bg-white rounded-xl p-6 border border-[#EBECF0] ocean-shadow">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-blue-700 text-white rounded-full flex items-center justify-center font-bold">2</div>
                    <h2 class="font-headline-md">¿Cuándo quieres viajar?</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-label-lg mb-2">Fecha de inicio *</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" required>
                        @error('fecha_inicio') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block font-label-lg mb-2">Fecha de regreso *</label>
                        <input type="date" name="fecha_fin" id="fecha_fin" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" required>
                        @error('fecha_fin') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>
                
                <div id="date-info" class="mt-3 text-sm text-slate-500 hidden">
                    <span class="material-symbols-outlined text-sm align-middle">info</span>
                    Duración: <span id="duracion"></span> días
                </div>
            </div>
            
            <!-- Paso 3: Alojamiento -->
            <div class="bg-white rounded-xl p-6 border border-[#EBECF0] ocean-shadow">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-blue-700 text-white rounded-full flex items-center justify-center font-bold">3</div>
                    <h2 class="font-headline-md">Selecciona tu alojamiento</h2>
                </div>
                
                <div id="hospedajes-container">
                    <p class="text-slate-400 text-center py-8">Primero selecciona un destino</p>
                </div>
                @error('hospedaje_id') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
            </div>
            
            <!-- Paso 4: Detalles del viaje -->
            <div class="bg-white rounded-xl p-6 border border-[#EBECF0] ocean-shadow">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-blue-700 text-white rounded-full flex items-center justify-center font-bold">4</div>
                    <h2 class="font-headline-md">Detalles del viaje</h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block font-label-lg mb-2">Número de personas *</label>
                        <input type="number" name="cantidad_personas" id="cantidad_personas" min="1" max="20" value="2" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" required>
                        @error('cantidad_personas') <p class="text-error text-sm mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block font-label-lg mb-2">Tipo de viaje *</label>
                        <select name="tipo_viaje" class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6] focus:ring-2 focus:ring-primary" required>
                            <option value="redondo">Redondo</option>
                            <option value="normal">Normal</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 border border-[#EBECF0] ocean-shadow">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-blue-700 text-white rounded-full flex items-center justify-center font-bold">4</div>
                    <h2 class="font-headline-md">Selecciona tu transporte</h2>
                </div>

                <div id="transportes-container">
                    <p class="text-slate-400 text-center py-8">Primero selecciona un destino</p>
                </div>

                @error('transporte_id')
                    <p class="text-error text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>
        
        <!-- Sidebar - Resumen -->
        <div class="lg:col-span-1">
            <div class="sticky top-24 space-y-6">
                <div class="bg-white rounded-xl border border-[#EBECF0] ocean-shadow overflow-hidden">
                    <div class="bg-gradient-to-r from-primary to-primary-container p-4 text-white">
                        <h3 class="font-headline-md flex items-center gap-2">
                            <span class="material-symbols-outlined">receipt</span>
                            Resumen del Viaje
                        </h3>
                    </div>
                    <div class="p-5 space-y-4">
                        <div>
                            <p class="text-xs text-slate-400 uppercase">Destino</p>
                            <p id="resumen-destino" class="font-semibold">—</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 uppercase">Fechas</p>
                            <p id="resumen-fechas" class="font-semibold">—</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 uppercase">Alojamiento</p>
                            <p id="resumen-hospedaje" class="font-semibold">—</p>
                            <p id="resumen-hospedaje-tipo" class="text-xs text-slate-400"></p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400 uppercase">Viajeros</p>
                            <p id="resumen-personas" class="font-semibold">—</p>
                        </div>
                        <div class="pt-3 border-t border-[#EBECF0]">
                            <div class="flex justify-between">
                                <span class="text-slate-600">Subtotal</span>
                                <span id="resumen-subtotal" class="font-semibold">$0</span>
                            </div>
                            <div class="flex justify-between mt-1">
                                <span class="text-slate-600">Impuestos (10%)</span>
                                <span id="resumen-impuestos" class="font-semibold">$0</span>
                            </div>
                            <div class="flex justify-between mt-3 pt-3 border-t border-[#EBECF0]">
                                <span class="font-bold text-lg">Total</span>
                                <span id="resumen-total" class="font-bold text-xl text-primary">$0</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <button type="submit" class="w-full bg-orange-500 text-white py-4 rounded-xl font-label-lg ocean-shadow hover:bg-orange-700 transition-colors active:scale-95">
                    Confirmar y Enviar
                </button>
                
                <p class="text-xs text-slate-400 text-center">
                    Al confirmar, recibirás un correo con el PDF de tu itinerario
                </p>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Datos de hospedajes por destino
    const hospedajesPorDestino = @json($hospedajesPorDestino ?? []);
    const transportesContainer = document.getElementById('transportes-container');
    
    // Referencias a elementos
    const destinoSelect = document.getElementById('destino_id');
    const hospedajesContainer = document.getElementById('hospedajes-container');
    const fechaInicio = document.getElementById('fecha_inicio');
    const fechaFin = document.getElementById('fecha_fin');
    const cantidadPersonas = document.getElementById('cantidad_personas');
    
    // Establecer fecha mínima = hoy
    const today = new Date().toISOString().split('T')[0];
    fechaInicio.min = today;
    fechaFin.min = today;
    
    // Actualizar fecha mínima de fin cuando cambia inicio
    fechaInicio.addEventListener('change', () => {
        fechaFin.min = fechaInicio.value;
        if (fechaFin.value && fechaFin.value < fechaInicio.value) {
            fechaFin.value = fechaInicio.value;
        }
        actualizarResumen();
    });
    
    fechaFin.addEventListener('change', actualizarResumen);
    cantidadPersonas.addEventListener('input', actualizarResumen);
    
    // Cargar hospedajes y transportes al seleccionar destino
    destinoSelect.addEventListener('change', async () => {
        const destinoId = destinoSelect.value;

        if (!destinoId) {
            hospedajesContainer.innerHTML = '<p class="text-slate-400 text-center py-8">Selecciona un destino primero</p>';
            document.getElementById('destino-preview').classList.add('hidden');
            transportesContainer.innerHTML = '<p class="text-slate-400 text-center py-8">Selecciona un destino primero</p>';
            actualizarResumen();
            return;
        }

        // Preview destino
        const destinoNombre = destinoSelect.options[destinoSelect.selectedIndex]?.text;
        document.getElementById('destino-nombre').innerText = destinoNombre;
        document.getElementById('destino-preview').classList.remove('hidden');

        try {
            // HOSPEDAJES
            const hospedajesResponse = await fetch(`/api/hospedajes?destino_id=${destinoId}`);

            if (!hospedajesResponse.ok) {
                throw new Error('Error al cargar hospedajes');
            }

            const hospedajes = await hospedajesResponse.json();

            if (!hospedajes.length) {
                hospedajesContainer.innerHTML = `
                    <div class="text-center py-8">
                        <span class="material-symbols-outlined text-4xl text-slate-300">hotel</span>
                        <p class="text-slate-400 mt-2">No hay hospedajes disponibles</p>
                    </div>
                `;
            } else {
                hospedajesContainer.innerHTML = `
                    <div class="grid grid-cols-1 gap-3">
                        ${hospedajes.map(h => `
                            <label class="flex items-start gap-3 p-4 border rounded-xl cursor-pointer hover:bg-slate-50 transition-colors">
                                <input type="radio" name="hospedaje_id" value="${h.id}" class="mt-1" onchange="actualizarResumen()">
                                <div class="flex-1">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <p class="font-semibold">${h.nombre}</p>
                                            <p class="text-sm text-slate-500">${h.tipo}</p>
                                            <p class="text-xs text-slate-400 mt-1">Capacidad: ${h.capacidad} personas</p>
                                        </div>
                                        <p class="font-bold text-primary">$${h.precio_base || 100}/noche</p>
                                    </div>
                                    <p class="text-sm text-slate-500 mt-2">📍 ${h.direccion}</p>
                                </div>
                            </label>
                        `).join('')}
                    </div>
                `;
            }

            // TRANSPORTES
            const transportesResponse = await fetch(`/api/transportes`);
            if (!transportesResponse.ok) {
                throw new Error('Error al cargar transportes');
            }

            const response = await transportesResponse.json();
            const transportes = response.data;

            if (!transportes.length) {
                transportesContainer.innerHTML = `
                    <p class="text-slate-400 text-center py-8">No hay transportes disponibles</p>
                `;
            } else {
                transportesContainer.innerHTML = `
                    <div class="grid grid-cols-1 gap-3">
                        ${transportes.map(t => `
                            <label class="flex items-start gap-3 p-4 border rounded-xl cursor-pointer hover:bg-slate-50 transition-colors">
                                <input type="radio" name="transporte_id" value="${t.id}" class="mt-1" onchange="actualizarResumen()">
                                <div class="flex-1">
                                    <p class="font-semibold">${t.tipo}</p>
                                    <p class="text-sm text-slate-500">Modelo: ${t.modelo ?? 'N/A'}</p>
                                    <p class="text-xs text-slate-400">Capacidad: ${t.capacidad}</p>
                                    <p class="text-xs text-slate-400">Placa: ${t.placa}</p>
                                </div>
                            </label>
                        `).join('')}
                    </div>
                `;
            }

            actualizarResumen();

        } catch (error) {
            console.error('Error cargando datos:', error);

            hospedajesContainer.innerHTML = `
                <p class="text-error text-center py-8">Error al cargar hospedajes</p>
            `;

            transportesContainer.innerHTML = `
                <p class="text-error text-center py-8">Error al cargar transportes</p>
            `;
        }
    });
    
    // Actualizar resumen y cálculos
    function actualizarResumen() {
        // Destino
        const destinoText = destinoSelect.options[destinoSelect.selectedIndex]?.text || '—';
        document.getElementById('resumen-destino').innerText = destinoText.split(' - ')[0];
        
        // Fechas
        if (fechaInicio.value && fechaFin.value) {
            const inicio = new Date(fechaInicio.value);
            const fin = new Date(fechaFin.value);
            const diffTime = Math.abs(fin - inicio);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            document.getElementById('resumen-fechas').innerHTML = `${formatDate(fechaInicio.value)} - ${formatDate(fechaFin.value)}<br><span class="text-xs text-slate-400">${diffDays} días</span>`;
            document.getElementById('date-info').classList.remove('hidden');
            document.getElementById('duracion').innerText = diffDays;
            
            // Calcular costo de hospedaje
            const hospedajeSeleccionado = document.querySelector('input[name="hospedaje_id"]:checked');
            if (hospedajeSeleccionado && diffDays > 0) {
                const precioNoche = 100; // Esto debería venir del hospedaje
                const subtotal = precioNoche * diffDays * (parseInt(cantidadPersonas.value) || 1);
                const impuestos = subtotal * 0.1;
                const total = subtotal + impuestos;
                
                document.getElementById('resumen-subtotal').innerText = `$${subtotal.toLocaleString()}`;
                document.getElementById('resumen-impuestos').innerText = `$${impuestos.toLocaleString()}`;
                document.getElementById('resumen-total').innerHTML = `$${total.toLocaleString()}`;
            }
        } else {
            document.getElementById('resumen-fechas').innerText = '—';
        }
        
        // Personas
        document.getElementById('resumen-personas').innerText = cantidadPersonas.value + ' ' + (cantidadPersonas.value == 1 ? 'persona' : 'personas');
        
        // Hospedaje
        const hospedajeSeleccionado = document.querySelector('input[name="hospedaje_id"]:checked');
        if (hospedajeSeleccionado) {
            const label = hospedajeSeleccionado.closest('label');
            const nombre = label.querySelector('.font-semibold')?.innerText || 'Seleccionado';
            const tipo = label.querySelector('.text-sm.text-slate-500')?.innerText || '';
            document.getElementById('resumen-hospedaje').innerText = nombre;
            document.getElementById('resumen-hospedaje-tipo').innerText = tipo;
        } else {
            document.getElementById('resumen-hospedaje').innerText = '—';
            document.getElementById('resumen-hospedaje-tipo').innerText = '';
        }
    }
    
    function formatDate(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('es-ES', { day: 'numeric', month: 'short' });
    }
    
    // Inicializar si hay valores antiguos
    if (destinoSelect.value) {
        destinoSelect.dispatchEvent(new Event('change'));
    }
    
    // Función para obtener valores antiguos
    function old(field) {
        return {{ json_encode(old('hospedaje_id')) }};
    }
</script>
@endpush
@endsection