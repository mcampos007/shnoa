<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    @vite('resources/css/app.css')

    <title>Test slider</title>
</head>

<body>
    <section class="w-[90%] mx-auto max-w-screen-lg overflow-hidden text-white rounded-lg mt-20 slider" id="slider">
        <figure class="relative w-full h-full aspect-video slider-childs" data-active>
            {{-- <img src="https://fakeimg.pl/1920x1080" alt="Slider 1" class="w-full h-full block object-cover"> --}}
            <img src="{{ asset('assets/imagen1.jpg') }}" alt="Slider 1" class="w-full h-full block object-cover">

            <div class="absolute inset-0  w-[90%] mx-auto h-max mt-auto space-y-4 py-8 hidden md:block">
                <h1 class="text-3xl font-bold "> Imagne 1:</h1>
                <p>Texto reducido de la imagen</p>
            </div>
        </figure>

        <figure class="relative w-full h-full aspect-video slider-childs">
            {{-- <img src="https://fakeimg.pl/1920x1080" alt="Slider 1" class="w-full h-full block object-cover"> --}}
            <img src="{{ asset('assets/imagen2.jpg') }}" alt="Slider 1" class="w-full h-full block object-cover">

            <div class="absolute inset-0  w-[90%] mx-auto h-max mt-auto space-y-4 py-8 hidden md:block">
                <h1 class="text-3xl font-bold "> Imagne 2:</h1>
                <p>Texto reducido de la imagen</p>
            </div>
        </figure>

        <figure class="relative w-full h-full aspect-video slider-childs">
            {{-- <img src="https://fakeimg.pl/1920x1080" alt="Slider 1" class="w-full h-full block object-cover"> --}}
            <img src="{{ asset('assets/imagen3.jpg') }}" alt="Slider 1" class="w-full h-full block object-cover">

            <div class="absolute inset-0  w-[90%] mx-auto h-max mt-auto space-y-4 py-8 hidden md:block">
                <h1 class="text-3xl font-bold "> Imagne 3:</h1>
                <p>Texto reducido de la imagen</p>
            </div>
        </figure>

        <button class="slider-prev bg-white rounded-full ml-4" data-button="prev">
            <img src="{{ asset('assets/prev.svg') }}" class="w-8 spect-square md:w-10">

        </button>

        <button class="slider-next bg-white rounded-full mr-4" data-button="next">
            <img src="{{ asset('assets/next.svg') }}" class="w-8 aspect-square md:w-10">

        </button>


    </section>

    <script src="{{ asset('js/slider.js') }}" defer></script>
</body>

</html>
