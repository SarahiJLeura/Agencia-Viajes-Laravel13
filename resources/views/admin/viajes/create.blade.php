@extends('layouts.app')

@section('title', 'Nuevo Viaje - Admin')

@section('content')
<div class="max-w-[1280px] mx-auto px-6 py-8">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <p class="text-slate-500">
                El administrador puede registrar viajes para cualquier cliente
            </p>
        </div>

        <a href="{{ route('admin.viajes.index') }}"
           class="px-5 py-3 rounded-xl border border-slate-300 hover:bg-slate-100 transition">
            Volver
        </a>
    </div>

    @if(session('error'))
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 mb-6">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST"
          action="{{ route('admin.viajes.store') }}"
          class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        @csrf

        <!-- FORMULARIO -->
        <div class="lg:col-span-2 space-y-6">

            <!-- CLIENTE -->
            <div class="bg-white rounded-xl p-6 border border-[#EBECF0] ocean-shadow">

                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-blue-700 text-white rounded-full flex items-center justify-center font-bold">
                        1
                    </div>

                    <h2 class="font-headline-md">
                        Selecciona un cliente
                    </h2>
                </div>

                <select name="user_id"
                        class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6]"
                        required>

                    <option value="">
                        Selecciona un cliente
                    </option>

                    @foreach($usuarios as $usuario)
                        <option value="{{ $usuario->id }}">
                            {{ $usuario->name }} - {{ $usuario->email }}
                        </option>
                    @endforeach
                </select>

                @error('user_id')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- DESTINO -->
            <div class="bg-white rounded-xl p-6 border border-[#EBECF0] ocean-shadow">

                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-blue-700 text-white rounded-full flex items-center justify-center font-bold">
                        2
                    </div>

                    <h2 class="font-headline-md">
                        Selecciona destino
                    </h2>
                </div>

                <select name="destino_id"
                        id="destino_id"
                        class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6]"
                        required>

                    <option value="">
                        Selecciona un destino
                    </option>

                    @foreach($destinos as $destino)
                        <option value="{{ $destino->id }}">
                            {{ $destino->nombre }}
                            -
                            {{ $destino->ciudad }},
                            {{ $destino->pais }}
                        </option>
                    @endforeach
                </select>

                @error('destino_id')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- FECHAS -->
            <div class="bg-white rounded-xl p-6 border border-[#EBECF0] ocean-shadow">

                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-blue-700 text-white rounded-full flex items-center justify-center font-bold">
                        3
                    </div>

                    <h2 class="font-headline-md">
                        Fechas del viaje
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="block mb-2 font-semibold">
                            Fecha inicio
                        </label>

                        <input type="date"
                               name="fecha_inicio"
                               id="fecha_inicio"
                               class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6]"
                               required>

                        @error('fecha_inicio')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold">
                            Fecha fin
                        </label>

                        <input type="date"
                               name="fecha_fin"
                               id="fecha_fin"
                               class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6]"
                               required>

                        @error('fecha_fin')
                            <p class="text-red-500 text-sm mt-2">
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                </div>
            </div>

            <!-- HOSPEDAJES -->
            <div class="bg-white rounded-xl p-6 border border-[#EBECF0] ocean-shadow">

                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-blue-700 text-white rounded-full flex items-center justify-center font-bold">
                        4
                    </div>

                    <h2 class="font-headline-md">
                        Hospedaje
                    </h2>
                </div>

                <div id="hospedajes-container">
                    <p class="text-slate-400 text-center py-6">
                        Selecciona un destino primero
                    </p>
                </div>

                @error('hospedaje_id')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- TRANSPORTES -->
            <div class="bg-white rounded-xl p-6 border border-[#EBECF0] ocean-shadow">

                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-blue-700 text-white rounded-full flex items-center justify-center font-bold">
                        5
                    </div>

                    <h2 class="font-headline-md">
                        Transporte
                    </h2>
                </div>

                <div id="transportes-container">
                    <p class="text-slate-400 text-center py-6">
                        Cargando transportes...
                    </p>
                </div>

                @error('transporte_id')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- DETALLES -->
            <div class="bg-white rounded-xl p-6 border border-[#EBECF0] ocean-shadow">

                <div class="flex items-center gap-3 mb-4">
                    <div class="w-8 h-8 bg-blue-700 text-white rounded-full flex items-center justify-center font-bold">
                        6
                    </div>

                    <h2 class="font-headline-md">
                        Detalles
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    <div>
                        <label class="block mb-2 font-semibold">
                            Personas
                        </label>

                        <input type="number"
                               name="cantidad_personas"
                               value="1"
                               min="1"
                               class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6]"
                               required>
                    </div>

                    <div>
                        <label class="block mb-2 font-semibold">
                            Tipo viaje
                        </label>

                        <select name="tipo_viaje"
                                class="w-full px-4 py-3 rounded-lg border border-[#DFE1E6]"
                                required>

                            <option value="normal">
                                Normal
                            </option>

                            <option value="redondo">
                                Redondo
                            </option>
                        </select>
                    </div>

                </div>
            </div>

        </div>

        <!-- SIDEBAR -->
        <div class="lg:col-span-1">

            <div class="sticky top-24">

                <div class="bg-white rounded-xl border border-[#EBECF0] ocean-shadow overflow-hidden">

                    <div class="bg-gradient-to-r from-blue-700 to-blue-500 text-white p-5">
                        <h3 class="font-bold text-lg">
                            Confirmar viaje
                        </h3>
                    </div>

                    <div class="p-5">

                        <button type="submit"
                                class="w-full bg-orange-500 hover:bg-orange-600 text-white py-4 rounded-xl font-bold transition">

                            Guardar Viaje
                        </button>

                    </div>

                </div>

            </div>

        </div>

    </form>
</div>

@push('scripts')
<script>

const destinoSelect = document.getElementById('destino_id');
const hospedajesContainer = document.getElementById('hospedajes-container');
const transportesContainer = document.getElementById('transportes-container');

destinoSelect.addEventListener('change', async () => {

    const destinoId = destinoSelect.value;

    if(!destinoId){
        hospedajesContainer.innerHTML =
            `<p class="text-slate-400 text-center py-6">
                Selecciona un destino
            </p>`;
        return;
    }

    // HOSPEDAJES
    try {

        const hospedajesResponse =
            await fetch(`/api/hospedajes?destino_id=${destinoId}`);

        const hospedajes =
            await hospedajesResponse.json();

        hospedajesContainer.innerHTML = `
            <div class="grid gap-3">

                ${hospedajes.map(h => `

                    <label class="border rounded-xl p-4 flex gap-3 hover:bg-slate-50 cursor-pointer">

                        <input type="radio"
                               name="hospedaje_id"
                               value="${h.id}">

                        <div>
                            <p class="font-semibold">
                                ${h.nombre}
                            </p>

                            <p class="text-sm text-slate-500">
                                ${h.tipo}
                            </p>
                        </div>

                    </label>

                `).join('')}

            </div>
        `;

    } catch(error){

        hospedajesContainer.innerHTML =
            `<p class="text-red-500">
                Error cargando hospedajes
            </p>`;
    }

    // TRANSPORTES
    try {

        const transportesResponse =
            await fetch('/api/transportes');

        const response =
            await transportesResponse.json();

        const transportes =
            response.data;

        transportesContainer.innerHTML = `
            <div class="grid gap-3">

                ${transportes.map(t => `

                    <label class="border rounded-xl p-4 flex gap-3 hover:bg-slate-50 cursor-pointer">

                        <input type="radio"
                               name="transporte_id"
                               value="${t.id}">

                        <div>
                            <p class="font-semibold">
                                ${t.tipo}
                            </p>

                            <p class="text-sm text-slate-500">
                                ${t.modelo}
                            </p>

                            <p class="text-xs text-slate-400">
                                ${t.placa}
                            </p>
                        </div>

                    </label>

                `).join('')}

            </div>
        `;

    } catch(error){

        transportesContainer.innerHTML =
            `<p class="text-red-500">
                Error cargando transportes
            </p>`;
    }

});

</script>
@endpush

@endsection