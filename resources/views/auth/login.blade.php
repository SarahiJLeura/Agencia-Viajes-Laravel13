@extends('layouts.app')

@section('title', 'Iniciar Sesión - GlobalQuest')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-background">
    <div class="max-w-md w-full space-y-8 bg-white rounded-2xl ocean-shadow-lg p-8">
        <div class="text-center">
            <h2 class="font-display-md text-on-background">Bienvenido de vuelta</h2>
            <p class="font-body-md text-slate-500 mt-2">Ingresa tus credenciales para continuar</p>
        </div>
        
        @if ($errors->any())
            <div class="bg-error-container border border-error text-error rounded-xl p-4">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        
        <form class="mt-8 space-y-6" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block font-label-lg text-on-surface mb-2" for="email">Correo Electrónico</label>
                    <input class="w-full px-md py-3 rounded-lg border-[#DFE1E6] focus:ring-2 focus:ring-primary focus:border-primary transition-all" id="email" name="email" type="email" required value="{{ old('email') }}" placeholder="nombre@ejemplo.com">
                </div>
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="block font-label-lg text-on-surface" for="password">Contraseña</label>
                        <a class="font-label-sm text-primary hover:underline" href="#">¿Olvidaste tu contraseña?</a>
                    </div>
                    <input class="w-full px-md py-3 rounded-lg border-[#DFE1E6] focus:ring-2 focus:ring-primary focus:border-primary transition-all" id="password" name="password" type="password" required placeholder="••••••••">
                </div>
                <div class="flex items-center gap-2">
                    <input class="w-4 h-4 rounded border-[#DFE1E6] text-primary focus:ring-primary" id="remember" name="remember" type="checkbox">
                    <label class="font-label-sm text-slate-600" for="remember">Mantener sesión iniciada</label>
                </div>
            </div>
            
            <button type="submit" class="w-full py-4 bg-blue-700 text-white font-label-lg rounded-xl ocean-shadow hover:bg-on-primary-fixed-variant transition-colors active:scale-95">
                Iniciar Sesión
            </button>
        </form>
        
        <div class="relative my-8 text-center">
            <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-[#EBECF0]"></div></div>
            <span class="relative px-4 bg-white text-slate-400 font-label-sm">¿NUEVO EN GLOBALQUEST?</span>
        </div>
        
        <a href="{{ route('register') }}" class="w-full py-4 bg-orange-500 text-white font-label-lg rounded-xl ocean-shadow hover:bg-secondary transition-colors active:scale-95 block text-center">
            Crear Cuenta
        </a>
    </div>
</div>
@endsection