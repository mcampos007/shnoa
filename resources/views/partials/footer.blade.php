<!-- Footer -->
<footer class=" bg-sky-500 text-white py-6">
    <div class="text-center">
        <!-- Derechos Reservados -->
        <p>&copy; {{ date('Y') }} SHNOA - Todos los derechos reservados.</p>
    </div>

    <div class="text-center mt-4">
        <!-- Enlaces de Autenticación -->
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}"
                    class="inline-block font-semibold text-gray-300 hover:text-gray-100 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}"
                    class="inline-block font-semibold text-gray-300 hover:text-gray-100 focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">
                    Ingresar
                </a>
            @endauth
        @endif
    </div>

    <div class="text-center mt-6">
        <!-- Enlaces a Redes Sociales -->
        <div class="flex justify-center space-x-6">

            <a href="https://www.facebook.com" target="_blank" class="hover:text-blue-500">
                <i class="fab fa-facebook fa-lg"></i>
            </a>
            <a href="https://www.twitter.com" target="_blank" class="hover:text-blue-400">
                <i class="fab fa-twitter fa-lg"></i>
            </a>
            <a href="https://www.instagram.com" target="_blank" class="hover:text-pink-400">
                <i class="fab fa-instagram fa-lg"></i>
            </a>
            <a href="https://www.linkedin.com" target="_blank" class="hover:text-blue-700">
                <i class="fab fa-linkedin fa-lg"></i>
            </a>
        </div>
    </div>
</footer>
