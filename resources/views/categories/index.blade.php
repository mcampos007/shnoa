<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-center text-white">
            CATEGORÍAS
        </h2>
    </x-slot>

    <div class="products-container">
        @if (session('success'))
            <div id="successModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-30 z-50">
                <div class="bg-green-200 text-green-800 p-6 rounded-lg shadow-xl w-96">
                    <div class="flex justify-between items-center">
                        <h4 class="text-xl font-semibold">¡Éxito!</h4>
                        <button type="button" class="text-green-800" onclick="closeModal('successModal')">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <p class="mt-2">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        @if (session('error'))
            <div id="errorModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-30 z-50">
                <div class="bg-red-200 text-red-800 p-6 rounded-lg shadow-xl w-96">
                    <div class="flex justify-between items-center">
                        <h4 class="text-xl font-semibold">¡Error!</h4>
                        <button type="button" class="text-red-800" onclick="closeModal('errorModal')">
                            <i class="fa fa-times"></i>
                        </button>
                    </div>
                    <p class="mt-2">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <div class="categories">
            <div class="flex justify-between items-center mb-4">
                <a href="{{ route('categories.create') }}" class="bg-green-600 text-white px-8 py-3 text-lg rounded shadow hover:bg-green-700 transition mt-[15px] inline-block">
                    Agregar Categoría
                </a>
            </div>
        </div>
    </div>

    @if ($categories->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full border-collapse border border-gray-200 shadow-lg">
                <thead class="bg-gray-100 text-gray-800">
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Nombre</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Descripción</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Slug</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Imagen</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Usuario</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="hover:bg-gray-50">
                            <td class="border border-gray-300 px-4 py-2">{{ $category->id }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $category->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $category->description ?? 'Sin descripción' }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $category->slug }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                @if ($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}" class="w-12 h-12 object-cover rounded">
                                @else
                                    <span class="text-gray-500 italic">No disponible</span>
                                @endif
                            </td>
                            <td class="border border-gray-300 px-4 py-2">{{ $category->user->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                <div class="flex space-x-4">
                                    <!-- Editar -->
                                    <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-600 hover:text-blue-800">
                                        <i class="fa fa-pencil-alt"></i>
                                    </a>

                                    <!-- Subcategorías -->
                                    <form action="{{ route('subcategories.index', $category->id) }}" method="GET">
                                        @csrf
                                        <button type="submit" class="text-yellow-600 hover:text-yellow-800">
                                            <i class="fa fa-cogs"></i>
                                        </button>
                                    </form>

                                    <!-- Eliminar -->
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            <i class="fa fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p class="text-gray-500">No hay categorías disponibles</p>
    @endif
</x-app-layout>

<script>
    // Función para cerrar los modales de éxito y error
    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('opacity-0');
        setTimeout(function() {
            document.getElementById(modalId).classList.add('hidden');
        }, 300);
    }
</script>