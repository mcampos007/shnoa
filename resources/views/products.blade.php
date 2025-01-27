<x-webpage>
    <x-slot:title>Bienvenidos a SHNOA</x-slot:title>

    <div class="container mx-auto p-6">
        <div class="flex gap-6">
            <!-- Categorías -->
            <div class="w-1/4 bg-gray-100 border border-gray-300 rounded-lg p-4">
                <h3 class="text-lg font-semibold mb-4">CATEGORÍAS</h3>
                <ul class="space-y-2">
                    @foreach ($categories as $category)
                        <li>
                            <a href="javascript:void(0);" class="text-blue-600 hover:underline font-medium category-link"
                                data-category-id="{{ $category->id }}">
                                {{ strtoupper($category->name) }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- Subcategorías y Productos -->
            <div class="flex-1 flex flex-col gap-6">
                <!-- Subcategorías -->
                <div class="bg-gray-100 border border-gray-300 rounded-lg p-4" id="subcategories-container">
                    <p class="text-gray-600">Selecciona una categoría para ver sus subcategorías.</p>
                </div>

                <!-- Productos -->
                <div class="bg-gray-100 border border-gray-300 rounded-lg p-4" id="products-container">
                    <p class="text-gray-600">Selecciona una categoría para ver sus productos.</p>
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
                                        'inline-block bg-blue-500 text-white px-4 py-2 rounded-md m-1 hover:bg-blue-600 subcategory-link';
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
                            <div class="flex items-center gap-4 p-4 border border-gray-300 rounded-lg mb-4">
                                <img src="${product.image_path}" alt="${product.name}" class="w-16 h-16 object-cover rounded-md">
                                <div>
                                    <h4 class="text-lg font-semibold">${product.name}</h4>
                                    <p class="text-sm text-gray-600">Stock: ${product.stock}</p>
                                    <p class="text-sm text-gray-600">Precio: $${parseFloat(product.price).toFixed(2)}</p>
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
