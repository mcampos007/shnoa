<x-app-layout>
    <x-slot name="header">
        {{-- <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Categorías
        </h2> --}}
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
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-lg font-semibold">Categorías</h3>
                <a href="{{ route('categories.create') }}"
                    class="bg-blue-600 text-black px-4 py-2 rounded shadow hover:bg-gray-500 transition">
                    + Agregar Categoría
                </a>
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
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $category->description ?? 'Sin descripción' }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $category->slug }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        @if ($category->image)
                                            <img src="{{ asset('storage/' . $category->image) }}"
                                                alt="{{ $category->name }}" class="w-12 h-12 object-cover rounded">
                                        @else
                                            <span class="text-gray-500 italic">No disponible</span>
                                        @endif
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $category->user->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <div class="flex space-x-2">
                                            <a href="{{ route('categories.edit', $category->id) }}"
                                                class="text-blue-600 hover:underline">Editar</a>
                                            <form action="{{ route('categories.destroy', $category->id) }}"
                                                method="POST"
                                                onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="text-red-600 hover:underline">Eliminar</button>
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
        </div>


    </div>


</x-app-layout>






{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mb-4">Categorías</h1>


        <!-- Botón para crear una nueva categoría -->
        <div class="text-center mb-3">
            <a href="{{ route('categories.create') }}" class="btn-create-category">Crear
                Nueva Categoría</a>
        </div>

        <!-- Tabla de categorías -->
        <div class="category-table">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->id }}</td>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                @if ($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                        width="50" height="50">
                                @else
                                    <span>No disponible</span>
                                @endif
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <!-- Botones de acción para editar y eliminar -->
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn-edit">Editar</a>

                                    <!-- Formulario para eliminar una categoría -->
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                        class="d-inline-block"
                                        onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">Eliminar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>

    </div>
@endsection --}}
