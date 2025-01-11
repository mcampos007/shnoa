<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ Config('app.name') }}</title>

    <!-- Fonts -->

    <link href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@700&display=swap" rel="stylesheet">


    <!-- Styles -->
    <link rel="stylesheet" href="../css/styles.css">

</head>

<body class="font-sans antialiased">
    <!-- Navigation -->
    @include('layouts.navigation')
    <!-- Header -->
    {{-- <header>
        <img src="{{ asset('assets/logo.png') }}" alt="Logo SHNOA">
        <h1>Servicios Higiénicos del NOA</h1>
    </header> --}}

    <div class="min-h-screen bg-gray-100">
        {{-- @include('layouts.navigation') --}}

        {{-- <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif --}}

        <!-- Page Content -->
        <main>
            {{-- {{ $slot }} --}}

            @yield('content')
        </main>
    </div>
</body>

</html>
