<x-webpage>
    <x-slot:title>Bienvenidos a SHNOA</x-slot:title>

    <!-- Slider de Productos Destacados -->
    <section class="w-[90%] mx-auto max-w-screen-xl mt-20 relative">
        <div class="relative w-full h-96 overflow-hidden rounded-lg">
            @foreach ($featuredProducts as $key => $productImage)
                <figure class="relative w-full h-full">
                    <img src="{{ asset('storage/' . $productImage->image_path) }}" alt="{{ $productImage->product->name }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 flex flex-col justify-end px-6 py-8 bg-gradient-to-t from-black via-transparent to-transparent text-white space-y-4">
                        <h1 class="text-3xl md:text-4xl font-bold">{{ $productImage->product->name }}</h1>
                        <p class="text-lg">{{ $productImage->product->description }}</p>
                    </div>
                </figure>
            @endforeach
        </div>

        <button class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-white p-2 rounded-full shadow-lg" data-button="prev">
            <img src="{{ asset('assets/prev.svg') }}" class="w-8 h-8 md:w-10 md:h-10">
        </button>

        <button class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-white p-2 rounded-full shadow-lg" data-button="next">
            <img src="{{ asset('assets/next.svg') }}" class="w-8 h-8 md:w-10 md:h-10">
        </button>
    </section>

    <!-- Welcome Section -->
    <section class="my-20 px-6 text-center md:px-12">
        <h2 class="text-4xl font-semibold text-gray-800 mb-6">¡Bienvenidos a SHNOA!</h2>
        <p class="text-lg text-gray-600 mb-12">En SHNOA, nos dedicamos a ofrecer los mejores productos de higiene y limpieza para empresas y hogares. Estamos comprometidos con la calidad, el cuidado del medio ambiente y el bienestar de nuestros clientes.</p>

        <div class="flex justify-center gap-8">
            <div class="w-full max-w-xs rounded-lg shadow-lg overflow-hidden">
                <img src="./assets/foto1.jpg" alt="Bienvenida 1" class="w-full h-72 object-cover">
            </div>
            <div class="w-full max-w-xs rounded-lg shadow-lg overflow-hidden">
                <img src="./assets/foto2.jpg" alt="Bienvenida 2" class="w-full h-72 object-cover">
            </div>
        </div>
    </section>
</x-webpage>