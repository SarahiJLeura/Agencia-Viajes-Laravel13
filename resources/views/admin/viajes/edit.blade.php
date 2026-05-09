@extends('layouts.app')

@section('title', 'Editar Viaje - Admin')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-8">

    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-slate-800">
            Editar Viaje #{{ $viaje->id }}
        </h1>

        <p class="text-slate-500 mt-1">
            Modifica la información del viaje
        </p>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 mb-6">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ route('admin.viajes.update', $viaje) }}"
        method="POST"
        class="space-y-6"
    >
        @csrf
        @method('PUT')

        <!-- Card -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

            <!-- Cliente -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Cliente
                </label>

                <input
                    type="text"
                    value="{{ $viaje->user->name }} - {{ $viaje->user->email }}"
                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-slate-100"
                    disabled
                >
            </div>

            <!-- Destino -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Destino
                </label>

                <select
                    name="destino_id"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500"
                    required
                >
                    @foreach($destinos as $destino)
                        <option
                            value="{{ $destino->id }}"
                            {{ $viaje->destino_id == $destino->id ? 'selected' : '' }}
                        >
                            {{ $destino->nombre }} - {{ $destino->ciudad }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Hospedaje -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Hospedaje
                </label>

                <select
                    name="hospedaje_id"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500"
                    required
                >
                    @foreach($hospedajes as $hospedaje)
                        <option
                            value="{{ $hospedaje->id }}"
                            {{ $viaje->hospedaje_id == $hospedaje->id ? 'selected' : '' }}
                        >
                            {{ $hospedaje->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Transporte -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-slate-700 mb-2">
                    Transporte
                </label>

                <select
                    name="transporte_id"
                    class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500"
                >
                    @foreach($transportes as $transporte)
                        <option
                            value="{{ $transporte->id }}"
                            {{ $viaje->transporte_id == $transporte->id ? 'selected' : '' }}
                        >
                            {{ $transporte->tipo }} - {{ $transporte->modelo }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Fechas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Fecha Inicio
                    </label>

                    <input
                        type="date"
                        name="fecha_inicio"
                        value="{{ $viaje->fecha_inicio->format('Y-m-d') }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500"
                        required
                    >
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Fecha Fin
                    </label>

                    <input
                        type="date"
                        name="fecha_fin"
                        value="{{ $viaje->fecha_fin->format('Y-m-d') }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500"
                        required
                    >
                </div>

            </div>

            <!-- Personas y tipo -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Cantidad de Personas
                    </label>

                    <input
                        type="number"
                        name="cantidad_personas"
                        min="1"
                        value="{{ $viaje->cantidad_personas }}"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500"
                        required
                    >
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">
                        Tipo de Viaje
                    </label>

                    <select
                        name="tipo_viaje"
                        class="w-full px-4 py-3 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500"
                    >
                        <option
                            value="normal"
                            {{ $viaje->tipo_viaje == 'normal' ? 'selected' : '' }}
                        >
                            Normal
                        </option>

                        <option
                            value="redondo"
                            {{ $viaje->tipo_viaje == 'redondo' ? 'selected' : '' }}
                        >
                            Redondo
                        </option>
                    </select>
                </div>

            </div>
        </div>

        <!-- Botones -->
        <div class="flex justify-end gap-4">

            <a
                href="{{ route('admin.viajes.index') }}"
                class="px-6 py-3 rounded-xl border border-slate-300 text-slate-700 hover:bg-slate-100 transition"
            >
                Cancelar
            </a>

            <button
                type="submit"
                class="px-6 py-3 rounded-xl bg-blue-600 text-white hover:bg-blue-700 transition"
            >
                Actualizar Viaje
            </button>

        </div>

    </form>
</div>
@endsection