<header class="bg-white/90 backdrop-blur-md sticky top-0 z-50 border-b border-[#EBECF0] ocean-shadow">
    <nav class="flex justify-between items-center w-full px-6 py-3 max-w-[1280px] mx-auto">
        <div class="flex items-center gap-4">
            <button class="md:hidden active:scale-95 transition-transform duration-200" id="mobile-menu-btn">
                <span class="material-symbols-outlined text-[#0052CC]">menu</span>
            </button>
            <a href="/" class="text-2xl font-black text-[#0052CC] font-['Plus_Jakarta_Sans'] tracking-tight">GlobalQuest</a>
        </div>
        
        <div class="hidden md:flex items-center gap-8">
            @auth
                <a class="text-slate-600 hover:text-[#0052CC] font-['Plus_Jakarta_Sans'] font-semibold tracking-tight transition-colors {{ request()->routeIs('destinos*') ? 'text-[#0052CC] border-b-2 border-[#0052CC]' : '' }}" href="{{ route('destinos.publicos') }}">Destinos</a>
                <a class="text-slate-600 hover:text-[#0052CC] font-['Plus_Jakarta_Sans'] font-semibold tracking-tight transition-colors {{ request()->routeIs('viajes*') ? 'text-[#0052CC] border-b-2 border-[#0052CC]' : '' }}" href="{{ route('viajes.index') }}">Mis Viajes</a>
                @if(auth()->user()->isAdmin())
                    <a class="text-slate-600 hover:text-[#0052CC] font-['Plus_Jakarta_Sans'] font-semibold tracking-tight transition-colors" href="{{ route('admin.dashboard') }}">Admin Panel</a>
                @endif
            @else
                <a class="text-slate-600 hover:text-[#0052CC] font-['Plus_Jakarta_Sans'] font-semibold tracking-tight transition-colors" href="{{ route('destinos.publicos') }}">Destinos</a>
                <a class="text-slate-600 hover:text-[#0052CC] font-['Plus_Jakarta_Sans'] font-semibold tracking-tight transition-colors" href="#">Paquetes</a>
                <a class="text-slate-600 hover:text-[#0052CC] font-['Plus_Jakarta_Sans'] font-semibold tracking-tight transition-colors" href="#">Nosotros</a>
            @endauth
        </div>
        
        <div class="flex items-center gap-4">
            @auth
                <div class="relative group">
                    <button class="flex items-center gap-2 px-3 py-2 rounded-full hover:bg-surface-container-low transition-colors">
                        <div class="w-10 h-10 rounded-full bg-primary-container overflow-hidden flex items-center justify-center text-white font-bold text-lg">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>
                        <span class="hidden md:inline text-sm font-medium text-on-surface">{{ auth()->user()->name }}</span>
                        <span class="material-symbols-outlined text-sm hidden md:inline">expand_more</span>
                    </button>
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl ocean-shadow-lg border border-[#EBECF0] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-surface-container-low rounded-t-xl transition-colors">
                            <span class="material-symbols-outlined text-primary">dashboard</span>
                            <span>Dashboard</span>
                        </a>
                        <a href="{{ route('viajes.index') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-surface-container-low transition-colors">
                            <span class="material-symbols-outlined text-primary">luggage</span>
                            <span>Mis Viajes</span>
                        </a>
                        <hr class="my-1 border-[#EBECF0]">
                        <form method="POST" action="{{ route('logout') }}" class="block">
                            @csrf
                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-error-container hover:text-error rounded-b-xl transition-colors">
                                <span class="material-symbols-outlined">logout</span>
                                <span>Cerrar Sesión</span>
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="px-4 py-2 text-primary font-semibold hover:bg-primary/10 rounded-lg transition-colors">Iniciar Sesión</a>
                <a href="{{ route('register') }}" class="px-5 py-2 bg-primary text-white font-semibold rounded-lg ocean-shadow hover:bg-on-primary-fixed-variant transition-colors">Registrarse</a>
            @endauth
        </div>
    </nav>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="fixed inset-0 bg-black/50 z-50 hidden md:hidden" style="display: none;">
        <div class="bg-white w-80 h-full p-6">
            <div class="flex justify-between items-center mb-8">
                <span class="text-2xl font-black text-[#0052CC]">GlobalQuest</span>
                <button id="close-menu" class="p-2">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div class="space-y-4">
                @auth
                    <a href="{{ route('destinos.publicos') }}" class="block py-2 font-semibold">Destinos</a>
                    <a href="{{ route('viajes.index') }}" class="block py-2 font-semibold">Mis Viajes</a>
                    <a href="{{ route('dashboard') }}" class="block py-2 font-semibold">Dashboard</a>
                    @if(auth()->user()->isAdmin())
                        <a href="{{ route('admin.dashboard') }}" class="block py-2 font-semibold">Admin Panel</a>
                    @endif
                    <hr class="my-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block w-full text-left py-2 font-semibold text-error">Cerrar Sesión</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block py-2 font-semibold">Iniciar Sesión</a>
                    <a href="{{ route('register') }}" class="block py-2 font-semibold text-primary">Registrarse</a>
                @endauth
            </div>
        </div>
    </div>
    
    <script>
        document.getElementById('mobile-menu-btn')?.addEventListener('click', () => {
            document.getElementById('mobile-menu').style.display = 'block';
        });
        document.getElementById('close-menu')?.addEventListener('click', () => {
            document.getElementById('mobile-menu').style.display = 'none';
        });
    </script>
</header>