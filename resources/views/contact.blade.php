<x-webpage>
    <x-slot:title>Contacto</x-slot:title>

    <!-- Main Content -->
    <div class="container">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="contact-container">
            <!-- Left Side (Información de contacto) -->
            <div class="contact-info">
                <img src="ruta/a/foto-contacto.jpg" alt="Imagen de contacto" class="contact-image">
                <h3>Contacto</h3>
                <p><strong>Teléfono:</strong> +54 9 381 123 4567</p>
                <p><strong>Email:</strong> contacto@shnoa.com.ar</p>
                <div class="map-container">
                    <p><strong>Ubicación</strong></p>
                    <!-- Aquí iría el mapa embebido -->
                    <div class="map-placeholder">Mapa aquí</div>
                </div>
            </div>

            <!-- Right Side (Formulario de contacto) -->
            <div class="contact-form">
                <h3>Envíanos un mensaje</h3>
                <form action="{{ route('contact.send') }}" method="post">
                    @csrf
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" required placeholder="Tu nombre">

                    <label for="email">Correo Electrónico</label>
                    <input type="email" id="email" name="email" required placeholder="Tu correo electrónico">

                    <label for="mensaje">Mensaje</label>
                    <textarea id="mensaje" name="mensaje" required placeholder="Escribe tu mensaje aquí" rows="5"></textarea>

                    <button type="submit">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</x-webpage>
