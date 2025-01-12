<x-app-layout>
    <x-slot name="header">
        {{-- <h2 style="font-size: 1.5rem; color: #f39c12; font-weight: bold; text-align: center;"> --}}
        <h2 class="text-2xl font-bold text-center font-weight-bold text-gray-500">
            {{ __('Dashboard') }}
        </h2>

    </x-slot>

    <!-- Mensaje de éxito -->
    @if (session('success'))
        <div class="p-4 mb-4 bg-emerald text-white rounded-lg shadow-lg">
            <strong>¡Éxito!</strong> {{ session('success') }}
        </div>
    @endif

    <!-- Mensajes de error -->
    @if ($errors->any())
        <div class="p-4 mb-4 bg-red-500 text-white rounded-lg shadow-lg">
            <strong>¡Error!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container">
        <div class="content">
            <!-- Botones para redirigir a las vistas de socios y agregar crédito -->
            <div class="form-container">
                <!-- Botón para ver la lista de Clases -->
                {{-- <a href="{{ route('admin.list-clases') }}"
                    style="display: block; background-color: #f39c12; color: #fff; text-align: center; padding: 0.75rem; border-radius: 4px; margin-bottom: 0.5rem; text-decoration: none;">
                    Clases
                </a>

                <!-- Botón para ver la lista de socios -->
                <a href="{{ route('list-socios') }}"
                    style="display: block; background-color: #f39c12; color: #fff; text-align: center; padding: 0.75rem; border-radius: 4px; margin-bottom: 0.5rem; text-decoration: none;">
                    Socios
                </a>

                <!-- Botón para ver los Días de Trabajo -->
                <a href="{{ route('work_days.index') }}"
                    style="display: block; background-color: #f39c12; color: #fff; text-align: center; padding: 0.75rem; border-radius: 4px; margin-bottom: 0.5rem; text-decoration: none;">
                    Días de Trabajo
                </a>

                <!-- Botón para ver la lista de Profesores -->
                <a href="{{ route('list-profes') }}"
                    style="display: block; background-color: #f39c12; color: #fff; text-align: center; padding: 0.75rem; border-radius: 4px; margin-bottom: 0.5rem; text-decoration: none;">
                    Profesores
                </a> --}}

                <!-- Botón para agregar crédito a los socios -->
                {{-- <a href="{{ route('admin.add-credits') }}" style="display: block; background-color: #27ae60; color: #fff; text-align: center; padding: 0.75rem; border-radius: 4px; margin-bottom: 0.5rem; text-decoration: none;">
                    Agregar Crédito a Socios
                </a> --}}
            </div>
        </div>
    </div>
</x-app-layout>
