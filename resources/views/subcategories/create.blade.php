<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-center text-gray-500">
            Agregar Subcategoría
        </h2>
    </x-slot>

    <div class="container max-w-4xl mx-auto px-4 py-8">

        <!-- Formulario para agregar una subcategoría -->
        <div class="bg-white p-6 rounded-lg shadow-md space-y-6">
            <form action="{{ route('subcategories.store', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="category_id" value="{{ $category->id }}">

                <!-- Campo para el nombre -->
                <div class="mb-4">
                    <label for="name" class="block text-lg font-semibold text-gray-700">Nombre</label>
                    <input type="text" name="name" id="name" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    @error('name')
                        <small class="text-red-500 text-sm">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Campo para la descripción -->
                <div class="mb-4">
                    <label for="description" class="block text-lg font-semibold text-gray-700">Descripción</label>
                    <textarea name="description" id="description" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" rows="4"></textarea>
                    @error('description')
                        <small class="text-red-500 text-sm">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Campo para la imagen -->
                <div class="mb-4">
                    <label for="image" class="block text-lg font-semibold text-gray-700">Imagen</label>
                    <input type="file" name="image" id="image" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    @error('image')
                        <small class="text-red-500 text-sm">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Botón para guardar -->
                <div class="text-center">
                    <button type="submit" class="w-full bg-green-500 text-white py-3 px-6 rounded-lg font-semibold hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200">
                        Guardar Subcategoría
                    </button>
                </div>
            </form>
        </div>

        <!-- Formulario Cancelar -->
        <div class="mt-6 text-center">
            <form action="{{ route('subcategories.index', $category->id) }}" method="GET" style="display: inline;">
                <button type="submit" class="w-full bg-gray-500 text-white py-3 px-6 rounded-lg font-semibold hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 transition duration-200">
                    Cancelar
                </button>
            </form>
        </div>
    </div>

</x-app-layout>