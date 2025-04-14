<x-webpage>
    <x-slot:title>Bienvenidos a SHNOA</x-slot:title>

    <div class="container mx-auto px-4 py-10">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Categorías -->
            <aside class="w-full lg:w-1/4">
                <!-- Acordeón para móviles -->
                <div class="lg:hidden">
                    <button id="toggle-categories" class="accordion-button">
                        <span class="text-lg font-semibold text-gray-800">Categorías</span>
                        <svg class="accordion-icon" id="arrow-categories" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div id="categories-list" class="accordion-content hidden">
                        <ul class="space-y-3">
                            @foreach ($categories as $category)
                                <li>
                                    <a href="javascript:void(0);"
                                       class="block text-gray-700 text-base font-medium hover:text-indigo-600 transition category-link"
                                       data-category-id="{{ $category->id }}">
                                        {{ strtoupper($category->name) }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <!-- Categorías visibles en desktop -->
                <div class="hidden lg:block bg-white border border-gray-200 rounded-xl shadow-lg p-6 transition duration-300 hover:shadow-xl">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">Categorías</h3>
                    <ul class="space-y-3">
                        @foreach ($categories as $category)
                            <li>
                                <a href="javascript:void(0);"
                                   class="block text-gray-700 text-base font-medium hover:text-indigo-600 transition category-link"
                                   data-category-id="{{ $category->id }}">
                                    {{ strtoupper($category->name) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </aside>

            <!-- Contenido Principal -->
            <main class="flex-1 flex flex-col gap-6">
                <!-- Subcategorías -->
                <section class="bg-white border border-gray-200 rounded-xl shadow-lg p-6 transition duration-300 hover:shadow-xl" id="subcategories-container">
                    <div class="lg:hidden">
                        <button id="toggle-subcategories" class="accordion-button">
                            <span class="text-lg font-semibold text-gray-800">Subcategorías</span>
                            <svg class="accordion-icon" id="arrow-subcategories" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div id="subcategories-wrapper" class="accordion-content hidden"></div>
                    </div>

                    <div class="hidden lg:block" id="subcategories-wrapper-lg">
                        <p class="text-gray-700 text-base">Selecciona una categoría para ver sus subcategorías.</p>
                    </div>
                </section>

                <!-- Productos -->
                <section class="bg-white border border-gray-200 rounded-xl shadow-lg p-6 transition duration-300 hover:shadow-xl" id="products-container">
                    <p class="text-gray-700 text-base">Selecciona una categoría para ver sus productos.</p>
                </section>
            </main>
        </div>
    </div>

    <script>
        function setupAccordion(toggleBtnId, contentId, arrowId) {
            const btn = document.getElementById(toggleBtnId);
            const content = document.getElementById(contentId);
            const arrow = document.getElementById(arrowId);

            btn.addEventListener('click', () => {
                content.classList.toggle('hidden');
                content.classList.toggle('animate-slide-down');
                arrow.classList.toggle('rotate-180');
            });
        }

        setupAccordion('toggle-categories', 'categories-list', 'arrow-categories');
        setupAccordion('toggle-subcategories', 'subcategories-wrapper', 'arrow-subcategories');

        document.addEventListener('DOMContentLoaded', function () {
            const links = document.querySelectorAll('.category-link');
            const subcategoriesWrapper = document.getElementById('subcategories-wrapper');
            const subcategoriesWrapperLg = document.getElementById('subcategories-wrapper-lg');
            const productsContainer = document.getElementById('products-container');

            links.forEach(link => {
                link.addEventListener('click', function () {
                    const categoryId = this.dataset.categoryId;

                    fetch(`ws-categories/${categoryId}`)
                        .then(response => response.json())
                        .then(data => {
                            subcategoriesWrapper.innerHTML = '';
                            subcategoriesWrapperLg.innerHTML = '';

                            if (data.subcategories.length > 0) {
                                const label = document.createElement('p');
                                label.className = 'text-gray-800 font-semibold mb-2';
                                label.textContent = 'Subcategorías';

                                const container = document.createElement('div');
                                container.className = 'flex flex-wrap gap-2';

                                data.subcategories.forEach(subcategory => {
                                    const subcategoryLink = document.createElement('a');
                                    subcategoryLink.href = '#';
                                    subcategoryLink.textContent = subcategory.name;
                                    subcategoryLink.className =
                                        'bg-indigo-100 text-indigo-800 font-medium px-4 py-1 rounded-full hover:bg-indigo-200 transition subcategory-link';
                                    subcategoryLink.dataset.subcategoryId = subcategory.id;

                                    subcategoryLink.addEventListener('click', function (e) {
                                        e.preventDefault();
                                        loadSubcategoryProducts(subcategory.id);
                                    });

                                    container.appendChild(subcategoryLink);
                                });

                                subcategoriesWrapper.appendChild(label.cloneNode(true));
                                subcategoriesWrapper.appendChild(container.cloneNode(true));
                                subcategoriesWrapperLg.appendChild(label);
                                subcategoriesWrapperLg.appendChild(container);
                            } else {
                                subcategoriesWrapper.innerHTML = '<p class="text-gray-600">No hay subcategorías disponibles.</p>';
                                subcategoriesWrapperLg.innerHTML = '<p class="text-gray-600">No hay subcategorías disponibles.</p>';
                            }

                            renderProducts(data.products);
                        })
                        .catch(error => {
                            console.error('Error al cargar los datos:', error);
                            subcategoriesWrapper.innerHTML = '<p class="text-red-500">Error al cargar las subcategorías.</p>';
                            subcategoriesWrapperLg.innerHTML = '<p class="text-red-500">Error al cargar las subcategorías.</p>';
                            productsContainer.innerHTML = '<p class="text-red-500">Error al cargar los productos.</p>';
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
                        productsContainer.innerHTML = '<p class="text-red-500">Error al cargar los productos de la subcategoría.</p>';
                    });
            }

            function renderProducts(products) {
                productsContainer.innerHTML = '';
                if (products.length > 0) {
                    const grid = document.createElement('div');
                    grid.className = 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6';

                    products.forEach(product => {
                        const cartAddUrl = "{{ url('/cart/add') }}/";
                        const productHTML = `
                            <div class="bg-white border border-gray-300 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden transform hover:-translate-y-1 animate-fade-in">
                                <img src="storage/${product.image_path}" alt="${product.name}" class="w-full h-56 object-cover">
                                <div class="p-4 flex flex-col justify-between h-[200px]">
                                    <div>
                                        <h4 class="text-lg font-semibold text-gray-800 mb-1 line-clamp-2">${product.name}</h4>
                                        <p class="text-base font-bold text-indigo-600 mt-1">$${parseFloat(product.price).toFixed(2)}</p>
                                    </div>
                                    <a href="${cartAddUrl}${product.id}" class="mt-4 block w-full text-center px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                                         Agregar al carrito
                                    </a>
                                </div>
                            </div>
                        `;
                        grid.innerHTML += productHTML;
                    });

                    productsContainer.appendChild(grid);
                } else {
                    productsContainer.innerHTML = '<p class="text-gray-600">No hay productos disponibles.</p>';
                }
            }
        });
    </script>

    <style>
        .accordion-button {
            width: 100%;
            background-color: white;
            border: 1px solid #d1d5db;
            padding: 0.75rem 1.25rem;
            border-radius: 0.75rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s, box-shadow 0.3s;
        }

        .accordion-button:hover {
            background-color: #f9fafb;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .accordion-icon {
            width: 1.25rem;
            height: 1.25rem;
            color: #6b7280;
            transition: transform 0.3s ease-in-out;
        }

        .accordion-content {
            margin-top: 0.75rem;
            background-color: white;
            border: 1px solid #e5e7eb;
            border-radius: 0.75rem;
            padding: 1rem;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
            animation: fade-in 0.3s ease-in-out;
        }

        @keyframes slide-down {
            from { opacity: 0; transform: translateY(-4px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-slide-down {
            animation: slide-down 0.25s ease-out;
        }

        @keyframes fade-in {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        .animate-fade-in {
            animation: fade-in 0.4s ease-in-out;
        }
    </style>
</x-webpage>
