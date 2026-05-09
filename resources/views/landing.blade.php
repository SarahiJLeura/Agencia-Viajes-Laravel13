{{-- resources/views/landing.blade.php --}}
<!DOCTYPE html>
<html class="light" lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GlobalQuest | Agencia de Viajes Premier</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
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
        .hero-gradient {
            background: linear-gradient(135deg, #003d9b 0%, #0052cc 50%, #0066ff 100%);
        }
        body {
            min-height: 100dvh;
        }
    </style>
</head>
<body class="bg-background text-on-background font-body-md">

<!-- TopAppBar -->
<header class="bg-white/90 backdrop-blur-md sticky top-0 z-50 border-b border-[#EBECF0] ocean-shadow">
    <nav class="flex justify-between items-center w-full px-6 py-3 max-w-[1280px] mx-auto">
        <div class="flex items-center gap-4">
            <button class="md:hidden active:scale-95 transition-transform duration-200" id="mobile-menu-btn">
                <span class="material-symbols-outlined text-[#0052CC]">menu</span>
            </button>
            <a href="/" class="text-2xl font-black text-[#0052CC] font-['Plus_Jakarta_Sans'] tracking-tight">GlobalQuest</a>
        </div>
        <div class="flex items-center gap-4">
            @auth
                <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-primary text-white rounded-lg ocean-shadow hover:bg-on-primary-fixed-variant transition-colors">
                    Mi Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="px-4 py-2 text-primary font-semibold hover:bg-primary/10 rounded-lg transition-colors">Iniciar Sesión</a>
                <a href="{{ route('register') }}" class="px-5 py-2 bg-blue-700 text-white font-semibold rounded-lg ocean-shadow hover:bg-on-primary-fixed-variant transition-colors">Registrarse</a>
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
                <a href="/" class="block py-2 font-semibold text-[#0052CC]">Inicio</a>
                <a href="#destinos" class="block py-2 font-semibold">Destinos</a>
                <a href="#paquetes" class="block py-2 font-semibold">Paquetes</a>
                <a href="#nosotros" class="block py-2 font-semibold">Nosotros</a>
                <hr class="my-4">
                @auth
                    <a href="{{ route('dashboard') }}" class="block py-2 font-semibold text-primary">Dashboard</a>
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
</header>

<main>
    <!-- Hero Section -->
    <section class="relative w-full h-[600px] md:h-[700px] flex items-center justify-center overflow-hidden hero-gradient">
        <div class="absolute inset-0 z-0 opacity-30">
            <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1469474968028-56623f02e42e?w=1600')] bg-cover bg-center mix-blend-overlay"></div>
        </div>
        <div class="relative z-10 max-w-[1280px] w-full px-6 text-center">
            <span class="inline-block px-4 py-1.5 rounded-full bg-white/20 backdrop-blur-md text-white font-label-lg uppercase tracking-widest mb-6">Explora lo Extraordinario</span>
            <h1 class="font-display-lg text-white mb-6 leading-tight drop-shadow-lg">GlobalQuest: Tu Viaje, <br class="hidden md:block"/> Perfeccionado con Precisión.</h1>
            <p class="font-body-lg text-white/90 max-w-2xl mx-auto mb-8 drop-shadow-md">Combinamos logística global de élite con pasión por el descubrimiento para ofrecerte las experiencias más exclusivas del mundo.</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="#destinos" class="px-8 py-4 bg-[#003d9b] text-white font-label-lg rounded-xl ocean-shadow hover:bg-[#0040a2] active:scale-95 transition-all">Explorar Destinos</a>
                <a href="{{ route('register') }}" class="px-8 py-4 bg-white/10 backdrop-blur-md border-2 border-white text-white font-label-lg rounded-xl hover:bg-white hover:text-[#003d9b] active:scale-95 transition-all">Planificar Viaje</a>
            </div>
        </div>
    </section>

    <!-- Destinos Destacados -->
    <section id="destinos" class="w-full max-w-[1280px] mx-auto px-6 py-xxl">
        <div class="text-center mb-12">
            <span class="text-primary font-label-sm uppercase tracking-wider">Destinos</span>
            <h2 class="font-display-md text-on-background mt-2">Destinos Destacados</h2>
            <p class="text-on-surface-variant mt-2 max-w-2xl mx-auto">Descubre los lugares más increíbles que el mundo tiene para ofrecer</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Tarjeta 1 -->
            <div class="group bg-white rounded-2xl overflow-hidden ocean-shadow-lg hover:scale-[1.02] transition-all duration-300 cursor-pointer">
                <div class="h-64 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1537996194471-e657df975ab4?w=600" alt="Santorini" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-primary">Popular</div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 text-slate-500 text-sm mb-2">
                        <span class="material-symbols-outlined text-sm">location_on</span>
                        <span>Santorini, Grecia</span>
                    </div>
                    <h3 class="font-headline-md mb-2">Paraíso en el Egeo</h3>
                    <p class="text-slate-500 text-sm mb-4">Playas de arena negra, atardeceres increíbles y arquitectura blanca y azul.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-primary font-bold">Desde $1,299</span>
                        <button class="text-primary font-label-lg flex items-center gap-1 group-hover:gap-2 transition-all">
                            Ver más <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Tarjeta 2 -->
            <div class="group bg-white rounded-2xl overflow-hidden ocean-shadow-lg hover:scale-[1.02] transition-all duration-300 cursor-pointer">
                <div class="h-64 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1493976040374-85c8e12f0c0e?w=600" alt="Machu Picchu" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 right-4 bg-orange-500/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-white">Aventura</div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 text-slate-500 text-sm mb-2">
                        <span class="material-symbols-outlined text-sm">location_on</span>
                        <span>Cusco, Perú</span>
                    </div>
                    <h3 class="font-headline-md mb-2">El Camino Inca</h3>
                    <p class="text-slate-500 text-sm mb-4">Descubre la ciudadela perdida de los Incas y vive una experiencia única.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-primary font-bold">Desde $899</span>
                        <button class="text-primary font-label-lg flex items-center gap-1 group-hover:gap-2 transition-all">
                            Ver más <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Tarjeta 3 -->
            <div class="group bg-white rounded-2xl overflow-hidden ocean-shadow-lg hover:scale-[1.02] transition-all duration-300 cursor-pointer">
                <div class="h-64 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1502602898657-3e91760cbb34?w=600" alt="Paris" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full text-xs font-bold text-primary">Romance</div>
                </div>
                <div class="p-6">
                    <div class="flex items-center gap-2 text-slate-500 text-sm mb-2">
                        <span class="material-symbols-outlined text-sm">location_on</span>
                        <span>París, Francia</span>
                    </div>
                    <h3 class="font-headline-md mb-2">Ciudad de la Luz</h3>
                    <p class="text-slate-500 text-sm mb-4">Torre Eiffel, Louvre, gastronomía y el romance en cada esquina.</p>
                    <div class="flex justify-between items-center">
                        <span class="text-primary font-bold">Desde $1,499</span>
                        <button class="text-primary font-label-lg flex items-center gap-1 group-hover:gap-2 transition-all">
                            Ver más <span class="material-symbols-outlined text-sm">arrow_forward</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Paquetes Especiales -->
    <section id="paquetes" class="bg-surface-container-low py-xxl">
        <div class="max-w-[1280px] mx-auto px-6">
            <div class="text-center mb-12">
                <span class="text-primary font-label-sm uppercase tracking-wider">Paquetes Especiales</span>
                <h2 class="font-display-md text-on-background mt-2">Ofertas Exclusivas</h2>
                <p class="text-on-surface-variant mt-2">Paquetes todo incluido con los mejores precios</p>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-2xl overflow-hidden ocean-shadow-lg">
                    <div class="p-6 bg-gradient-to-r from-primary to-primary-container text-white text-center py-8">
                        <span class="material-symbols-outlined text-5xl">beach_access</span>
                        <h3 class="font-headline-md mt-3">Caribe Mágico</h3>
                        <p class="text-2xl font-bold mt-2">$999</p>
                    </div>
                    <div class="p-6 space-y-3">
                        <div class="flex items-center gap-2 text-sm"><span class="material-symbols-outlined text-primary">check_circle</span> 7 noches en resort 5 estrellas</div>
                        <div class="flex items-center gap-2 text-sm"><span class="material-symbols-outlined text-primary">check_circle</span> Vuelos ida y vuelta</div>
                        <div class="flex items-center gap-2 text-sm"><span class="material-symbols-outlined text-primary">check_circle</span> Tours incluidos</div>
                        <div class="flex items-center gap-2 text-sm"><span class="material-symbols-outlined text-primary">check_circle</span> Todo incluido</div>
                        <button class="w-full mt-4 bg-secondary-container text-white py-3 rounded-lg font-semibold hover:bg-secondary transition-colors">Reservar Ahora</button>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl overflow-hidden ocean-shadow-lg transform md:scale-105 shadow-xl">
                    <div class="p-6 bg-gradient-to-r from-secondary-container to-secondary text-white text-center py-8">
                        <span class="material-symbols-outlined text-5xl">hiking</span>
                        <h3 class="font-headline-md mt-3">Aventura Extrema</h3>
                        <p class="text-2xl font-bold mt-2">$1,299</p>
                    </div>
                    <div class="p-6 space-y-3">
                        <div class="flex items-center gap-2 text-sm"><span class="material-symbols-outlined text-secondary">check_circle</span> 5 días de trekking</div>
                        <div class="flex items-center gap-2 text-sm"><span class="material-symbols-outlined text-secondary">check_circle</span> Guías expertos</div>
                        <div class="flex items-center gap-2 text-sm"><span class="material-symbols-outlined text-secondary">check_circle</span> Equipo incluido</div>
                        <div class="flex items-center gap-2 text-sm"><span class="material-symbols-outlined text-secondary">check_circle</span> Alojamiento en campamentos</div>
                        <button class="w-full mt-4 bg-blue-500 text-white py-3 rounded-lg font-semibold hover:bg-on-primary-fixed-variant transition-colors">Reservar Ahora</button>
                    </div>
                </div>
                
                <div class="bg-white rounded-2xl overflow-hidden ocean-shadow-lg">
                    <div class="p-6 bg-gradient-to-r from-tertiary to-tertiary-container text-white text-center py-8">
                        <span class="material-symbols-outlined text-5xl">spa</span>
                        <h3 class="font-headline-md mt-3">Bienestar y Relax</h3>
                        <p class="text-2xl font-bold mt-2">$1,599</p>
                    </div>
                    <div class="p-6 space-y-3">
                        <div class="flex items-center gap-2 text-sm"><span class="material-symbols-outlined text-tertiary">check_circle</span> 7 noches spa incluido</div>
                        <div class="flex items-center gap-2 text-sm"><span class="material-symbols-outlined text-tertiary">check_circle</span> Clases de yoga diarias</div>
                        <div class="flex items-center gap-2 text-sm"><span class="material-symbols-outlined text-tertiary">check_circle</span> Alimentación saludable</div>
                        <div class="flex items-center gap-2 text-sm"><span class="material-symbols-outlined text-tertiary">check_circle</span> Masajes relajantes</div>
                        <button class="w-full mt-4 bg-primary text-white py-3 rounded-lg font-semibold hover:bg-on-primary-fixed-variant transition-colors">Reservar Ahora</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonios -->
    <section id="nosotros" class="w-full max-w-[1280px] mx-auto px-6 py-xxl">
        <div class="text-center mb-12">
            <span class="text-primary font-label-sm uppercase tracking-wider">Testimonios</span>
            <h2 class="font-display-md text-on-background mt-2">Lo que dicen nuestros viajeros</h2>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-2xl ocean-shadow-lg">
                <div class="flex gap-1 text-yellow-400 mb-4">
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                </div>
                <p class="text-slate-600 mb-4">"Excelente servicio, el viaje a Santorini superó todas mis expectativas. Todo perfectamente organizado."</p>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white font-bold">MG</div>
                    <div>
                        <p class="font-semibold">María González</p>
                        <p class="text-xs text-slate-400">Viajó a Grecia</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-2xl ocean-shadow-lg">
                <div class="flex gap-1 text-yellow-400 mb-4">
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                </div>
                <p class="text-slate-600 mb-4">"La agencia más profesional que he conocido. Todos los detalles cuidados al mínimo. Volveré a viajar con ellos."</p>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-secondary flex items-center justify-center text-white font-bold">CR</div>
                    <div>
                        <p class="font-semibold">Carlos Rodríguez</p>
                        <p class="text-xs text-slate-400">Viajó a Japón</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-white p-6 rounded-2xl ocean-shadow-lg">
                <div class="flex gap-1 text-yellow-400 mb-4">
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star</span>
                    <span class="material-symbols-outlined">star_half</span>
                </div>
                <p class="text-slate-600 mb-4">"Excelente relación calidad-precio. El equipo de atención al cliente es increíblemente atento."</p>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded-full bg-tertiary flex items-center justify-center text-white font-bold">AL</div>
                    <div>
                        <p class="font-semibold">Ana López</p>
                        <p class="text-xs text-slate-400">Viajó a París</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Footer -->
<footer class="bg-[#051a3e] text-white py-xxl mt-auto">
    <div class="max-w-[1280px] mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-xl">
        <div class="md:col-span-1">
            <span class="text-2xl font-black text-white font-['Plus_Jakarta_Sans'] tracking-tight block mb-6">GlobalQuest</span>
            <p class="text-white/60 font-body-md">Redefiniendo los estándares de viajes globales a través de precisión y aventura.</p>
        </div>
        <div>
            <h4 class="font-label-lg text-white mb-6">Compañía</h4>
            <ul class="space-y-4 text-white/60 font-body-md">
                <li><a class="hover:text-white transition-colors" href="#">Nuestra Historia</a></li>
                <li><a class="hover:text-white transition-colors" href="#">Red Global</a></li>
                <li><a class="hover:text-white transition-colors" href="#">Carreras</a></li>
            </ul>
        </div>
        <div>
            <h4 class="font-label-lg text-white mb-6">Servicios</h4>
            <ul class="space-y-4 text-white/60 font-body-md">
                <li><a class="hover:text-white transition-colors" href="#">Viajes Corporativos</a></li>
                <li><a class="hover:text-white transition-colors" href="#">Colecciones de Lujo</a></li>
                <li><a class="hover:text-white transition-colors" href="#">Charter Privado</a></li>
            </ul>
        </div>
        <div>
            <h4 class="font-label-lg text-white mb-6">Newsletter</h4>
            <p class="text-white/60 font-body-md mb-4">Recibe información de destinos exclusivos.</p>
            <div class="flex gap-2">
                <input class="bg-white/10 border-white/20 rounded-lg px-4 py-2 w-full text-white placeholder:text-white/40" placeholder="Email" type="email" id="newsletter-email">
                <button class="bg-[#003d9b] p-2 rounded-lg" id="newsletter-btn">
                    <span class="material-symbols-outlined">send</span>
                </button>
            </div>
        </div>
    </div>
    <div class="max-w-[1280px] mx-auto px-6 mt-xl pt-lg border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4">
        <p class="text-white/40 font-label-sm">© 2025 GlobalQuest Travel Agency. Todos los derechos reservados.</p>
        <div class="flex gap-6 text-white/40 font-label-sm">
            <a class="hover:text-white" href="#">Privacidad</a>
            <a class="hover:text-white" href="#">Términos</a>
            <a class="hover:text-white" href="#">Seguridad</a>
        </div>
    </div>
</footer>

<script>
    document.getElementById('mobile-menu-btn')?.addEventListener('click', () => {
        document.getElementById('mobile-menu').style.display = 'block';
    });
    document.getElementById('close-menu')?.addEventListener('click', () => {
        document.getElementById('mobile-menu').style.display = 'none';
    });
</script>
</body>
</html>