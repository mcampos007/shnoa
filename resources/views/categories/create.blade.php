<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Categorías
        </h2> --}}
    </x-slot>

    <div class="container">
        <h1 class="mb-4">Crear Nueva Categoría</h1>

        <!-- Formulario para crear una categoría -->
        <div class="category-form">
            <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Campo para el nombre -->
                <div class="form-group mb-3">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}"
                        required>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Campo para la descripción -->
                <div class="form-group mb-3">
                    <label for="description">Descripción</label>
                    <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description') }}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Campo para la imagen -->
                <div class="form-group mb-3">
                    <label for="image">Imagen</label>
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
