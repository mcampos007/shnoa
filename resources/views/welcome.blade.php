<x-webpage>
    <x-slot:title>Bienvenidos a SHNOA</x-slot:title>

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
</x-webpage>
