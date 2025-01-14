<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-center text-gray-500">
            Gestión de Imágenes - {{ $product->name }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-4">
        <!-- Mensajes -->
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Listado de Imágenes -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($images as $image)
                <div class="relative border rounded shadow-lg">
                    <img src="{{ asset('storage/' . $image->image_path) }}"
                        class="w-full h-32 sm:h-40 lg:h-48 object-cover rounded-t">

                    <!-- Botones de acción -->
                    <div class="p-2">
                        <!-- Destacar -->
                        <form action="{{ route('products.images.feature', [$product->id, $image->id]) }}" method="POST"
                            class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit"
                                class="px-2 py-1 text-sm rounded {{ $image->is_featured ? 'bg-blue-500 text-white' : 'bg-gray-300 text-black' }}">
                                {{ $image->is_featured ? 'Destacada' : 'Destacar' }}
                            </button>
                        </form>

                        <!-- Eliminar -->
                        <form action="{{ route('products.images.destroy', [$product->id, $image->id]) }}" method="POST"
                            class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-2 py-1 bg-red-500 text-white text-sm rounded"
                                onclick="return confirm('¿Seguro que deseas eliminar esta imagen?')">
                                Eliminar
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Subir Nueva Imagen -->
        <div class="mt-6">
            <form action="{{ route('products.images.store', $product->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <label for="image" class="block text-sm font-medium text-gray-700">Subir Nueva Imagen</label>
                <input type="file" name="image" id="image"
                    class="block w-full mt-1 text-sm border rounded p-2">
                <button type="submit" class="px-4 py-2 mt-3 bg-green-500 text-white rounded">Subir</button>
            </form>
        </div>

        <!-- Regresar -->
        <div class="mt-4">
            <a href="{{ route('products.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded">Regresar</a>
        </div>
    </div>
</x-app-layout>
