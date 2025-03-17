<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-center text-white">
            Lista de Productos
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

        <h1 class="text-2xl font-semibold mb-4">Lista de Productos</h1>

        @if ($products->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-200 shadow-lg">
                    <thead class="bg-gray-100 text-gray-800">
                        <tr>
                            <th class="border border-gray-300 px-4 py-2 text-left">ID</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Nombre</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Descripción</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Precio</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Estado</th>
                            <th class="border border-gray-300 px-4 py-2 text-left">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr class="hover:bg-gray-50">
                                <td class="border border-gray-300 px-4 py-2">{{ $product->id }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $product->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $product->description }}</td>
                                <td class="border border-gray-300 px-4 py-2">
                                    ${{ number_format($product->price, 2) }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    {{ $product->trashed() ? 'Eliminado' : 'Activo' }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <div class="flex space-x-2">
                                        <!-- Editar -->
                                        @if (!$product->trashed())
                                            <a href="{{ route('products.edit', $product->id) }}"
                                            class="text-blue-500 hover:text-blue-600 text-lg">
                                                <i class="fa fa-pencil-alt"></i>
                                            </a>
                                        @endif

                                        <!-- Gestionar Imágenes -->
                                        <a href="{{ route('products.images.manage', $product->id) }}"
                                            class="text-yellow-500 hover:text-yellow-600 text-lg">
                                            <i class="fa fa-image"></i>
                                        </a>

                                        <!-- Restaurar / Eliminar -->
                                        @if ($product->trashed())
                                            <!-- Restaurar -->
                                            <form action="{{ route('products.restore', $product->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="text-green-500 hover:text-green-600 text-lg">
                                                    <i class="fa fa-trash-restore"></i>
                                                </button>
                                            </form>
                                        @else
                                            <!-- Eliminar -->
                                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-600 text-lg"
                                                    onclick="return confirm('¿Estás seguro de eliminar este producto?')">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-yellow-200 text-yellow-800 p-6 rounded-lg shadow-xl w-96 mt-4 mx-auto">
                <div class="flex justify-between items-center">
                    <span class="font-semibold">Aviso</span>
                    <button type="button" class="text-yellow-800" onclick="closeModal('errorModal')">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <p class="mt-2">No hay productos registrados.</p>
            </div>
        @endif

        <!-- Paginación -->
        <div class="mt-4">
            {{ $products->links() }}
        </div>
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