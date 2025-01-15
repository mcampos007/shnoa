<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-center font-weight-bold text-gray-500">
            Categorías
        </h2>
    </x-slot>

    <div class="container max-w-4xl mx-auto px-4 py-8">

<!-- Formulario para editar una categoría -->
<div class="bg-white p-6 rounded-lg shadow-md space-y-6">
    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Campo para el nombre -->
        <div class="mb-4">
            <label for="name" class="block text-lg font-semibold text-gray-700">Nombre</label>
            <input type="text" name="name" id="name" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" value="{{ $category->name }}" required>
            @error('name')
                <small class="text-red-500 text-sm">{{ $message }}</small>
            @enderror
        </div>

        <!-- Campo para la descripción -->
        <div class="mb-4">
            <label for="description" class="block text-lg font-semibold text-gray-700">Descripción</label>
            <textarea name="description" id="description" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" rows="4" required>{{ $category->description }}</textarea>
            @error('description')
                <small class="text-red-500 text-sm">{{ $message }}</small>
            @enderror
        </div>

        <!-- Campo para la imagen -->
        <div class="mb-4">
            <label for="image" class="block text-lg font-semibold text-gray-700">Imagen</label>

            <!-- Mostrar la imagen actual si existe -->
            @if ($category->image)
                <div class="mb-4">
                    <img src="{{ asset('storage/' . $category->image) }}" alt="Imagen de la categoría" class="w-24 h-24 object-cover rounded-full mb-2">
                    <p class="text-sm text-gray-500">Imagen actual</p>
                </div>
            @endif

            <!-- Campo para cargar una nueva imagen -->
            <input type="file" name="image" id="image" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            @error('image')
                <small class="text-red-500 text-sm">{{ $message }}</small>
            @enderror
        </div>

        <!-- Botón para guardar -->
        <div class="text-center">
            <button type="submit" class="w-full bg-green-500 text-white py-3 px-6 rounded-lg font-semibold hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200">
                Guardar Categoría
            </button>
        </div>
    </form>
</div>
</div>
</x-app-layout>
