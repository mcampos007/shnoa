<!-- Header -->
<header
    class="bg-[#04a0d7] py-4 text-white flex items-center justify-between gap-4 sm:gap-6 px-6 sm:px-16 border-b-4 border-[#53b04c] shadow-lg relative"
    style="height: 180px;">
    <!-- Contenedor Logo y Título -->
    <div class="flex items-center justify-center gap-4 sm:gap-6 w-full">
        <img src="{{ asset('./assets/logo.png') }}" alt="Logo SHNOA"
            class="w-20 h-20 sm:w-32 sm:h-32 bg-white p-2 rounded-full shadow-lg">
        <!-- Aumento el tamaño del logo en móviles -->
        <h1 class="text-2xl sm:text-3xl font-semibold text-white text-center sm:text-left sm:block hidden"
            style="text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);">Servicios Higiénicos del NOA</h1>
    </div>

    <!-- Ícono de menú hamburguesa (solo en dispositivos móviles) -->
    <button id="hamburger-button"
        class="sm:hidden absolute top-4 left-4 inline-flex items-center justify-center p-2 rounded-md text-white bg-transparent border-2 border-white hover:bg-white hover:text-[#04a0d7] focus:outline-none transition duration-300 ease-in-out z-10">
        <svg id="hamburger-icon" class="h-6 w-6 block" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path class="block" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg id="close-icon" class="h-6 w-6 hidden" stroke="currentColor" fill="none" viewBox="0 0 24 24">
            <path class="block" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</header>

<!-- Menú móvil (inicialmente oculto y deslizante desde la izquierda) -->
<div id="mobile-menu"
    class="sm:hidden hidden fixed inset-0 bg-[#53b04c] bg-opacity-90 py-4 text-center z-50 transition-all duration-500 ease-in-out transform translate-x-full shadow-2xl rounded-tl-xl rounded-bl-xl mt-0 pt-0">
    <!-- Opciones del menú -->
    <a href="{{ route('index') }}"
        class="text-white font-medium hover:bg-[#04a0d7] hover:text-white transition-colors duration-300 block py-2">INICIO</a>
    <a href="{{ route('nosotros') }}"
        class="text-white font-medium hover:bg-[#04a0d7] hover:text-white transition-colors duration-300 block py-2">NOSOTROS</a>
    <a href="{{ route('wc-products') }}"
        class="text-white font-medium hover:bg-[#04a0d7] hover:text-white transition-colors duration-300 block py-2">PRODUCTOS</a>
    <a href="{{ route('contact') }}"
        class="text-white font-medium hover:bg-[#04a0d7] hover:text-white transition-colors duration-300 block py-2">CONTACTO</a>
</div>

<script>
    // JavaScript para alternar la visibilidad del menú hamburguesa y el botón de cerrar
    const hamburgerButton = document.getElementById('hamburger-button');
    const hamburgerIcon = document.getElementById('hamburger-icon');
    const closeIcon = document.getElementById('close-icon');
    const mobileMenu = document.getElementById('mobile-menu');

    // Abrir el menú al hacer clic en el icono hamburguesa
    hamburgerButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
        mobileMenu.classList.toggle('translate-x-full');
        mobileMenu.classList.toggle(
        'translate-x-16'); // Mueve el menú 16px hacia la derecha para que no tape el icono

        // Cambiar entre el icono hamburguesa y la X
        hamburgerIcon.classList.toggle('hidden');
        closeIcon.classList.toggle('hidden');
    });
</script>
