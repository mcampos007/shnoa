<x-webpage>
    <x-slot:title>Bienvenidos a SHNOA</x-slot:title>
    <!-- Main Content -->
    <div class="max-w-screen-xl mx-auto px-4 py-12">
        <!-- Sección Nosotros -->
        <section class="space-y-24">
            <!-- Sección Nosotros: Texto sin animación en el h2 -->
            <div class="text-center space-y-4">
                <h2 class="text-4xl font-semibold text-gray-800">SHNOA</h2>
                <!-- Primer párrafo con animación más lenta -->
                <p class="text-lg text-gray-600 max-w-3xl mx-auto opacity-0 transform translate-y-10 transition-all duration-[4000ms] ease-out" id="intro-text-p">
                SOMOS UNA EMPRESA, DEDICADA A LA ELABORACION, VENTA Y DISTRIBUCION DE INSUMOS Y EQUIPAMIENTOS  DE LIMPIEZA. </br>
                CON MAS DE 10 AÑOS EN EL RUBRO, COMENZAMOS COMO UN MICRO EMPRENDIMIENTO FAMILIAR, QUE, CON MUCHO TRABAJO Y DEDICACION,  FUIMOS  LOGRANDO INGRESAR A UN MERCADO MAS AMPLIO Y COMPETITIVO COMO ES EL NOROESTE ARGENTINO, PARA LO CUAL   CONTAMOS CON UNA AMPLIA GAMA DE PRODUCTOS DE LIMPIEZA PARA USO, DOMESTICO, INDUSTRIAL E INSTITUCIONAL, ENTREGANDO  LA MEJOR RELACION PRECIO/ CALIDAD DEL MERCADO. 
                </p>
            </div>

            <!-- Sección sobre nosotros (Historia, Misión, Visión, Valores) -->
            <div class="space-y-16">
                <!-- Bloque 1: Imagen izquierda, texto derecha -->
                <div class="grid md:grid-cols-2 gap-12 items-center opacity-0 transform translate-y-10 transition-all duration-800 ease-out fade-in-up" data-aos="fade-up" data-aos-delay="200">
                    <div class="space-y-4 text-lg text-gray-600 bg-white p-6 shadow-xl rounded-xl transition-all duration-800 ease-out">
                        <!-- <h3 class="text-3xl font-semibold text-gray-800">Nuestra Historia</h3> -->
                        <p>ENTENDIENDO QUE ESTAMOS EN UN MUNDO  CADA DIA MAS EXIGENTE CONTAMOS CON PRODUCTOS QUIMICOS, INSUMOS Y EQUIPAMIENTOS  QUE ESTAN DIRIGIDOS A CADA PROBLEMÁTICA DE HIGIENE EN PARTICULAR, ATENDIENDO A NUESTROS DISTINGIDOS CLIENTES DE MANERA PERSONAL Y EFICIENTE, OFRECIENDOLES UNA RESPUESTA RAPIDA Y CONCRETA A CADA NECESIDAD  A TRAVES DE PRODUCTOS DE EXELENTE CALIDAD Y ESPECIFICOS PARA CADA DEMANDA</p>
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
                        <!-- <h3 class="text-3xl font-semibold text-gray-800">Misión</h3> -->
                        <p>CONTAMOS TAMBIEN CON NUESTRA PROPIA RED LOGISTICA, LOGRANDO CON ESTO ASEGURAR QUE NUESTROS PRODUCTOS LLEGUEN SEGUROS A LA PUERTA DE SU CASA, NEGOCIO, INSTITUCION, O INDUSTRIA  </p>
                    </div>
                </div>

                <!-- Bloque 3: Imagen izquierda, texto derecha -->
                <div class="grid md:grid-cols-2 gap-12 items-center opacity-0 transform translate-y-10 transition-all duration-800 ease-out fade-in-up" data-aos="fade-up" data-aos-delay="400">
                    <div class="space-y-4 text-lg text-gray-600 bg-white p-6 shadow-xl rounded-xl transition-all duration-800 ease-out">
                        <h3 class="text-3xl font-semibold text-gray-800">MISION </h3>
                        <p>NUESTRA MISION ES HACER QUE NUESTROS CLIENTES CUENTEN CON EL PRODUCTO ADECUADO PARA SU SITUACION DE HIGIENE EN PARTICULAR, ENTREGANDO NUESTROS PRODUCTOS DE MANERA RAPIDA Y SEGURA, AYUDANDOLOS CON  LA INFORMACION SUFICIENTE PARA EL MANEJO RESPONSABLE DE CADA PRODUCTO. </p>
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
                        <h3 class="text-3xl font-semibold text-gray-800">SHNOA "UNA NUEVA FORMA DE LIMPIAR"</h3>
                        <p>NUESTRA MISION ES LOGRAR A TRAVES DE NUESTROS PRODUCTOS, QUE LA LIMPIEZA NO SEA VISTA COMO UN TRABAJO INSALUBRE Y PESADO, DONDE EL CLIENTE TERMINA PAGANDO UN ALTO COSTO POR UN PRODUCTO QUE NO LE DA EL RESULTADO ESPERADO, SINO QUE A TRAVES DE PRODUCTOS ESPECIFICOS PUEDA MANTENER SU AMBIENTE HIGIENIZADO DE MANERA FACIL Y EFICIENTE.</p>
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
