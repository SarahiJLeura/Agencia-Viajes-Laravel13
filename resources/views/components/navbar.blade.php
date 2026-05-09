<header class="bg-white/90 backdrop-blur-md sticky top-0 z-50 border-b border-[#EBECF0] ocean-shadow">

    <nav class="flex justify-between items-center w-full px-6 py-3 max-w-[1280px] mx-auto">

        {{-- LEFT --}}
        <div class="flex items-center gap-4">

            {{-- HAMBURGER --}}
            <button class="lg:hidden active:scale-95 transition-transform duration-200" id="mobile-menu-btn">
                <span class="material-symbols-outlined text-[#0052CC]">
                    menu
                </span>
            </button>

            {{-- LOGO --}}
            <a href="#" class="text-2xl font-black text-[#0052CC] font-['Plus_Jakarta_Sans'] tracking-tight">
                GlobalQuest
            </a>

        </div>

        {{-- RIGHT --}}
        <div class="flex items-center gap-4">

            @auth

                <div class="relative group">

                    <button class="flex items-center gap-2 px-3 py-2 rounded-full hover:bg-surface-container-low transition-colors">

                        <div class="w-10 h-10 rounded-full bg-orange-500 overflow-hidden flex items-center justify-center text-white font-bold text-lg">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>

                        <span class="hidden md:inline text-sm font-medium text-on-surface">
                            {{ auth()->user()->name }}
                        </span>

                        <span class="material-symbols-outlined text-sm hidden md:inline">
                            expand_more
                        </span>

                    </button>

                    {{-- DROPDOWN --}}
                    <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl ocean-shadow-lg border border-[#EBECF0] opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all z-50">

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 hover:bg-error-container hover:text-error rounded-xl transition-colors">
                                <span class="material-symbols-outlined">
                                    logout
                                </span>

                                <span>
                                    Cerrar Sesión
                                </span>
                            </button>
                        </form>

                    </div>

                </div>

            @else

                <a href="{{ route('login') }}" class="px-4 py-2 text-primary font-semibold hover:bg-blue-700/10 rounded-lg transition-colors">
                    Iniciar Sesión
                </a>

                <a href="{{ route('register') }}" class="px-5 py-2 bg-blue-700 text-white font-semibold rounded-lg ocean-shadow hover:bg-on-primary-fixed-variant transition-colors">
                    Registrarse
                </a>

            @endauth

        </div>

    </nav>

    {{-- MOBILE DRAWER --}}
    <x-mobile-drawer />

</header>