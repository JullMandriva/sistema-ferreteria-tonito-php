<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ferretería Toñito')</title>
    
    <link rel="icon" type="image/webp" href="{{ asset('img/IconoFerreteria_2.webp') }}">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Tus estilos -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <style>
        /* Estilos base limpios */
        html, body { 
            height: 100%; 
            margin: 0;
        }
        body {
            background-color: #e9ecef;
        }
        
        /* Estilo de la tarjeta de login */
        .login-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 450px;
        }
    </style>
</head>
<body>
    <div id="app">
        @yield('content')
    </div>
    
    <!-- Scripts Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Tus scripts -->
    <script src="{{ asset('js/scripts.js') }}?v={{ time() }}"></script>

    <!-- Scripts adicionales por vista -->
    @stack('scripts')

</body>
</html>
