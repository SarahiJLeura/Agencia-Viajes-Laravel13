@extends('layouts.app')

@section('title', 'Registro - GlobalQuest')

@section('content')
<div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-background">
    <div class="max-w-md w-full space-y-8 bg-white rounded-2xl ocean-shadow-lg p-8">
        <div class="text-center">
            <h2 class="font-display-md text-on-background">Crear Cuenta</h2>
            <p class="font-body-md text-slate-500 mt-2">Únete a GlobalQuest hoy</p>
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
        
        <form class="mt-8 space-y-6" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="space-y-4">
                <div>
                    <label class="block font-label-lg text-on-surface mb-2" for="name">Nombre Completo</label>
                    <input class="w-full px-md py-3 rounded-lg border-[#DFE1E6] focus:ring-2 focus:ring-primary focus:border-primary transition-all" id="name" name="name" type="text" required value="{{ old('name') }}" placeholder="Juan Pérez">
                </div>
                <div>
                    <label class="block font-label-lg text-on-surface mb-2" for="email">Correo Electrónico</label>
                    <input class="w-full px-md py-3 rounded-lg border-[#DFE1E6] focus:ring-2 focus:ring-primary focus:border-primary transition-all" id="email" name="email" type="email" required value="{{ old('email') }}" placeholder="juan@ejemplo.com">
                </div>
                <div>
                    <label class="block font-label-lg text-on-surface mb-2" for="password">Contraseña</label>
                    <input class="w-full px-md py-3 rounded-lg border-[#DFE1E6] focus:ring-2 focus:ring-primary focus:border-primary transition-all" id="password" name="password" type="password" required placeholder="••••••••">
                </div>
                <div>
                    <label class="block font-label-lg text-on-surface mb-2" for="password_confirmation">Confirmar Contraseña</label>
                    <input class="w-full px-md py-3 rounded-lg border-[#DFE1E6] focus:ring-2 focus:ring-primary focus:border-primary transition-all" id="password_confirmation" name="password_confirmation" type="password" required placeholder="••••••••">
                </div>
            </div>
            
            <button type="submit" class="w-full py-4 bg-orange-500 text-white font-label-lg rounded-xl ocean-shadow hover:bg-secondary transition-colors active:scale-95">
                Registrarse
            </button>
        </form>
        
        <div class="text-center mt-4">
            <p class="font-body-md text-on-surface-variant">
                ¿Ya tienes una cuenta? 
                <a class="text-primary font-bold hover:underline" href="{{ route('login') }}">Iniciar Sesión</a>
            </p>
        </div>
    </div>
</div>
@endsection