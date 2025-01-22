<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-center font-weight-bold text-white-500">
            EDITAR SUB CATEGORÍA
        </h2>
    </x-slot>
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger bg-white text-danger border border-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>


    <div class="container">
        <h1>Editar Subcategoría de: {{ $category->name }}</h1>


        <!-- Formulario para editar la subcategoría -->
        <form
            action="{{ route('subcategories.update', ['category' => $category->id, 'subcategory' => $subcategory->id]) }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH') <!-- Indicamos que es un PUT para actualizar -->

            <input type="hidden" name="category_id" value="{{ $category->id }}">

            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="name" id="name" class="form-control"
                    value="{{ old('name', $subcategory->name) }}" required>
                @error('name')
                    <small class="text-red-500 text-sm">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Descripción</label>
                <textarea name="description" id="description" class="form-control">{{ old('description', $subcategory->description) }}</textarea>
                @error('description')
                    <small class="text-red-500 text-sm">{{ $message }}</small>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="block text-lg font-semibold text-gray-700">Imagen</label>
                <input type="file" name="image" id="image"
                    class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                @if ($subcategory->image)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $subcategory->image) }}" alt="Imagen actual"
                            class="w-32 h-32 object-cover">
                    </div>
                @endif
                @error('image')
                    <small class="text-red-500 text-sm">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-success">Actualizar</button>
        </form>

        <!-- Formulario Cancelar -->
        <form action="{{ route('subcategories.index', $category->id) }}" method="GET" style="display: inline;">
            <button type="submit" class="btn btn-secondary">Cancelar</button>
        </form>
    </div>
</x-app-layout>
