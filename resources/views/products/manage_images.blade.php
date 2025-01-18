<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-center text-gray-500">
            Gestión de Imágenes - {{ $product->name }}
        </h2>
    </x-slot>

    <div class="container max-w-full mx-auto px-4 py-8">

<!-- Mensajes -->
@if (session('success'))
    <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
        {{ session('success') }}
    </div>
@endif

<!-- Listado de Imágenes -->
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-6">
    @foreach ($images as $image)
        <div class="relative border rounded-lg shadow-md overflow-hidden group {{ $image->is_featured ? 'border-4 border-blue-500' : '' }}">

            <!-- Imagen -->
            <img src="{{ asset('storage/' . $image->image_path) }}" 
                class="w-full h-60 object-cover rounded-t-lg group-hover:opacity-75 transition duration-200 {{ $image->is_featured ? 'opacity-90' : '' }}">

            <!-- Botones de acción dentro de la imagen -->
            <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition duration-200 space-x-4">
                <!-- Destacar -->
                <form action="{{ route('products.images.feature', [$product->id, $image->id]) }}" method="POST" class="inline">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="px-4 py-2 text-sm rounded {{ $image->is_featured ? 'bg-blue-500 text-white' : 'bg-gray-300 text-black' }} focus:outline-none hover:bg-blue-600 transition duration-200">
                        {{ $image->is_featured ? 'Destacada' : 'Destacar' }}
                    </button>
                </form>

                <!-- Eliminar -->
                <form action="{{ route('products.images.destroy', [$product->id, $image->id]) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-4 py-2 text-sm bg-red-500 text-white rounded focus:outline-none hover:bg-red-600 transition duration-200"
                        onclick="return confirm('¿Seguro que deseas eliminar esta imagen?')">
                        Eliminar
                    </button>
                </form>

                <!-- Lupa para abrir imagen en modal -->
                <button onclick="openModal('{{ asset('storage/' . $image->image_path) }}')" class="px-4 py-2 bg-gray-700 text-white rounded-full focus:outline-none hover:bg-gray-600 transition duration-200">
                    <i class="fas fa-search"></i> <!-- Ícono de lupa -->
                </button>
            </div>
        </div>
    @endforeach
</div>

<!-- Subir Nueva Imagen -->
<div class="mt-8 bg-white p-6 rounded-lg shadow-md">
    <form action="{{ route('products.images.store', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="image" class="block text-lg font-semibold text-gray-700">Subir Nueva Imagen</label>
        <input type="file" name="image" id="image" class="block w-full mt-2 text-sm border border-gray-300 rounded-lg p-3 focus:outline-none focus:ring-2 focus:ring-green-500">
        <button type="submit" class="mt-4 px-6 py-3 bg-green-500 text-white rounded-lg font-semibold hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200">
            Subir
        </button>
    </form>
</div>

<!-- Regresar -->
<div class="mt-6 text-center">
    <a href="{{ route('products.index') }}" class="px-6 py-3 bg-gray-500 text-white rounded-lg font-semibold hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-200">
        Regresar
    </a>
</div>

<!-- Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white p-8 rounded-lg max-w-4xl">
        <span id="closeModal" class="absolute top-4 right-4 text-white cursor-pointer font-bold text-xl">X</span>
        <img id="modalImage" class="w-full h-auto" src="" alt="Imagen" />
    </div>
</div>

</div>

<script>
// Función para abrir el modal con la imagen seleccionada
function openModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('imageModal').classList.remove('hidden');
}

// Cerrar el modal al hacer clic en la X
document.getElementById('closeModal').onclick = function() {
    document.getElementById('imageModal').classList.add('hidden');
};

// Cerrar el modal si el usuario hace clic fuera de la imagen
document.getElementById('imageModal').onclick = function(e) {
    if (e.target === document.getElementById('imageModal')) {
        document.getElementById('imageModal').classList.add('hidden');
    }
};
</script>

</x-app-layout>
