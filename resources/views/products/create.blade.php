<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-center font-weight-bold text-gray-500">
            Registrar Nuevo Producto
        </h2>
    </x-slot>

    <div class="container max-w-4xl mx-auto px-4 py-8">

        <!-- Formulario para crear un producto -->
        <div class="bg-white p-6 rounded-lg shadow-md space-y-6">
            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Campo para seleccionar categoría -->
                <div class="mb-4">
                    <label for="category_id" class="block text-lg font-semibold text-gray-700">Categoría</label>
                    <select name="category_id" id="category_id"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        required>
                        <option value="" disabled selected>Seleccione una categoría</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <small class="text-red-500 text-sm">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="subcategory_id" class="block text-lg font-semibold text-gray-700">Subcategoría</label>
                    <select name="subcategory_id" id="subcategory_id"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        <option value="" selected>Seleccione una subcategoría (opcional)</option>
                    </select>
                </div>

                <!-- Campo para el nombre -->
                <div class="mb-4">
                    <label for="name" class="block text-lg font-semibold text-gray-700">Nombre</label>
                    <input type="text" name="name" id="name"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        value="{{ old('name') }}" required>
                    @error('name')
                        <small class="text-red-500 text-sm">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Campo para la descripción -->
                <div class="mb-4">
                    <label for="description" class="block text-lg font-semibold text-gray-700">Descripción</label>
                    <textarea name="description" id="description"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        rows="4" required>{{ old('description') }}</textarea>
                    @error('description')
                        <small class="text-red-500 text-sm">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Campo para el stock -->
                <div class="mb-4">
                    <label for="stock" class="block text-lg font-semibold text-gray-700">Stock</label>
                    <input type="number" name="stock" id="stock"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        value="{{ old('stock') }}" required>
                    @error('stock')
                        <small class="text-red-500 text-sm">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Campo para el precio -->
                <div class="mb-4">
                    <label for="price" class="block text-lg font-semibold text-gray-700">Precio</label>
                    <input type="number" name="price" id="price"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        step="0.01" value="{{ old('price') }}" required>
                    @error('price')
                        <small class="text-red-500 text-sm">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Campo para estado activo -->
                <div class="mb-4">
                    <label for="is_active" class="block text-lg font-semibold text-gray-700">Activo</label>
                    <select name="is_active" id="is_active"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        required>
                        <option value="1" {{ old('is_active') == '1' ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <!-- Campo para el carrusel -->
                <div class="mb-4">
                    <label for="is_in_carousel" class="block text-lg font-semibold text-gray-700">Mostrar en
                        Carrusel</label>
                    <select name="is_in_carousel" id="is_in_carousel"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        required>
                        <option value="1" {{ old('is_in_carousel') == '1' ? 'selected' : '' }}>Sí</option>
                        <option value="0" {{ old('is_in_carousel') == '0' ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                <!-- Campo para múltiples imágenes -->
                <div class="mb-4">
                    <label for="images" class="block text-lg font-semibold text-gray-700">Imágenes</label>
                    <input type="file" name="images[]" id="images"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        multiple>
                    <small class="text-sm text-gray-500">Puedes subir múltiples imágenes.</small>
                    @error('images')
                        <small class="text-red-500 text-sm">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Campo para seleccionar imagen destacada -->
                <!-- <div class="mb-4">
                <label for="featured_image" class="block text-lg font-semibold text-gray-700">Imagen destacada</label>
                <select name="featured_image" id="featured_image" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    <option value="">Selecciona una imagen destacada</option>
                    {{-- Aquí se rellenarán las opciones dinámicamente en el controlador --}}
                </select>
                @error('featured_image')
    <small class="text-red-500 text-sm">{{ $message }}</small>
@enderror
            </div> -->

                <!-- Botón para guardar -->
                <div class="text-center">
                    <button type="submit"
                        class="w-full bg-green-500 text-white py-3 px-6 rounded-lg font-semibold hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200">
                        Guardar Producto
                    </button>
                </div>
            </form>
        </div>


    </div>
</x-app-layout>
@script
    <script>
        document.getElementById('category_id').addEventListener('change', function() {
            const categoryId = this.value;
            const subcategorySelect = document.getElementById('subcategory_id');

            // Limpiar las opciones previas
            subcategorySelect.innerHTML =
                '<option value="" selected>Seleccione una subcategoría (opcional)</option>';

            // Llamada AJAX
            if (categoryId) {
                fetch(`/categories/${categoryId}/subcategories`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(subcategory => {
                            const option = document.createElement('option');
                            option.value = subcategory.id;
                            option.textContent = subcategory.name;
                            subcategorySelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error al cargar subcategorías:', error);
                    });
            }
        });
    </script>
@endscript
