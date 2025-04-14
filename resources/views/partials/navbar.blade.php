<nav class="bg-[#53b04c] py-3 px-6 hidden sm:flex items-center relative">
    <!-- Links centrados -->
    <div class="absolute left-1/2 -translate-x-1/2 flex gap-6">
        <a href="{{ route('index') }}"
            class="text-white font-medium hover:text-[#04a0d7] hover:underline transition-colors duration-300">
            INICIO
        </a>
        <a href="{{ route('nosotros') }}"
            class="text-white font-medium hover:text-[#04a0d7] hover:underline transition-colors duration-300">
            NOSOTROS
        </a>
        <a href="{{ route('wc-products') }}"
            class="text-white font-medium hover:text-[#04a0d7] hover:underline transition-colors duration-300">
            PRODUCTOS
        </a>
        <a href="{{ route('contact') }}"
            class="text-white font-medium hover:text-[#04a0d7] hover:underline transition-colors duration-300">
            CONTACTO
        </a>
    </div>

    <!-- Carrito a la derecha -->
    <div class="ml-auto">
        <a href="{{ route('cart.index') }}">
            <img src="{{ asset('assets/carrito.png') }}" alt="Carrito de compras" class="w-6 h-6">
        </a>
    </div>
</nav>