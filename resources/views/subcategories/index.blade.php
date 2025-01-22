<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-center font-weight-bold text-white-500">
            SUB CATEGORIAS
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

        <h1>Subcategorías de: {{ $category->name }}</h1>
        <a href="{{ route('subcategories.create', $category->id) }}" class="btn btn-primary mb-3">Agregar
            Subcategoría</a>

        @if ($category->subcategories->isEmpty())
            <p>No hay subcategorías disponibles.</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Slug</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category->subcategories as $subcategory)
                        <tr>
                            <td>{{ $subcategory->id }}</td>
                            <td>{{ $subcategory->name }}</td>
                            <td>{{ $subcategory->description }}</td>
                            <td>{{ $subcategory->slug }}</td>
                            <td>
                                <a href="{{ route('subcategories.edit', [$subcategory->category_id, $subcategory->id]) }}"
                                    class="btn btn-warning btn-sm">Editar</a>
                                <form
                                    action="{{ route('subcategories.destroy', [$subcategory->category_id, $subcategory->id]) }}"
                                    method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('¿Estás seguro de eliminar esta subcategoría?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>
</x-app-layout>
