@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="text-center mb-5">
                <h1 class="fw-bold">Contacto</h1>
                <p class="text-muted">¿Tienes alguna pregunta? Contáctanos a través de WhatsApp para recibir respuesta inmediata.</p>
            </div>

            <div class="card p-4 shadow-sm">
                <h3 class="text-center fw-bold mb-4">Atención al Cliente por WhatsApp</h3>
                
                {{-- Formulario que capturará data con JavaScript --}}
                <form id="whatsappForm" onsubmit="sendWhatsApp(event)">
                    
                    <div class="mb-3">
                        <label for="nombres_apellidos" class="form-label">Nombres y apellidos *</label>
                        <input type="text" class="form-control" id="nombres_apellidos" required placeholder="">
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="telefono" class="form-label">Teléfono *</label>
                            {{-- Se mantiene el placeholder vacío para que el JS lo maneje --}}
                            <input type="tel" class="form-control" id="telefono" required placeholder="">
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="correo_electronico" class="form-label">Correo electrónico *</label>
                            <input type="email" class="form-control" id="correo_electronico" required placeholder="">
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="mensaje" class="form-label">Mensaje o duda *</label>
                        <textarea class="form-control" id="mensaje" rows="4" required placeholder="Escribe tu consulta aquí..."></textarea>
                    </div>

                    <div class="form-check mb-4">
                        <input class="form-check-input" type="checkbox" id="terminos" required>
                        <label class="form-check-label" for="terminos">
                            Estoy de acuerdo con la <a href="{{ route('legal.privacidad') }}" target="_blank">política de privacidad</a> del sitio web. *
                        </label>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn fw-bold py-2" style="background-color: #0d6efd; color: white; border: 1px solid #0d6efd;">
                            Enviar Mensaje por WhatsApp
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script>
    const TARGET_PHONE = '51980555045'; // Número objetivo de WhatsApp
    const telefonoInput = document.querySelector("#telefono");

    // Función para restringir la entrada a números, +, y espacios
    telefonoInput.addEventListener('input', function() {
        this.value = this.value.replace(/[^0-9+ ]/g, '');
    });
    
    // ----------------------------------------------------
    // LÓGICA DE INICIALIZACIÓN Y CORRECCIÓN DEL PLACEHOLDER
    // ----------------------------------------------------
    window.addEventListener('load', function() {
        var iti = window.intlTelInput(telefonoInput, {
            initialCountry: "pe", // Perú por defecto
            separateDialCode: true,
            autoPlaceholder: "aggressive", 
            nationalMode: false, 
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });

        // Función auxiliar para actualizar el placeholder
        var updatePlaceholder = function() {
            var placeholder = iti.getPlaceholder();
            telefonoInput.placeholder = placeholder;
        };

        // 1. Aplicar el placeholder inmediatamente al cargar (SOLUCIÓN AL PROBLEMA)
        updatePlaceholder();
        
        // 2. Aplicar el placeholder cada vez que cambia la bandera
        telefonoInput.addEventListener("countrychange", updatePlaceholder);
    });
    
    // ----------------------------------------------------

    function sendWhatsApp(event) {
        event.preventDefault();

        // 1. Capturar valores
        const nombre = document.getElementById('nombres_apellidos').value;
        const email = document.getElementById('correo_electronico').value;
        const mensaje = document.getElementById('mensaje').value;
        const terminos = document.getElementById('terminos').checked;
        
        // Obtener el número completo con código de país
        const telInputInstance = window.intlTelInputGlobals.getInstance(document.querySelector("#telefono"));
        const telefonoCompleto = telInputInstance.getNumber();
        
        if (!terminos || nombre === '' || email === '' || mensaje === '') {
            return;
        }

        // 2. Construir el mensaje formateado
        const messageText = `¡Hola Ferretería Toñito! Tengo una consulta web:\n\n`
            + `*Nombre:* ${nombre}\n`
            + `*Teléfono:* ${telefonoCompleto}\n`
            + `*Correo:* ${email}\n\n`
            + `*Mensaje:* ${mensaje}`;

        // 3. Crear la URL de WhatsApp
        const encodedMessage = encodeURIComponent(messageText);
        const whatsappURL = `https://wa.me/${TARGET_PHONE}?text=${encodedMessage}`;
        
        // 4. Redirigir al usuario
        window.open(whatsappURL, '_blank');
    }
</script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css"/>
@endsection