<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ Config('app.name') }}</title>

    @vite('resources/css/app.css')

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@700&display=swap" rel="stylesheet">
    <!-- Agregar Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

</head>

<body class="antialiased">

    <!-- Header -->
    @include('partials.header')

    <!-- Navbar -->
    @include('partials.navbar')

    <!-- Main Content -->
    {{-- <div class="main-content"> --}}
    <div class="container">
        <main>
            {{ $slot }}
        </main>
    </div>

    <!-- footer -->
    @include('partials.footer')

    <script src="{{ asset('js/slider.js') }}" defer></script>

</body>


</html>
