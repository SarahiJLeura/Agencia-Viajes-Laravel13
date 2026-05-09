<div id="mobile-menu" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-[9999] hidden lg:hidden">

    {{-- DRAWER --}}
    <div id="mobile-drawer" class="bg-white w-72 h-full p-6 z-[10000] transform -translate-x-full transition-transform duration-300">

        {{-- HEADER --}}
        <div class="flex justify-between items-center mb-8">

            <span class="text-2xl font-black text-[#0052CC]">GlobalQuest</span>

            <button id="close-menu" class="p-2 rounded-lg hover:bg-slate-100">
                <span class="material-symbols-outlined">close</span>
            </button>

        </div>

        {{-- USER INFO --}}
        @auth

            <div class="flex items-center gap-3 mb-8 pb-6 border-b">
                <div class="w-12 h-12 rounded-full bg-primary text-white flex items-center justify-center font-bold">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div>
                    <p class="font-semibold">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-sm text-slate-500">
                        {{ auth()->user()->isAdmin() ? 'Administrador' : 'Usuario' }}
                    </p>
                </div>

            </div>

        @endauth

        {{-- LINKS --}}
        <nav class="space-y-2">

            <x-sidebar-links />

            @auth

                <form method="POST" action="{{ route('logout') }}" class="pt-6">
                    @csrf

                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-red-50 text-red-500 transition-colors">
                        <span class="material-symbols-outlined">
                            logout
                        </span>

                        <span>Cerrar Sesión</span>
                    </button>

                </form>

            @else

                <a href="{{ route('login') }}" class="block px-4 py-3 rounded-lg hover:bg-blue-50">
                    Iniciar Sesión
                </a>

                <a href="{{ route('register') }}" class="block px-4 py-3 rounded-lg bg-primary text-white">
                    Registrarse
                </a>

            @endauth

        </nav>

    </div>

</div>

{{-- SCRIPT --}}
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