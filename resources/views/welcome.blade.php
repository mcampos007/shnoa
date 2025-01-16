<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ Config('app.name') }}</title>

    @vite('resources/css/app.css')

    <!-- Fonts -->

    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@700&display=swap" rel="stylesheet">


    <!-- Styles -->
    <link rel="stylesheet" href="../css/styles.css">


</head>

<body class="antialiased">
    <!-- Header -->
    <header>
        <img src="./assets/logo.png" alt="Logo SHNOA">
        <h1>Servicios Higiénicos del NOA</h1>
    </header>

    <!-- Navbar -->
    <nav>
        <a href="{{ route('index') }}">INICIO</a>
        <a href="./PAGES/NOSOTROS.html">NOSOTROS</a>
        <a href="./PAGES/PRODUCTOS.html">PRODUCTOS</a>
        <a href="./PAGES/CONTACTO.html">CONTACTO</a>
    </nav>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Iterar sobre las imágenes destacadas -->

        <section class="w-[90%] mx-auto max-w-screen-lg overflow-hidden text-white rounded-lg mt-20 slider"
            @foreach ($featuredProducts as $key => $productImage)
                id="slider">
                <figure class="relative w-full h-full aspect-video slider-childs" data-active>
                    {{-- <img src="https://fakeimg.pl/1920x1080" alt="Slider 1" class="w-full h-full block object-cover"> --}}
                    <img src="{{ asset('storage/' . $productImage->image_path) }}" alt="{{ $productImage->product->name }}" class="w-full h-full block object-cover">

                    <div class="absolute inset-0  w-[90%] mx-auto h-max mt-auto space-y-4 py-8 hidden md:block">
                        <h1 class="text-3xl font-bold "> {{ $productImage->product->name }}</h1>
                        <p>{{ $productImage->product->description }}</p>
                    </div>
                </figure> @endforeach
            <button class="slider-prev bg-white rounded-full ml-4" data-button="prev">
            <img src="{{ asset('assets/prev.svg') }}" class="w-8 spect-square md:w-10">

            </button>

            <button class="slider-next bg-white rounded-full mr-4" data-button="next">
                <img src="{{ asset('assets/next.svg') }}" class="w-8 aspect-square md:w-10">

            </button>
        </section>

        <!-- Gallery -->
        <div class="gallery">
            <img src="./assets/imagen1.jpg" alt="Producto 1">
            <img src="./assets/imagen2.jpg" alt="Producto 2">
            <img src="./assets/imagen3.jpg" alt="Producto 3">
            <img src="./assets/imagen4.jpg" alt="Producto 4">
            <img src="./assets/imagen5.jpg" alt="Producto 5">
            <img src="./assets/imagen6.jpg" alt="Producto 6">
        </div>

        <!-- Welcome Section -->
        <div class="welcome">
            <h2>¡Bienvenidos a SHNOA!</h2>
            <p>En SHNOA, nos dedicamos a ofrecer los mejores productos de higiene y limpieza para empresas y hogares.
                Estamos comprometidos con la calidad, el cuidado del medio ambiente y el bienestar de nuestros clientes.
            </p>
            <div class="welcome-images">
                <img src="./assets/foto1.jpg" alt="Bienvenida 1">
                <img src="./assets/foto2.jpg" alt="Bienvenida 2">
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>&copy; 2025 SHNOA - Todos los derechos reservados.</p>

        @if (Route::has('login'))
            <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"
                        class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Ingresar</a>

                    {{-- @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                    @endif --}}
                @endauth
            </div>
        @endif
    </footer>
    <script src="{{ asset('js/slider.js') }}" defer></script>




</html>
