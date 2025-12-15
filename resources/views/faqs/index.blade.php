@extends('layouts.app')

@section('content')
<div class="container py-5">
    
    <div class="text-center mb-5">
        <h2 class="fw-bold">Preguntas Frecuentes</h2>
        <p class="text-muted">Centro de ayuda</p>
    </div>

    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-0 bg-light p-4 sticky-top" style="top: 100px; z-index: 1;">
                <h4 class="fw-bold mb-3">Contáctanos</h4>
                <p class="text-muted small mb-4">
                    Si tienes un problema o una pregunta que requiere asistencia inmediata, 
                    estamos listos para ayudarte.
                </p>
                
                {{-- CONEXIÓN AL FORMULARIO DE WHATSAPP --}}
                <div class="d-grid gap-2">
                    <a href="{{ route('contacto.show') }}" class="btn btn-outline-dark rounded-pill">
                        Contáctanos
                    </a>
                    <button class="btn btn-dark rounded-pill">
                        Sobre nosotros
                    </button>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            
            <h4 class="fw-bold mb-3 mt-2">Compra y Atención al Cliente</h4>
            <div class="accordion mb-5" id="accordionCompra">
                @foreach($bloque_compra as $faq)
                    @include('faqs.item', ['faq' => $faq, 'parent' => 'accordionCompra'])
                @endforeach
            </div>

            <h4 class="fw-bold mb-3">Envíos y Entregas</h4>
            <div class="accordion mb-5" id="accordionEnvios">
                @foreach($bloque_envios as $faq)
                    @include('faqs.item', ['faq' => $faq, 'parent' => 'accordionEnvios'])
                @endforeach
            </div>

            <h4 class="fw-bold mb-3">Garantía y Seguridad</h4>
            <div class="accordion mb-5" id="accordionGarantia">
                @foreach($bloque_garantia as $faq)
                    @include('faqs.item', ['faq' => $faq, 'parent' => 'accordionGarantia'])
                @endforeach
            </div>

        </div>
    </div>
</div>

<style>
    /* Estilos base del botón */
    .accordion-button {
        color: #555; /* Color gris oscuro inicial */
        font-weight: 500;
        transition: all 0.2s ease; /* Suaviza el cambio de color */
    }

    /* --- NUEVO: EFECTO HOVER (Al pasar el mouse) --- */
    .accordion-button:hover {
        color: #000 !important; /* Texto negro intenso */
        background-color: #f8f9fa; /* Fondo gris muy clarito para resaltar */
        cursor: pointer;
    }

    /* Estilos cuando la pregunta está ABIERTA */
    .accordion-button:not(.collapsed) {
        color: #000;
        background-color: transparent;
        box-shadow: none;
        font-weight: bold;
    }

    /* Quitar el borde azul o resplandor al hacer clic */
    .accordion-button:focus {
        box-shadow: none;
        border-color: rgba(0,0,0,.125);
        color: #000; /* Mantiene el color oscuro si se queda seleccionado */
    }

    /* Bordes de la lista */
    .accordion-item {
        border: none;
        border-bottom: 1px solid #eee;
    }
</style>
@endsection