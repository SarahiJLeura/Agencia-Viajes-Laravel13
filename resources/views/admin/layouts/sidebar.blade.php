<aside class="hidden lg:block w-72 bg-white border-r border-[#EBECF0] min-h-screen p-6">
    <div class="mb-8">
        <h3 class="font-headline-md text-primary">Panel Admin</h3>
        <p class="text-sm text-slate-500">Gestión completa del sistema</p>
    </div>
    <nav class="space-y-2">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-blue-50 rounded-lg transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-primary' : '' }}">
            <span class="material-symbols-outlined">dashboard</span>
            <span>Dashboard</span>
        </a>
        <a href="{{ route('admin.usuarios.index') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-blue-50 rounded-lg transition-colors {{ request()->routeIs('admin.usuarios.*') ? 'bg-blue-50 text-primary' : '' }}">
            <span class="material-symbols-outlined">group</span>
            <span>Usuarios</span>
        </a>
        <a href="{{ route('admin.destinos.index') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-blue-50 rounded-lg transition-colors {{ request()->routeIs('admin.destinos.*') ? 'bg-blue-50 text-primary' : '' }}">
            <span class="material-symbols-outlined">map</span>
            <span>Destinos</span>
        </a>
        <a href="{{ route('admin.hospedajes.index') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-blue-50 rounded-lg transition-colors {{ request()->routeIs('admin.hospedajes.*') ? 'bg-blue-50 text-primary' : '' }}">
            <span class="material-symbols-outlined">hotel</span>
            <span>Hospedajes</span>
        </a>
        <a href="{{ route('admin.transportes.index') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-blue-50 rounded-lg transition-colors {{ request()->routeIs('admin.transportes.*') ? 'bg-blue-50 text-primary' : '' }}">
            <span class="material-symbols-outlined">directions_car</span>
            <span>Transportes</span>
        </a>
        <a href="{{ route('admin.viajes.index') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-blue-50 rounded-lg transition-colors {{ request()->routeIs('admin.viajes.*') ? 'bg-blue-50 text-primary' : '' }}">
            <span class="material-symbols-outlined">luggage</span>
            <span>Viajes</span>
        </a>
    </nav>
</aside>