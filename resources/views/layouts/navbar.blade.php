<header class="bg-white/90 backdrop-blur-md sticky top-0 z-50 border-b border-[#EBECF0] ocean-shadow">
    <nav class="flex justify-between items-center w-full px-6 py-3 max-w-[1280px] mx-auto">
        <div class="flex items-center gap-4">
            <button class="lg:hidden active:scale-95 transition-transform duration-200" id="mobile-menu-btn">
                <span class="material-symbols-outlined text-[#0052CC]">menu</span>
            </button>
            <a href="/" class="text-2xl font-black text-[#0052CC] font-['Plus_Jakarta_Sans'] tracking-tight">GlobalQuest</a>
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
    
    <!-- Mobile / Tablet Drawer -->
    <div id="mobile-menu" class="fixed inset-0 bg-black/50 z-50 hidden lg:hidden">
        <div id="mobile-drawer" class="bg-white w-72 h-full p-6 transform -translate-x-full transition-transform duration-300">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <span class="text-2xl font-black text-[#0052CC]">
                    GlobalQuest
                </span>

                <button id="close-menu" class="p-2 rounded-lg hover:bg-slate-100">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <!-- Usuario -->
            @auth
                <div class="flex items-center gap-3 mb-8 pb-6 border-b">
                    <div class="w-12 h-12 rounded-full bg-primary text-white flex items-center justify-center font-bold">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>

                    <div>
                        <p class="font-semibold">{{ auth()->user()->name }}</p>
                        <p class="text-sm text-slate-500">
                            {{ auth()->user()->isAdmin() ? 'Administrador' : 'Usuario' }}
                        </p>
                    </div>
                </div>
            @endauth

            <!-- Navegación -->
            <nav class="space-y-2">

                {{-- ADMIN --}}
                @auth
                    @if(auth()->user()->isAdmin())

                        <a href="{{ route('admin.dashboard') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50">
                            <span class="material-symbols-outlined">dashboard</span>
                            <span>Dashboard</span>
                        </a>

                        <a href="{{ route('admin.usuarios.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50">
                            <span class="material-symbols-outlined">group</span>
                            <span>Usuarios</span>
                        </a>

                        <a href="{{ route('admin.destinos.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50">
                            <span class="material-symbols-outlined">map</span>
                            <span>Destinos</span>
                        </a>

                        <a href="{{ route('admin.hospedajes.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50">
                            <span class="material-symbols-outlined">hotel</span>
                            <span>Hospedajes</span>
                        </a>

                        <a href="{{ route('admin.transportes.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50">
                            <span class="material-symbols-outlined">directions_car</span>
                            <span>Transportes</span>
                        </a>

                        <a href="{{ route('admin.viajes.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50">
                            <span class="material-symbols-outlined">luggage</span>
                            <span>Viajes</span>
                        </a>

                    @else

                        {{-- USER --}}
                        <a href="{{ route('destinos.publicos') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50">
                            <span class="material-symbols-outlined">explore</span>
                            <span>Destinos</span>
                        </a>

                        <a href="{{ route('viajes.index') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50">
                            <span class="material-symbols-outlined">luggage</span>
                            <span>Mis Viajes</span>
                        </a>

                        <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-50">
                            <span class="material-symbols-outlined">dashboard</span>
                            <span>Dashboard</span>
                        </a>

                    @endif

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}" class="pt-6">
                        @csrf

                        <button type="submit"
                                class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-red-50 text-red-500">
                            <span class="material-symbols-outlined">logout</span>
                            <span>Cerrar Sesión</span>
                        </button>
                    </form>

                @else

                    {{-- GUEST --}}
                    <a href="{{ route('login') }}"
                    class="block px-4 py-3 rounded-lg hover:bg-blue-50">
                        Iniciar Sesión
                    </a>

                    <a href="{{ route('register') }}"
                    class="block px-4 py-3 rounded-lg bg-primary text-white">
                        Registrarse
                    </a>

                @endauth

            </nav>
        </div>
    </div>
    
    <script>
        const mobileMenuBtn = document.getElementById('mobile-menu-btn');
        const mobileMenu = document.getElementById('mobile-menu');
        const mobileDrawer = document.getElementById('mobile-drawer');
        const closeMenu = document.getElementById('close-menu');

        mobileMenuBtn?.addEventListener('click', () => {
            mobileMenu.classList.remove('hidden');

            setTimeout(() => {
                mobileDrawer.classList.remove('-translate-x-full');
            }, 10);
        });

        const closeDrawer = () => {
            mobileDrawer.classList.add('-translate-x-full');

            setTimeout(() => {
                mobileMenu.classList.add('hidden');
            }, 300);
        };

        closeMenu?.addEventListener('click', closeDrawer);

        mobileMenu?.addEventListener('click', (e) => {
            if (e.target === mobileMenu) {
                closeDrawer();
            }
        });
    </script>
</header>