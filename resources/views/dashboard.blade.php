<x-app-layout>
    <x-slot name="header">
        {{-- <h2 style="font-size: 1.5rem; color: #f39c12; font-weight: bold; text-align: center;"> --}}
        <h2 class="text-2xl font-bold text-center font-weight-bold text-gray-500">
            {{ __('Panel de Control') }}
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

            </div>
        </div>
    </div>
</x-app-layout>
