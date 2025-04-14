<!-- Header -->
<header
    class="bg-[#04a0d7] py-4 text-white flex items-center justify-between gap-4 sm:gap-6 px-6 sm:px-16 border-b-4 border-[#53b04c] shadow-lg relative"
    style="height: 180px;">
    <div class="flex items-center justify-center gap-4 sm:gap-6 w-full">
        <img src="{{ asset('./assets/logo.png') }}" alt="Logo SHNOA"
            class="w-20 h-20 sm:w-32 sm:h-32 bg-white p-2 rounded-full shadow-lg">
        <h1 class="text-2xl sm:text-3xl font-semibold text-white text-center sm:text-left sm:block hidden"
            style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">Servicios Higiénicos del NOA</h1>
    </div>

    <!-- Ícono hamburguesa -->
    <button id="hamburger-button"
        class="sm:hidden absolute top-4 left-4 inline-flex items-center justify-center p-2 rounded-md text-white bg-transparent border-2 border-white hover:bg-white hover:text-[#04a0d7] focus:outline-none transition duration-300 ease-in-out z-[999]">
        <svg id="hamburger-icon" class="h-6 w-6 block" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg id="close-icon" class="h-6 w-6 hidden" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</header>

<!-- Menú móvil deslizante con fondo y botones -->
<div id="mobile-menu"
    class="sm:hidden hidden fixed inset-0 bg-black bg-opacity-60 backdrop-blur-md z-50 transition-transform duration-300 ease-in-out transform translate-x-full flex flex-col items-center justify-center space-y-4 px-8">
    <!-- Opciones del menú como botones -->
    <a href="{{ route('index') }}"
        class="w-full max-w-xs bg-white bg-opacity-90 text-[#04a0d7] font-semibold text-lg text-center py-3 rounded-lg shadow hover:bg-opacity-100 transition duration-300">
        INICIO
    </a>
    <a href="{{ route('nosotros') }}"
        class="w-full max-w-xs bg-white bg-opacity-90 text-[#04a0d7] font-semibold text-lg text-center py-3 rounded-lg shadow hover:bg-opacity-100 transition duration-300">
        NOSOTROS
    </a>
    <a href="{{ route('wc-products') }}"
        class="w-full max-w-xs bg-white bg-opacity-90 text-[#04a0d7] font-semibold text-lg text-center py-3 rounded-lg shadow hover:bg-opacity-100 transition duration-300">
        PRODUCTOS
    </a>
    <a href="{{ route('contact') }}"
        class="w-full max-w-xs bg-white bg-opacity-90 text-[#04a0d7] font-semibold text-lg text-center py-3 rounded-lg shadow hover:bg-opacity-100 transition duration-300">
        CONTACTO
    </a>
</div>

<!-- Script -->
<script>
    const hamburgerButton = document.getElementById('hamburger-button');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const closeIcon = document.getElementById('close-icon');
    const mobileMenu = document.getElementById('mobile-menu');

    function toggleMenu() {
        const isOpen = !mobileMenu.classList.contains('hidden');

        if (isOpen) {
            mobileMenu.classList.add('translate-x-full');
            setTimeout(() => {
                mobileMenu.classList.add('hidden');
            }, 300);
            hamburgerIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
        } else {
            mobileMenu.classList.remove('hidden');
            setTimeout(() => {
                mobileMenu.classList.remove('translate-x-full');
            }, 10);
            hamburgerIcon.classList.add('hidden');
            closeIcon.classList.remove('hidden');
        }
    }

    hamburgerButton.addEventListener('click', toggleMenu);

    // Cierre al hacer clic fuera del panel
    mobileMenu.addEventListener('click', (e) => {
        if (e.target === mobileMenu) {
            toggleMenu();
        }
    });

    // Cierre automático al tocar una opción
    document.querySelectorAll('#mobile-menu a').forEach(link => {
        link.addEventListener('click', () => {
            toggleMenu();
        });
    });
</script>