@extends('layouts.guest') 

@section('title', 'Acceso de Trabajadores')

@section('content')

    {{-- CONTENEDOR PARA CENTRAR VERTICALMENTE (SOLO PARA EL LOGIN) --}}
    <div class="d-flex justify-content-center align-items-center min-vh-100 p-3">
        
        <div class="login-container p-4 p-md-5">
            <div class="text-center mb-4">
                <img src="{{ asset('img/IconoFerreteria_2.webp') }}" alt="Logo" width="50" height="50" class="mb-2">
                <h4 class="mb-0 text-primary fw-bold">ACCESO TRABAJADORES</h4>
                <small class="text-muted">Ingrese su nombre de usuario o correo.</small>
            </div>
            
            <form method="POST" action="{{ route('authenticate') }}"> 
                @csrf 
                
                @error('username')
                    <div class="alert alert-danger p-2 small" role="alert">
                        {{ $message }}
                    </div>
                @enderror

                <div class="mb-3">
                    <label for="username" class="form-label visually-hidden">Usuario o Correo:</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light-subtle"><i class="bi bi-person-fill"></i></span>
                        <input type="text" name="username" id="username" class="form-control" placeholder="Usuario o Correo" required autofocus>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label visually-hidden">Contraseña:</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light-subtle"><i class="bi bi-lock-fill"></i></span>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
                    </div>
                </div>

                <div class="d-grid mt-4">
                    <button type="submit" class="btn btn-primary btn-lg fw-bold">Ingresar</button>
                </div>
            </form>

            <div class="text-center mt-3">
                <a href="{{ route('home') }}" class="text-decoration-none small text-muted">
                    <i class="bi bi-arrow-left"></i> Volver a la página principal
                </a>
            </div>
        </div>

    </div> {{-- Fin del contenedor de centrado --}}

@endsection