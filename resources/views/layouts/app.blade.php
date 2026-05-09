<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>GlobalQuest - @yield('title', 'Agencia de Viajes')</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        .ocean-shadow {
            box-shadow: 0px 4px 12px rgba(0, 82, 204, 0.08);
        }
        .ocean-shadow-lg {
            box-shadow: 0px 12px 24px rgba(0, 82, 204, 0.12);
        }
        body {
            min-height: 100dvh;
        }
    </style>
    @stack('styles')
</head>
<body class="bg-background text-on-background font-body-md">
    @include('components.navbar')

    <main class="flex">

        {{-- SIDEBAR --}}
        <x-sidebar />

        {{-- CONTENIDO --}}
        <div class="flex-1">
            @yield('content')
        </div>

    </main>
    
    @include('layouts.footer')
    
    @stack('scripts')
</body>
</html>