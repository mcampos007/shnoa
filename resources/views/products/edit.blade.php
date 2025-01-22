<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-center font-weight-bold text-gray-500">
            Editar Producto
        </h2>
    </x-slot>

    <div class="container max-w-4xl mx-auto px-4 py-8">

        <!-- Formulario para editar un producto -->
        <div class="bg-white p-6 rounded-lg shadow-md space-y-6">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Campo para el nombre -->
                <div class="mb-4">
                    <label for="name" class="block text-lg font-semibold text-gray-700">Nombre</label>
                    <input type="text" name="name" id="name"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        value="{{ old('name', $product->name) }}" required>
                    @error('name')
                        <small class="text-red-500 text-sm">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Campo para la descripción -->
                <div class="mb-4">
                    <label for="description" class="block text-lg font-semibold text-gray-700">Descripción</label>
                    <textarea name="description" id="description"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        rows="4" required>{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <small class="text-red-500 text-sm">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Campo para el stock -->
                <div class="mb-4">
                    <label for="stock" class="block text-lg font-semibold text-gray-700">Stock</label>
                    <input type="number" name="stock" id="stock"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        value="{{ old('stock', $product->stock) }}" required>
                    @error('stock')
                        <small class="text-red-500 text-sm">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Campo para el precio -->
                <div class="mb-4">
                    <label for="price" class="block text-lg font-semibold text-gray-700">Precio</label>
                    <input type="number" name="price" id="price"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        step="0.01" value="{{ old('price', $product->price) }}" required>
                    @error('price')
                        <small class="text-red-500 text-sm">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Selección de categoría -->
                <div class="mb-4">
                    <label for="category_id" class="block text-lg font-semibold text-gray-700">Categoría</label>
                    <select name="category_id" id="category_id"
                        class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500"
                        required>
                        <option value="" disabled selected>Seleccione una categoría</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
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
                        @foreach ($subcategories as $subcategory)
                            <option value="{{ $subcategory->id }}"
                                {{ old('subcategory_id', $product->subcategory_id) == $subcategory->id ? 'selected' : '' }}>
                                {{ $subcategory->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Botón para actualizar -->
                <div class="text-center">
                    <button type="submit"
                        class="w-full bg-green-500 text-white py-3 px-6 rounded-lg font-semibold hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200">
                        Actualizar Producto
                    </button>
                </div>
            </form>

            <!-- Enlace para gestionar imágenes -->
            <div class="text-center mt-6">
                <a href="{{ route('products.images.manage', $product->id) }}"
                    class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-700 transition duration-200">
                    Gestionar Imágenes
                </a>
            </div>
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

                        // Seleccionar subcategoría actual si existe
                        const currentSubcategoryId = "{{ $product->subcategory_id }}";
                        if (currentSubcategoryId) {
                            subcategorySelect.value = currentSubcategoryId;
                        }
                    })
                    .catch(error => {
                        console.error('Error al cargar subcategorías:', error);
                    });
            }
        });

        // Seleccionar subcategoría actual al cargar la página
        document.addEventListener('DOMContentLoaded', function() {
            const categoryId = document.getElementById('category_id').value;
            if (categoryId) {
                document.getElementById('category_id').dispatchEvent(new Event('change'));
            }
        });
    </script>
@endscript
