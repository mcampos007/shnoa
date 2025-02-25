<x-webpage>
    <x-slot:title>Contacto</x-slot:title>

    <!-- Main Content -->
    <div class="container">
                <!-- Modal Success -->
                @if (session('success'))
                    <div id="successModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-30 z-50">
                        <div class="bg-green-200 text-green-800 p-6 rounded-lg shadow-xl w-96">
                            <div class="flex justify-between items-center">
                                <h4 class="text-xl font-semibold">¡Éxito!</h4>
                                <button type="button" class="text-green-800" onclick="closeModal('successModal')">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                            <p class="mt-2">{{ session('success') }}</p>
                        </div>
                    </div>
                @endif

                <!-- Modal Error -->
                @if (session('error'))
                    <div id="errorModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-30 z-50">
                        <div class="bg-red-200 text-red-800 p-6 rounded-lg shadow-xl w-96">
                            <div class="flex justify-between items-center">
                                <h4 class="text-xl font-semibold">¡Error!</h4>
                                <button type="button" class="text-red-800" onclick="closeModal('errorModal')">
                                    <i class="fa fa-times"></i>
                                </button>
                            </div>
                            <p class="mt-2">{{ session('error') }}</p>
                        </div>
                    </div>
                @endif

        <div class="contact-container flex flex-col md:flex-row">
            <!-- Left Side (Información de contacto) -->
            <div class="contact-info flex-1 mb-4 md:mb-0">
                <h3 class="text-2xl font-semibold">Contacto</h3>
                <p class="flex items-center mt-4"><i class="fa fa-phone mr-2"></i><strong>Teléfono:</strong> +54 9 381 123 4567</p>
                <p class="flex items-center mt-4"><i class="fa fa-envelope mr-2"></i><strong>Email:</strong> contacto@shnoa.com.ar</p>
                <div class="map-container mt-4">
                    <p class="flex items-center"><i class="fa fa-map-marker-alt mr-2"></i><strong>Ubicación</strong></p>
                    <!-- Aquí iría el mapa embebido -->
                    <iframe 
                    class="w-full h-64 md:h-96"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3622.912813282171!2d-65.40687692387814!3d-24.76417830688248!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x941bc3e786531583%3A0x211a2fe7f96a9a7e!2sPueyrred%C3%B3n%202070%2C%20A4400%20Salta!5e0!3m2!1ses!2sar!4v1740480866788!5m2!1ses!2sar" 
                    width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>

            <!-- Right Side (Formulario de contacto) -->
            <div class="contact-form flex-1 flex flex-col justify-between">
                <h3 class="flex items-center text-2xl font-semibold mb-2">
                    <i class="fa fa-comment mr-2"></i> Envíanos un mensaje
                </h3>
                <form action="{{ route('contact.send') }}" method="post" class="flex flex-col">
                    @csrf
                    <label for="nombre" class="mb-1">Nombre</label>
                    <input type="text" id="nombre" name="nombre" required placeholder="Tu nombre" class="mb-2 p-2 border border-gray-300 rounded">

                    <label for="email" class="mb-1">Correo Electrónico</label>
                    <input type="email" id="email" name="email" required placeholder="Tu correo electrónico" class="mb-2 p-2 border border-gray-300 rounded">

                    <!-- <label for="mensaje" class="mb-1">Mensaje</label>
                    <textarea id="mensaje" name="mensaje" required placeholder="Escribe tu mensaje aquí" rows="8" maxlength="1000" class="mb-4 p-2 border border-gray-300 rounded"></textarea> -->
                    <label for="mensaje" class="mb-1">Mensaje</label>
                    <textarea id="mensaje" name="mensaje" required placeholder="Escribe tu mensaje aquí" rows="8" maxlength="1000" class="mb-4 p-2 border border-gray-300 rounded"></textarea> 
                    @error('mensaje')
                        <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                    @enderror
                
                    <button type="submit" class="self-end bg-blue-500 text-white py-2 px-4 rounded">Enviar</button>
                </form>

            </div>
        </div>
    </div>
    <script>
        function closeModal(modalId) {
            document.getElementById(modalId).classList.add('opacity-0');
            setTimeout(function() {
                document.getElementById(modalId).classList.add('hidden');
            }, 300); // Espera la animación de opacidad
        }
    </script>
</x-webpage>