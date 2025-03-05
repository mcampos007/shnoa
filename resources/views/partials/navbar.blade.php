<nav class="bg-[#53b04c] py-2 text-center flex justify-center gap-8 sm:flex hidden">
    <a href="{{ route('index') }}"
        class="text-white font-medium hover:text-[#04a0d7] hover:underline transition-colors duration-300">INICIO</a>
    <a href="{{ route('nosotros') }}"
        class="text-white font-medium hover:text-[#04a0d7] hover:underline transition-colors duration-300">NOSOTROS</a>
    <a href="{{ route('wc-products') }}"
        class="text-white font-medium hover:text-[#04a0d7] hover:underline transition-colors duration-300">PRODUCTOS</a>
    <a href="{{ route('contact') }}"
        class="text-white font-medium hover:text-[#04a0d7] hover:underline transition-colors duration-300">CONTACTO</a>
    <!-- Carrito de compras a la derecha -->
    <div class="ml-auto flex items-center">
        <a href="{{ route('cart.index') }}">

            <img src="{{ asset('assets/carrito.png') }}" alt="Carrito de compras" class="w-6 h-6">

        </a>
    </div>
</nav>
