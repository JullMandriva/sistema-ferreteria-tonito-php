<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>@yield('title', 'Ferretería Toñito')</title>

    <link rel="icon" type="image/webp" href="{{ asset('img/IconoFerreteria_2.webp') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <style>
        /* --- 1. FOOTER STICKY --- */
        html, body { height: 100%; }
        body { display: flex; flex-direction: column; }
        #app { flex: 1; display: flex; flex-direction: column; }
        
        /* --- 2. CAROUSEL RESPONSIVE --- */
        .carousel-item img { height: 200px; object-fit: cover; width: 100%; }
        @media (min-width: 768px) { .carousel-item img { height: 450px; } }

        /* --- 3. TOP BAR --- */
        .top-bar-container {
            min-height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden; 
            position: relative;
            background-color: #0d6efd; 
        }
        
        @media (max-width: 576px) {
            .navbar-brand { font-size: 1.2rem !important; }
            .navbar-brand img { width: 30px !important; height: 30px !important; }
        }

        /* --- 4. ANIMACIÓN HORIZONTAL (TEXTO) --- */
        .top-bar-message {
            display: inline-block;
            white-space: nowrap;
            transition: transform 0.5s ease-in-out, opacity 0.5s ease-in-out;
            opacity: 1;
            transform: translateX(0);
            font-size: 0.85rem;
        }

        /* SALIDA: Se va a la IZQUIERDA */
        .slide-out { opacity: 0; transform: translateX(-50px); }

        /* ENTRADA: Viene de la DERECHA */
        .slide-in { animation: slideInFromRight 0.5s forwards; }

        @keyframes slideInFromRight {
            0% { opacity: 0; transform: translateX(50px); }
            100% { opacity: 1; transform: translateX(0); }
        }
    </style>
</head>

<body>
    <div id="app">
        @include('partials.navbar') 

        <main class="flex-grow-1">
            @yield('content')
        </main>

        <footer class="bg-dark text-white text-center py-3 mt-auto">
            <div class="container">
                <p class="mb-0 small">&copy; {{ date('Y') }} Ferretería Toñito. Todos los derechos reservados.</p>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('js/scripts.js') }}?v={{ time() }}"></script>

    @stack('scripts')

    {{-- 
       SCRIPT INLINE "FORZADO" 
       (Para asegurar que la animación funcione en móviles/Ngrok)
    --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const messageContainer = document.getElementById('shipping-message');
            
            // Solo ejecutamos si existe el contenedor del mensaje
            if (messageContainer) { 
                const messages = [
                    "Envíos a todo el Perú",
                    "Enviamos el mismo día tu producto",
                    "Compra 100% Segura"
                ];
                let currentIndex = 0;

                // Ponemos el primer mensaje inmediatamente
                messageContainer.textContent = messages[0];

                function updateMessage() {
                    // 1. Salida (Izquierda)
                    messageContainer.classList.add('slide-out');
                    
                    setTimeout(() => {
                        // 2. Cambio de texto
                        currentIndex = (currentIndex + 1) % messages.length;
                        messageContainer.textContent = messages[currentIndex];
                        
                        // 3. Reset posición (invisible)
                        messageContainer.classList.remove('slide-out');
                        
                        // 4. Entrada (Derecha)
                        messageContainer.classList.add('slide-in');

                        // 5. Limpieza final
                        setTimeout(() => {
                            messageContainer.classList.remove('slide-in');
                        }, 500); // Esperamos a que termine de entrar

                    }, 500); // Esperamos a que termine de salir
                }

                // Iniciamos el ciclo cada 4 segundos
                setInterval(updateMessage, 4000); 
            }
        });
    </script>

</body>
</html>