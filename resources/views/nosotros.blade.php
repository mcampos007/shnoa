<x-webpage>
    <x-slot:title>Bienvenidos a SHNOA</x-slot:title>
    <!-- Main Content -->
    <div class="max-w-screen-xl mx-auto px-4 py-12">
        <!-- Sección Nosotros -->
        <section class="space-y-24">
            <!-- Sección Nosotros: Texto sin animación en el h2 -->
            <div class="text-center space-y-4">
                <h2 class="text-4xl font-semibold text-gray-800">Sobre Nosotros</h2>
                <!-- Primer párrafo con animación más lenta -->
                <p class="text-lg text-gray-600 max-w-3xl mx-auto opacity-0 transform translate-y-10 transition-all duration-[4000ms] ease-out" id="intro-text-p">
                    En <strong>SHNOA</strong> (Servicios Higiénicos del NOA), nos especializamos en ofrecer productos de higiene y limpieza de alta calidad para empresas y hogares en toda la región del Noroeste Argentino. Con más de 10 años de experiencia en el mercado, somos un referente en el suministro de productos esenciales para mantener espacios limpios y saludables.
                </p>
            </div>

            <!-- Sección sobre nosotros (Historia, Misión, Visión, Valores) -->
            <div class="space-y-16">
                <!-- Bloque 1: Imagen izquierda, texto derecha -->
                <div class="grid md:grid-cols-2 gap-12 items-center opacity-0 transform translate-y-10 transition-all duration-800 ease-out fade-in-up" data-aos="fade-up" data-aos-delay="200">
                    <div class="space-y-4 text-lg text-gray-600 bg-white p-6 shadow-xl rounded-xl transition-all duration-800 ease-out">
                        <h3 class="text-3xl font-semibold text-gray-800">Nuestra Historia</h3>
                        <p>Fundada en 2014, SHNOA nació con el objetivo de ofrecer productos innovadores y de alta calidad en el área de la higiene. Desde entonces, hemos crecido constantemente y expandido nuestra línea de productos para cubrir las necesidades de nuestros clientes en diferentes sectores, incluyendo hospitales, industrias y hogares.</p>
                    </div>
                    <div>
                        <img src="../ASSETS/nos1.jpg" alt="Historia de SHNOA" class="rounded-xl shadow-xl transform opacity-0 scale-95 transition-all duration-1000 ease-in-out" data-aos="zoom-in" data-aos-delay="100">
                    </div>
                </div>

                <!-- Bloque 2: Imagen derecha, texto izquierda -->
                <div class="grid md:grid-cols-2 gap-12 items-center opacity-0 transform translate-y-10 transition-all duration-800 ease-out fade-in-up" data-aos="fade-up" data-aos-delay="400">
                    <div>
                        <img src="../ASSETS/nos2.jpg" alt="Misión de SHNOA" class="rounded-xl shadow-xl transform opacity-0 scale-95 transition-all duration-1000 ease-in-out" data-aos="zoom-in" data-aos-delay="100">
                    </div>
                    <div class="space-y-4 text-lg text-gray-600 bg-white p-6 shadow-xl rounded-xl transition-all duration-800 ease-out">
                        <h3 class="text-3xl font-semibold text-gray-800">Misión</h3>
                        <p>Nos dedicamos a ofrecer productos que promuevan la higiene y el bienestar de las personas, asegurando un ambiente saludable y seguro. Nuestra misión es ser líderes en el mercado regional, comprometidos con la calidad y la sostenibilidad.</p>
                    </div>
                </div>

                <!-- Bloque 3: Imagen izquierda, texto derecha -->
                <div class="grid md:grid-cols-2 gap-12 items-center opacity-0 transform translate-y-10 transition-all duration-800 ease-out fade-in-up" data-aos="fade-up" data-aos-delay="400">
                    <div class="space-y-4 text-lg text-gray-600 bg-white p-6 shadow-xl rounded-xl transition-all duration-800 ease-out">
                        <h3 class="text-3xl font-semibold text-gray-800">Visión</h3>
                        <p>Aspiramos a ser una empresa referente en la región en cuanto a la innovación en productos de higiene. Queremos llegar a más hogares y empresas, ayudando a mejorar la calidad de vida de las personas a través de productos eficaces y accesibles.</p>
                    </div>
                    <div>
                        <img src="../ASSETS/nos3.jpg" alt="Productos de SHNOA" class="rounded-xl shadow-xl transform opacity-0 scale-95 transition-all duration-1000 ease-in-out" data-aos="zoom-in" data-aos-delay="100">
                    </div>
                </div>

                <!-- Bloque 4: Imagen derecha, texto izquierda -->
                <div class="grid md:grid-cols-2 gap-12 items-center opacity-0 transform translate-y-10 transition-all duration-800 ease-out fade-in-up" data-aos="fade-up" data-aos-delay="400">
                    <div>
                        <img src="../ASSETS/nos4.jpg" alt="Valores de SHNOA" class="rounded-xl shadow-xl transform opacity-0 scale-95 transition-all duration-1000 ease-in-out" data-aos="zoom-in" data-aos-delay="100">
                    </div>
                    <div class="space-y-4 text-lg text-gray-600 bg-white p-6 shadow-xl rounded-xl transition-all duration-800 ease-out">
                        <h3 class="text-3xl font-semibold text-gray-800">Valores</h3>
                        <p>En SHNOA, nos guiamos por valores de confianza, compromiso, calidad, y respeto por el medio ambiente. Creemos firmemente en la importancia de un entorno limpio y saludable, y trabajamos para hacer realidad ese objetivo en cada producto que ofrecemos.</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- JavaScript para detectar scroll y activar las animaciones -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            // Seleccionamos todos los elementos con la clase `opacity-0` y `translate-y-10`
            const fadeInElements = document.querySelectorAll('.opacity-0');

            // Función para verificar si el elemento está parcialmente dentro del viewport
            function isPartiallyInViewport(element) {
                const rect = element.getBoundingClientRect();
                return rect.top < window.innerHeight * 0.5 && rect.bottom >= window.innerHeight * 0.5;
            }

            // Función para activar las animaciones de entrada
            function checkScroll() {
                fadeInElements.forEach((el) => {
                    if (isPartiallyInViewport(el)) {
                        el.classList.add('opacity-100', 'translate-y-0');
                        el.classList.remove('opacity-0', 'translate-y-10');
                    }
                });
            }

            window.addEventListener('scroll', function () {
                checkScroll();
            });

            // Aseguramos que las animaciones empiecen cuando la página se carga
            checkScroll(); // Comprobar al cargar la página
        });
    </script>

    <!-- Estilos para la animación de entrada -->
    <style>
        .fade-in-up {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.5s ease-out;
        }

        .fade-in-up.opacity-100 {
            opacity: 1;
            transform: translateY(0);
        }
    </style>

</x-webpage>
