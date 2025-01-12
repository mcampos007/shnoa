<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-center font-weight-bold text-gray-500">
            Editar Producto
        </h2>
    </x-slot>

    <div class="container">
        <!-- Formulario para editar un producto -->
        <div class="product-form">
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Campo para el nombre -->
                <div class="form-group mb-3">
                    <label for="name">Nombre</label>
                    <input type="text" name="name" id="name" class="form-control"
                        value="{{ old('name', $product->name) }}" required>
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Campo para la descripción -->
                <div class="form-group mb-3">
                    <label for="description">Descripción</label>
                    <textarea name="description" id="description" class="form-control" rows="4" required>{{ old('description', $product->description) }}</textarea>
                    @error('description')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Campo para el stock -->
                <div class="form-group mb-3">
                    <label for="stock">Stock</label>
                    <input type="number" name="stock" id="stock" class="form-control"
                        value="{{ old('stock', $product->stock) }}" required>
                    @error('stock')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Campo para el precio -->
                <div class="form-group mb-3">
                    <label for="price">Precio</label>
                    <input type="number" name="price" id="price" class="form-control" step="0.01"
                        value="{{ old('price', $product->price) }}" required>
                    @error('price')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Selección de categoría -->
                <div class="form-group mb-3">
                    <label for="category_id">Categoría</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value="">Seleccione una categoría</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Botón para actualizar -->
                <div class="text-center">
                    <button type="submit" class="btn-create-product">Actualizar Producto</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
