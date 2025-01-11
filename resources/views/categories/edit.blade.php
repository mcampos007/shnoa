<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Categorías
        </h2> --}}
    </x-slot>

    <div class="container">
        <h1 class="mb-4">Editar Categoría</h1>

        <!-- Formulario para editar una categoría -->
        <div class="category-form">
            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Campo para el nombre -->
                <div class="form-group mb-3">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ $category->name }}" required>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Campo para la descripción -->
                <div class="form-group mb-3">
                    <label for="description">Descripción</label>
                    <textarea name="description" id="description" class="form-control" rows="4" required>{{ $category->description }}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="image">Imagen</label>

                    <!-- Mostrar la imagen actual si existe -->
                    @if ($category->image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $category->image) }}" alt="Imagen de la categoría"
                                style="max-width: 200px; border-radius: 8px;">
                        </div>
                    @endif

                    <!-- Campo para cargar una nueva imagen -->
                    <input type="file" name="image" id="image" class="form-control">
                    @error('image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Botón para guardar -->
                <div class="text-center">
                    <button type="submit" class="btn-create-category">Guardar Categoría</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
