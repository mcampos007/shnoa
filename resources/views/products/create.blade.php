<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-center font-weight-bold text-gray-500">
            Registrar Nuevo Producto
        </h2>
    </x-slot>

    <div class="container">
        <div class="category-form">

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Campo para seleccionar categoría -->
                <div class="form-group mb-3">
                    <label for="category_id">Categoría</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value="" disabled selected>Seleccione una categoría</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

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

                <!-- Campo para el stock -->
                <div class="form-group mb-3">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" id="stock" class="form-control" value="{{ old('stock') }}"
                        required>
                    @error('stock')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Campo para el precio -->
                <div class="form-group mb-3">
                    <label for="price">Precio</label>
                    <input type="number" name="price" id="price" class="form-control" step="0.01"
                        value="{{ old('price') }}" required>
                    @error('price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Campo para estado activo -->
                <div class="form-group mb-3">
                    <label for="is_active">Activo</label>
                    <select name="is_active" id="is_active" class="form-control" required>
                        <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <!-- Campo para el carrusel -->
                <div class="form-group mb-3">
                    <label for="is_in_carousel">Mostrar en Carrusel</label>
                    <select name="is_in_carousel" id="is_in_carousel" class="form-control" required>
                        <option value="1" {{ old('is_in_carousel') == '1' ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ old('is_in_carousel') == '0' ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <!-- Campo para múltiples imágenes -->
                <div class="form-group mb-3">
                    <label for="images">Imágenes</label>
                    <input type="file" name="images[]" id="images" class="form-control" multiple>
                    <small class="form-text text-muted">Puedes subir múltiples imágenes.</small>
                    @error('images')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Campo para seleccionar imagen destacada -->
                <div class="form-group mb-3">
                    <label for="featured_image">Imagen destacada</label>
                    <select name="featured_image" id="featured_image" class="form-control">
                        <option value="">Selecciona una imagen destacada</option>
                        {{-- Aquí se rellenarán las opciones dinámicamente en el controlador --}}
                    </select>
                    @error('featured_image')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Botón para guardar -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Guardar Producto</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
