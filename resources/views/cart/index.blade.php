<x-webpage>
    <x-slot:title>Carrito de Compras</x-slot:title>
    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="bg-red-500 text-white p-4 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4">Detalle del Pedido</h1>

        {{-- Sección del carrito de compras --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            {{-- Lista de productos en el carrito --}}
            <div class="bg-white p-4 shadow-md rounded-lg">
                <h2 class="text-xl font-semibold mb-4">Productos en el Carrito</h2>

                @php
                    $cart = session('cart', []);
                    $total = 0;
                @endphp

                @if (!empty($cart))
                    @foreach ($cart as $index => $item)
                        @php $total += $item['product']->price * $item['quantity']; @endphp
                        <div class="flex items-center justify-between mb-4 border-b pb-2">
                            <div class="flex items-center">
                                <img src="{{ asset('storage/' . ($item['product']->images->first()->image_path ?? 'default-image.jpg')) }}"
                                    alt="{{ $item['product']->name }}" class="w-16 h-16 object-cover rounded mr-4">
                                <div>
                                    <p class="text-lg font-medium">{{ $item['product']->name }}</p>
                                    <p class="text-sm text-gray-500">Cantidad: {{ $item['quantity'] }}</p>
                                    <p class="text-sm text-gray-500">
                                        Precio unitario: ${{ number_format($item['product']->price, 2) }}
                                    </p>
                                    <div class="flex items-center space-x-2 mt-2">
                                        {{-- Botón para decrementar la cantidad --}}
                                        <form action="{{ route('cart.updateQuantity') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="index" value="{{ $index }}">
                                            <input type="hidden" name="quantity"
                                                value="{{ max($item['quantity'] - 1, 1) }}">
                                            <button type="submit" class="px-2 py-1 bg-gray-300 text-black rounded">
                                                -
                                            </button>
                                        </form>

                                        {{-- Muestra la cantidad actual --}}
                                        <span class="px-2">{{ $item['quantity'] }}</span>

                                        {{-- Botón para incrementar la cantidad --}}
                                        <form action="{{ route('cart.updateQuantity') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="index" value="{{ $index }}">
                                            <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                                            <button type="submit" class="px-2 py-1 bg-gray-300 text-black rounded">
                                                +
                                            </button>
                                        </form>

                                        {{-- Botón para eliminar el producto del carrito --}}
                                        <form action="{{ route('cart.removeItem') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="index" value="{{ $index }}">
                                            <button type="submit" class="px-2 py-1 bg-red-500 text-white rounded">
                                                Eliminar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <p class="text-lg font-semibold">
                                ${{ number_format($item['product']->price * $item['quantity'], 2) }}
                            </p>
                        </div>
                    @endforeach


                    <div class="flex justify-between mt-4 font-bold text-lg">
                        <span>Total:</span>
                        <span>${{ number_format($total, 2) }}</span>
                    </div>
                @else
                    <p class="text-gray-500">El carrito está vacío.</p>
                @endif
            </div>

            {{-- Sección para ingresar los datos del cliente --}}
            <div class="bg-white p-4 shadow-md rounded-lg">
                <h2 class="text-xl font-semibold mb-4">Datos del Cliente</h2>

                <form action="{{ route('cart.sendOrder') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="name" class="block font-medium text-gray-700">Nombre</label>
                        <input type="text" id="name" name="name" required
                            class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="email" class="block font-medium text-gray-700">Correo Electrónico</label>
                        <input type="email" id="email" name="email" required
                            class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label for="phone" class="block font-medium text-gray-700">Teléfono</label>
                        <input type="text" id="phone" name="phone" required
                            class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                    </div>
                    <div class="mt-4">
                        <label for="observations" class="block text-lg font-medium mb-2">Observaciones del
                            Pedido:</label>
                        <textarea name="observations" id="observations" rows="4" class="w-full p-2 border border-gray-300 rounded"
                            placeholder="Agrega alguna observación especial para tu pedido..."></textarea>
                    </div>

                    <button type="submit"
                        class="w-full px-4 py-2 bg-green-500 text-white font-semibold rounded-md hover:bg-green-600 transition">
                        Enviar Pedido por Correo
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-webpage>
