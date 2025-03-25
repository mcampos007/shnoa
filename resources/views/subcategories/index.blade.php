<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-center text-white">
            SUB CATEGORÍAS
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

        <form action="{{ route('subcategories.index', $category->id) }}" method="GET">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar subcategoría">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-700">
                <i class="fa fa-search"></i> Buscar
            </button>
        </form>


        <h1 class="text-2xl font-semibold mb-4">Subcategorías de: {{ $category->name }}</h1>
        <a href="{{ route('subcategories.create', $category->id) }}"
            class="bg-green-600 text-white px-8 py-3 text-lg rounded shadow hover:bg-green-700 transition inline-block mb-4">
            Agregar Subcategoría
        </a>

        @if ($category->subcategories->isEmpty())
            <p>No hay subcategorías disponibles.</p>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-200 shadow-lg">
                    <thead class="bg-gray-100 text-gray-800">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Nombre</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Descripción</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Slug</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($subcategories as $subcategory)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 px-4 py-2">{{ $subcategory->id }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $subcategory->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $subcategory->description }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $subcategory->slug }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <div class="flex space-x-4">
                                        <!-- Editar -->
                                        <a href="{{ route('subcategories.edit', [$subcategory->category_id, $subcategory->id]) }}"
                                            class="text-blue-600 hover:text-blue-800">
                                            <i class="fa fa-pencil-alt"></i>
                                        </a>

                                        <!-- Eliminar -->
                                        <form
                                            action="{{ route('subcategories.destroy', [$subcategory->category_id, $subcategory->id]) }}"
                                            method="POST"
                                            onsubmit="return confirm('¿Estás seguro de eliminar esta subcategoría?')"
                                            style="display:inline-block;">
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
                <!-- Links de paginación -->
                {{ $subcategories->appends(['search' => request('search')])->links() }}
            </div>
        @endif
    </div>

    <script>
        // Función para cerrar los modales de éxito y error
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('opacity-0');
            setTimeout(function() {
                document.getElementById(modalId).classList.add('hidden');
            }, 300);
        }
    </script>
</x-app-layout>
