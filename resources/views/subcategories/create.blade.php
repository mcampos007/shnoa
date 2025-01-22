<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-center font-weight-bold text-white-500">
            AGREGAR SUB CATEGORÍAS
        </h2>
    </x-slot>
    <div class="container">
        <h1>Agregar Subcategoría a: {{ $category->name }}</h1>
        <form action="{{ route('subcategories.store', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="category_id" value="{{ $category->id }}">

            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" class="form-control" required>
                @error('name')
                    <small class="text-red-500 text-sm">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea name="description" id="description" class="form-control"></textarea>
                @error('description')
                    <small class="text-red-500 text-sm">{{ $message }}</small>
                @enderror
            </div>



            <div class="mb-4">
                <label for="image" class="block text-lg font-semibold text-gray-700">Imagen</label>
                <input type="file" name="image" id="image"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                @error('image')
                    <small class="text-red-500 text-sm">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Guardar</button>
        </form>

        <!-- Formulario Cancelar -->
        <form action="{{ route('subcategories.index', $category->id) }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-secondary">Cancelar</button>
        </form>
    </div>


</x-app-layout>
