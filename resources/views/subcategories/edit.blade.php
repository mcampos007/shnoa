<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-center text-gray-500">
            Editar Subcategoría
        </h2>
    </x-slot>

    <div class="container max-w-4xl mx-auto px-4 py-8">

        <!-- Mensajes de error -->
        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded-lg border border-red-300 mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="text-sm">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Título y formulario -->
        <div class="bg-white p-6 rounded-lg shadow-md space-y-6">
            <h1 class="text-2xl font-semibold text-gray-800 mb-4">Editar Subcategoría de: {{ $category->name }}</h1>

            <form action="{{ route('subcategories.update', ['category' => $category->id, 'subcategory' => $subcategory->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')

                <input type="hidden" name="category_id" value="{{ $category->id }}">

                <!-- Campo para el nombre -->
                <div class="mb-4">
                    <label for="name" class="block text-lg font-semibold text-gray-700">Nombre</label>
                    <input type="text" name="name" id="name" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" value="{{ old('name', $subcategory->name) }}" required>
                    @error('name')
                        <small class="text-red-500 text-sm">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Campo para la descripción -->
                <div class="mb-4">
                    <label for="description" class="block text-lg font-semibold text-gray-700">Descripción</label>
                    <textarea name="description" id="description" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" rows="4">{{ old('description', $subcategory->description) }}</textarea>
                    @error('description')
                        <small class="text-red-500 text-sm">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Campo para la imagen -->
                <div class="mb-4">
                    <label for="image" class="block text-lg font-semibold text-gray-700">Imagen</label>
                    <input type="file" name="image" id="image" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                    @if ($subcategory->image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $subcategory->image) }}" alt="Imagen actual" class="w-32 h-32 object-cover rounded">
                        </div>
                    @endif
                    @error('image')
                        <small class="text-red-500 text-sm">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Botón para actualizar -->
                <div class="text-center">
                    <button type="submit" class="w-full bg-green-500 text-white py-3 px-6 rounded-lg font-semibold hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-200">
                        Actualizar Subcategoría
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
