<x-webpage>
  <x-slot:title>Bienvenidos a SHNOA</x-slot:title>

  <!-- ALERTAS -->
  <div class="container mx-auto mt-6">
    @if (session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Éxito:</strong>
        <span class="block sm:inline">{{ session('success') }}</span>
      </div>
    @endif
    @if (session('error'))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Error:</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
      </div>
    @endif
  </div>

  <!-- HERO SLIDER FULLSCREEN -->
  <section class="relative h-[90vh] w-full overflow-hidden">
    <div class="absolute inset-0 z-10 flex items-center justify-between px-4 md:px-12">
      <button class="slider-prev bg-white p-2 rounded-full shadow-lg" data-button="prev">
        <img src="{{ asset('assets/prev.svg') }}" class="w-6 h-6 md:w-8 md:h-8">
      </button>
      <button class="slider-next bg-white p-2 rounded-full shadow-lg" data-button="next">
        <img src="{{ asset('assets/next.svg') }}" class="w-6 h-6 md:w-8 md:h-8">
      </button>
    </div>

    <div id="slider" class="h-full w-full relative">
      @foreach ($featuredProducts as $key => $productImage)
        <figure class="absolute inset-0 w-full h-full transition-opacity duration-1000 ease-in-out slider-childs {{ $loop->first ? 'opacity-100 z-20' : 'opacity-0 z-0' }}" data-active>
          <img src="{{ asset('storage/' . $productImage->image_path) }}" alt="{{ $productImage->name }}" class="w-full h-full object-cover" loading="lazy">

          <div class="absolute bottom-0 left-0 right-0 bg-black/60 backdrop-blur-md p-6 md:p-10 text-white">
            <h1 class="text-2xl md:text-4xl font-bold mb-2">{{ $productImage->product->name }}</h1>
            <p class="text-sm md:text-base">{{ $productImage->product->description }}</p>
          </div>
        </figure>
      @endforeach
    </div>
  </section>

  <!-- BIENVENIDA CON ANIMACIÓN -->
  <section class="py-16 bg-gray-50">
    <div class="container mx-auto px-6 text-center animate-fade-in-up">
      <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Bienvenidos a <span class="text-indigo-600">SHNOA</span></h2>
      <p class="text-gray-600 max-w-2xl mx-auto mb-8">Ofrecemos productos de higiene y limpieza de alta calidad para empresas y hogares. Nos impulsa el compromiso con el medio ambiente y el bienestar de quienes nos eligen.</p>
      <div class="flex flex-col sm:flex-row justify-center gap-4">
        <img src="./assets/foto1.jpg" alt="Bienvenida 1" class="rounded-xl shadow-md w-full sm:w-1/2 h-64 object-cover">
        <img src="./assets/foto2.jpg" alt="Bienvenida 2" class="rounded-xl shadow-md w-full sm:w-1/2 h-64 object-cover">
      </div>
    </div>
  </section>

  <!-- ANIMACIONES -->
  <style>
    @keyframes fade-in-up {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
      animation: fade-in-up 0.8s ease-out both;
    }
  </style>

  <!-- SLIDER JS -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const buttons = document.querySelectorAll('[data-button]');
      const slides = document.querySelectorAll('.slider-childs');
      let currentIndex = 0;

      buttons.forEach(button => {
        button.addEventListener('click', () => {
          slides[currentIndex].classList.remove('opacity-100', 'z-20');
          slides[currentIndex].classList.add('opacity-0', 'z-0');

          if (button.dataset.button === 'next') {
            currentIndex = (currentIndex + 1) % slides.length;
          } else {
            currentIndex = (currentIndex - 1 + slides.length) % slides.length;
          }

          slides[currentIndex].classList.remove('opacity-0', 'z-0');
          slides[currentIndex].classList.add('opacity-100', 'z-20');
        });
      });
    });
  </script>
</x-webpage>

