<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-center font-weight-bold text-gray-500">
            Categorías
        </h2>
    </x-slot>

    <div class="container max-w-4xl mx-auto px-4 py-8">

<!-- Formulario para crear una categoría -->
<div class="bg-white p-6 rounded-lg shadow-md space-y-6">
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- Campo para el nombre -->
        <div class="mb-4">
            <label for="name" class="block text-lg font-semibold text-gray-700">Nombre</label>
            <input type="text" name="name" id="name" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" value="{{ old('name') }}" required>
            @error('name')
                <small class="text-red-500 text-sm">{{ $message }}</small>
            @enderror
        </div>

        <!-- Campo para la descripción -->
        <div class="mb-4">
            <label for="description" class="block text-lg font-semibold text-gray-700">Descripción</label>
            <textarea name="description" id="description" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" rows="4" required>{{ old('description') }}</textarea>
            @error('description')
                <small class="text-red-500 text-sm">{{ $message }}</small>
            @enderror
        </div>

        <!-- Campo para la imagen -->
        <div class="mb-4">
            <label for="image" class="block text-lg font-semibold text-gray-700">Imagen</label>
            <input type="file" name="image" id="image" class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
            
            <!-- Vista previa de la imagen o nombre del archivo -->
            <div id="image-preview" class="mt-2 text-sm text-gray-500">
                <!-- Este div se actualizará con el nombre del archivo o la vista previa -->
            </div>

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

<script>
// Función para mostrar la vista previa de la imagen seleccionada
document.getElementById('image').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const previewDiv = document.getElementById('image-preview');

    if (file) {
        // Mostrar el nombre del archivo
        previewDiv.textContent = `Archivo seleccionado: ${file.name}`;

        // Mostrar una pequeña vista previa si es una imagen
        if (file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('w-16', 'h-16', 'object-cover', 'rounded');
                previewDiv.innerHTML = '';  // Limpiar contenido previo
                previewDiv.appendChild(img);  // Agregar la imagen
            };
            reader.readAsDataURL(file);
        }
    }
});
</script>
</x-app-layout>
