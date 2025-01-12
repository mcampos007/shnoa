<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-center font-weight-bold text-gray-500">
            Lista de Productos
        </h2>

    </x-slot>

    <div class="products-container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="categories">
            <a href="{{ route('products.create') }}"
                class="bg-blue-600 text-black px-4 py-2 rounded shadow hover:bg-gray-500 transition">
                + Agregar Producto
            </a>
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
                                        ${{ number_format($product->price, 2) }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $product->trashed() ? 'Eliminado' : 'Activo' }}</td>
                                    <td>
                                        <div class="flex space-x-2">
                                            <!-- Botón Editar -->
                                            @if (!$product->trashed())
                                                <a href="{{ route('products.edit', $product->id) }}"
                                                    class="bg-yellow-500 text-black px-4 py-2 rounded shadow hover:bg-gray-500 transition">
                                                    Editar
                                                </a>
                                            @endif

                                            <!-- Botón Eliminar o Restaurar -->
                                            @if ($product->trashed())
                                                <!-- Botón Restaurar -->
                                                <form action="{{ route('products.restore', $product->id) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit"
                                                        class="bg-green-500 text-black px-4 py-2 rounded shadow hover:bg-gray-500 transition">
                                                        Restaurar
                                                    </button>
                                                </form>
                                            @else
                                                <!-- Botón Eliminar -->
                                                <form action="{{ route('products.destroy', $product->id) }}"
                                                    method="POST" style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="bg-red-500 text-black px-4 py-2 rounded shadow hover:bg-gray-500 transition"
                                                        onclick="return confirm('¿Estás seguro de eliminar este producto?')">
                                                        Eliminar
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
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    No hay productos registrados.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        <!-- Enlaces de paginación -->
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>
