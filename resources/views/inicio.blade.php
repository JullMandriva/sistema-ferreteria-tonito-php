@extends('layouts.app') 

@section('title', 'Ferretería Tonito - Inicio')

@section('content')

    {{-- 
       La barra ya se carga automáticamente gracias a @extends('layouts.app') 
    --}}

    <div class="container-fluid p-0">
        {{-- Carrusel --}}
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3" aria-label="Slide 4"></button>
            </div>
            
            <div class="carousel-inner">
                
                <div class="carousel-item active">
                    <img src="{{ asset('img/compresora_carousel.webp') }}" class="d-block w-100" alt="Compresora" loading="lazy">
                </div>
                
                <div class="carousel-item">
                    <img src="{{ asset('img/OfertaSierra.webp') }}" class="d-block w-100" alt="Oferta Sierra" loading="lazy">
                </div>
                
                <div class="carousel-item">
                    <img src="{{ asset('img/ferreteria.webp') }}" class="d-block w-100" alt="Ferretería General" loading="lazy">
                </div>
                
                <div class="carousel-item">
                    <img src="{{ asset('img/llave.webp') }}" class="d-block w-100" alt="Llave Herramienta" loading="lazy">
                </div>

            </div>
            
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="container my-5">
            <h1>Bienvenido a la Ferretería Toñito</h1>
            <p>Explora nuestras categorías de productos.</p>
        </div>
    </div>

    {{-- 
       ¡FIX: También eliminamos @include('partials.footer')!
       El footer también viene incluido en layouts.app
    --}}

@endsection