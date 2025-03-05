<x-webpage>
    <x-slot:title>Bienvenidos a SHNOA</x-slot:title>
    <div class="w-full max-w-xs bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden mb-8">
        <img src="{{ asset('storage/' . ($product->images->first()->image_path ?? 'default-image.jpg')) }}"
            alt="{{ $product->name }}" class="w-full h-64 object-cover">
        <div class="p-4">
            <h4 class="text-lg font-semibold text-gray-800 mb-2">{{ $product->name }}</h4>
            <p class="text-sm text-gray-600 mb-2">Stock: {{ $product->stock }}</p>
            <p class="text-sm text-gray-600 mb-4">Precio: ${{ $product->price }}</p>

            {{-- <a href="${cartAddUrl}${product.id}"
                class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition duration-200 ease-in-out">
                Agregar al carrito
            </a> --}}
        </div>

        <!-- Formulario para agregar al carrito -->
        <form action="{{ route('cart.add') }}" method="POST" id="add-to-cart-form-{{ $product->id }}">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}">
            <div class="flex items-center mb-4">
                <button type="button" class="px-2 py-1 bg-red-500 text-white rounded-md hover:bg-red-600 transition"
                    onclick="decreaseQuantity({{ $product->id }})">
                    -
                </button>

                <input type="text" id="quantity-{{ $product->id }}" name="quantity" value="1"
                    class="w-20 text-center mx-2 border border-gray-300 rounded-md" readonly>

                <button type="button"
                    class="px-2 py-1 bg-green-500 text-white rounded-md hover:bg-green-600 transition"
                    onclick="increaseQuantity({{ $product->id }}, {{ $product->stock }})">
                    +
                </button>
            </div>

            <button type="submit"
                class="w-full block px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition duration-200 ease-in-out">
                Agregar al carrito
            </button>
        </form>
    </div>

</x-webpage>

<script>
    function decreaseQuantity(productId) {
        const input = document.getElementById(`quantity-${productId}`);
        let currentValue = parseInt(input.value, 10) || 1;
        if (currentValue > 1) {
            input.value = currentValue - 1;
        }
    }

    function increaseQuantity(productId, maxStock) {
        const input = document.getElementById(`quantity-${productId}`);
        let currentValue = parseInt(input.value, 10) || 1;
        if (currentValue < maxStock) {
            input.value = currentValue + 1;
        }
    }

    function addToCart(productId) {
        const quantity = document.getElementById(`quantity-${productId}`).value;
        const url = `{{ url('/cart/add') }}/${productId}?quantity=${quantity}`;
        window.location.href = url;
    }
</script>
