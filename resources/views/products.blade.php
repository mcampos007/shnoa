<x-webpage>
    <x-slot:title>Bienvenidos a SHNOA</x-slot:title>

    <div class="container mx-auto p-8">
        <div class="flex gap-8">
            <!-- Categorías -->
            <div class="w-1/4 bg-white border border-gray-200 rounded-lg shadow-lg p-4">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">CATEGORÍAS</h3>
                <ul class="space-y-3">
                    @foreach ($categories as $category)
                        <li>
                            <a href="javascript:void(0);" class="text-gray-700 text-sm hover:text-indigo-600 transition duration-200 ease-in-out category-link"
                                data-category-id="{{ $category->id }}">
                                {{ strtoupper($category->name) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Subcategorías y Productos -->
            <div class="flex-1 flex flex-col gap-8">
                <!-- Subcategorías -->
                <div class="bg-white border border-gray-200 rounded-lg shadow-lg p-4" id="subcategories-container">
                    <p class="text-gray-600 text-lg">Selecciona una categoría para ver sus subcategorías.</p>
                </div>

                <!-- Productos -->
                <div class="bg-white border border-gray-200 rounded-lg shadow-lg p-4" id="products-container">
                    <p class="text-gray-600 text-lg">Selecciona una categoría para ver sus productos.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('.category-link');
            const subcategoriesContainer = document.getElementById('subcategories-container');
            const productsContainer = document.getElementById('products-container');

            links.forEach(link => {
                link.addEventListener('click', function() {
                    const categoryId = this.dataset.categoryId;

                    fetch(`ws-categories/${categoryId}`)
                        .then(response => response.json())
                        .then(data => {
                            console.log('JSON de retorno:', data);

                            // Actualizar subcategorías
                            subcategoriesContainer.innerHTML = '';
                            if (data.subcategories.length > 0) {
                                data.subcategories.forEach(subcategory => {
                                    const subcategoryLink = document.createElement('a');
                                    subcategoryLink.href = '#';
                                    subcategoryLink.textContent = subcategory.name;
                                    subcategoryLink.className =
                                        'inline-block bg-gray-200 text-gray-700 px-4 py-1 rounded-md m-1 hover:bg-gray-300 transition duration-200 ease-in-out subcategory-link';
                                    subcategoryLink.dataset.subcategoryId = subcategory
                                        .id;

                                    subcategoryLink.addEventListener('click', function(
                                        e) {
                                        e.preventDefault();
                                        loadSubcategoryProducts(subcategory.id);
                                    });

                                    subcategoriesContainer.appendChild(subcategoryLink);
                                });
                            } else {
                                subcategoriesContainer.innerHTML =
                                    '<p class="text-gray-600">No hay subcategorías disponibles.</p>';
                            }

                            // Actualizar productos
                            renderProducts(data.products);
                        })
                        .catch(error => {
                            console.error('Error al cargar los datos:', error);
                            subcategoriesContainer.innerHTML =
                                '<p class="text-red-500">Error al cargar las subcategorías.</p>';
                            productsContainer.innerHTML =
                                '<p class="text-red-500">Error al cargar los productos.</p>';
                        });
                });
            });

            function loadSubcategoryProducts(subcategoryId) {
                fetch(`ws-subcategories/${subcategoryId}`)
                    .then(response => response.json())
                    .then(data => {
                        renderProducts(data.products);
                    })
                    .catch(error => {
                        console.error('Error al cargar los productos de la subcategoría:', error);
                        productsContainer.innerHTML =
                            '<p class="text-red-500">Error al cargar los productos de la subcategoría.</p>';
                    });
            }

            function renderProducts(products) {
                productsContainer.innerHTML = '';
                if (products.length > 0) {
                    products.forEach(product => {
                        const productHTML = `
                            <div class="w-full max-w-xs bg-white border border-gray-200 rounded-lg shadow-md overflow-hidden mb-8">
                                <img src="${product.image_path}" alt="${product.name}" class="w-full h-64 object-cover">
                                <div class="p-4">
                                    <h4 class="text-lg font-semibold text-gray-800 mb-2">${product.name}</h4>
                                    <p class="text-sm text-gray-600 mb-2">Stock: ${product.stock}</p>
                                    <p class="text-sm text-gray-600 mb-4">Precio: $${parseFloat(product.price).toFixed(2)}</p>
                                    <button class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition duration-200 ease-in-out">
                                        Agregar al carrito
                                    </button>
                                </div>
                            </div>
                        `;
                        productsContainer.innerHTML += productHTML;
                    });
                } else {
                    productsContainer.innerHTML = '<p class="text-gray-600">No hay productos disponibles.</p>';
                }
            }
        });
    </script>
</x-webpage>