@extends('layouts.guest')

@section('title', 'Panel de Control - CRUD')

@section('content')
{{-- Importar Storage para generar la URL pública de la imagen --}}
@php
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Facades\Auth; // Asegurar que Auth esté disponible
@endphp

<div class="container-fluid pt-2 pb-5" style="max-width: 95%;"> 

    {{-- Título --}}
    <div class="text-center mb-2 pb-2 border-bottom">
        <h1 class="display-5 text-dark fw-bolder">Ferretería Toñito</h1>
    </div>

    {{-- Panel de control --}}
    <div class="mx-auto mt-2" style="max-width: 95%;"> 

        {{-- Búsqueda y Botones Grid System --}}
        <div class="row g-2 mb-3">

            {{-- 1. INPUT DE BÚSQUEDA (Live Search) --}}
            <div class="col-12 col-md">
                <form id="searchForm" method="GET" action="{{ route('dashboard') }}">
                    <input type="text" id="liveSearchInput" name="search" class="form-control" placeholder="Buscar por nombre o SKU..." value="{{ request('search') }}" autocomplete="off">
                </form>
            </div>

            {{-- 2. BOTÓN REGRESAR --}}
            <div class="col-6 col-md-auto">
                <a href="{{ url('/') }}" class="btn btn-outline-secondary w-100 text-nowrap">
                    <i class="bi bi-arrow-left-circle"></i> Regresar
                </a>
            </div>

            {{-- 🟢 NUEVO BOTÓN: FAQ (Visible para todos los logueados) --}}
            <div class="col-6 col-md-auto">
                <a href="{{ route('faqs.index') }}" class="btn btn-outline-info w-100 text-nowrap fw-bold">
                    <i class="bi bi-patch-question"></i> FAQ
                </a>
            </div>
            {{-- 🟢 FIN NUEVO BOTÓN --}}

            {{-- 3. BOTÓN RECEPCIONAR (Solo Admin y Almacenero) --}}
            @if (Auth::user()->isAdmin() || Auth::user()->isAlmacenero())
            <div class="col-6 col-md-auto">
                {{-- Nota: Asumo que Recepcionar está relacionado con el Almacén --}}
                <a href="#" class="btn btn-warning w-100 text-nowrap fw-bold">
                    <i class="bi bi-truck"></i> Recepcionar
                </a>
            </div>
            @endif
            
            {{-- 🟢 NUEVO BOTÓN: HISTORIAL DE CAMBIOS (Solo Admin y Almacenero) --}}
            @if (Auth::user()->isAdmin() || Auth::user()->isAlmacenero())
            <div class="col-6 col-md-auto">
                <a href="{{ route('historial.index') }}" class="btn btn-info text-white fw-bold w-100 text-nowrap">
                    <i class="bi bi-clock-history"></i> Historial
                </a>
            </div>
            @endif
            {{-- 🟢 FIN NUEVO BOTÓN --}}

            {{-- 4. BOTÓN NUEVO (Solo Admin y Almacenero) --}}
            @if (Auth::user()->isAdmin() || Auth::user()->isAlmacenero())
            <div class="col-6 col-md-auto">
                <a href="{{ route('dashboard.create') }}" class="btn btn-primary fw-bold w-100 text-nowrap">
                    <i class="bi bi-plus-circle"></i> Nuevo
                </a>
            </div>
            @endif

            {{-- 5. BOTÓN VENTA (Solo Admin y Vendedor) --}}
            @if (Auth::user()->isAdmin() || Auth::user()->isVendedor())
            <div class="col-6 col-md-auto">
                <a href="{{ route('ventas.index') }}" class="btn btn-success fw-bold w-100 text-nowrap">
                    <i class="bi bi-cart"></i> Venta
                </a>
            </div>
            @endif

        </div>
    </div>

    {{-- Alerta Flotante (Toast) y Error de Acceso --}}
    @if (session('success'))
        <div id="success-alert" 
             class="alert alert-success alert-dismissible fade show shadow-lg border-0" 
             role="alert" 
             style="position: fixed; top: 20px; right: 20px; z-index: 1050; min-width: 300px; opacity: 0.95;">
            
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-2 fs-5"></i>
                <strong>{{ session('success') }}</strong>
            </div>
            
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    {{-- Tabla responsive --}}
    <div class="table-responsive d-none d-md-block">
        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    {{-- NUEVA COLUMNA: IMAGEN --}}
                    <th class="text-center text-decoration-underline">Img</th>
                    {{-- FIN NUEVA COLUMNA --}}
                    <th class="text-center text-decoration-underline">Nombre</th>
                    <th class="text-center text-decoration-underline">Descripción</th>
                    <th class="text-center text-decoration-underline">Stock</th>
                    <th class="text-center text-decoration-underline">Precio</th>
                    <th class="text-center text-decoration-underline">SKU</th>
                    <th class="text-center text-decoration-underline">Ubicación</th> 
                    {{-- La columna de acciones SÓLO se muestra si Admin o Almacenero tienen acceso --}}
                    @if (Auth::user()->isAdmin() || Auth::user()->isAlmacenero())
                    <th class="text-center text-decoration-underline">Acciones</th>
                    @endif
                </tr>
            </thead>
            {{-- ID para búsqueda en vivo --}}
            <tbody id="tableBody">
                @forelse ($products as $product)
                    <tr class="product-row">
                        {{-- LÓGICA DE IMAGEN EN LA TABLA --}}
                        <td class="text-center">
                            @if ($product->imagen)
                                <img src="{{ Storage::url('images/products/' . $product->imagen) }}" 
                                     alt="{{ $product->nombre }}" 
                                     style="max-width: 50px; max-height: 50px; object-fit: cover;">
                            @else
                                <i class="bi bi-image text-muted" title="Sin imagen" style="font-size: 1.5rem;"></i>
                            @endif
                        </td>
                        {{-- FIN LÓGICA DE IMAGEN --}}
                        <td class="text-center product-name">{{ $product->nombre }}</td>
                        <td>{{ $product->descripcion }}</td>
                        <td class="text-center">{{ $product->cantidad }}</td>
                        <td class="text-center text-nowrap">S/. {{ number_format($product->precio, 2) }}</td>
                        <td class="text-center product-sku">{{ $product->codigo_sku }}</td>
                        {{-- DATO DE UBICACIÓN (Si está vacío pone ---) --}}
                        <td class="text-center text-muted small">{{ $product->ubicacion ?? '---' }}</td>
                        
                        {{-- Columna de Acciones: Mostrar solo si hay permisos de edición/eliminación --}}
                        @if (Auth::user()->isAdmin() || Auth::user()->isAlmacenero())
                        <td class="text-center">
                            <div class="d-inline-flex gap-2 justify-content-center">
                                
                                {{-- BOTÓN EDITAR (Admin y Almacenero) --}}
                                <a href="{{ route('dashboard.edit', $product->id) }}" class="btn btn-sm btn-info text-white">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                
                                {{-- BOTÓN ELIMINAR (SOLO Admin) --}}
                                @if (Auth::user()->isAdmin())
                                <button type="button" class="btn btn-sm btn-danger" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#confirmDeleteModal" 
                                        data-product-id="{{ $product->id }}" 
                                        data-product-name="{{ $product->nombre }}">
                                    <i class="bi bi-trash"></i>
                                </button>
                                @endif
                                
                            </div>
                        </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ (Auth::user()->isAdmin() || Auth::user()->isAlmacenero()) ? 8 : 7 }}" class="text-center"> {{-- Se ajusta el colspan a 8 o 7 --}}
                            Aún no hay productos registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Cards para móviles --}}
    <div class="d-block d-md-none" id="mobile-container">
        @forelse ($products as $product)
            <div class="card mb-3 shadow-sm mobile-card">
                <div class="card-body">
                    {{-- LÓGICA DE IMAGEN EN MÓVIL --}}
                    @if ($product->imagen)
                        <div class="text-center mb-2">
                             <img src="{{ Storage::url('images/products/' . $product->imagen) }}" 
                                  alt="{{ $product->nombre }}" 
                                  style="max-width: 100%; height: auto; max-height: 150px; object-fit: cover;">
                        </div>
                    @endif
                    {{-- FIN LÓGICA DE IMAGEN EN MÓVIL --}}
                    
                    <p><strong>Nombre:</strong> {{ $product->nombre }}</p>
                    <p><strong>Descripción:</strong> {{ $product->descripcion }}</p>
                    <p><strong>Stock:</strong> {{ $product->cantidad }}</p>
                    <p><strong>Precio:</strong> S/. {{ number_format($product->precio, 2) }}</p>
                    <p><strong>SKU:</strong> {{ $product->codigo_sku }}</p>
                    {{-- Ubicación en Móvil --}}
                    <p><strong>Ubicación:</strong> {{ $product->ubicacion ?? 'Sin asignar' }}</p> 
                    
                    {{-- Acciones en Móvil --}}
                    @if (Auth::user()->isAdmin() || Auth::user()->isAlmacenero())
                    <div class="d-flex gap-2 justify-content-between mt-2">
                        
                        {{-- BOTÓN EDITAR (Admin y Almacenero) --}}
                        <a href="{{ route('dashboard.edit', $product->id) }}" class="btn btn-sm btn-info text-white flex-fill">
                            <i class="bi bi-pencil-square"></i> Editar
                        </a>
                        
                        {{-- BOTÓN ELIMINAR (SOLO Admin) --}}
                        @if (Auth::user()->isAdmin())
                        <button type="button" class="btn btn-sm btn-danger flex-fill" 
                                data-bs-toggle="modal" 
                                data-bs-target="#confirmDeleteModal" 
                                data-product-id="{{ $product->id }}" 
                                data-product-name="{{ $product->nombre }}">
                            <i class="bi bi-trash"></i> Eliminar
                        </button>
                        @endif
                        
                    </div>
                    @endif
                    
                </div>
            </div>
        @empty
            <p class="text-center">Aún no hay productos registrados.</p>
        @endforelse
    </div>

</div>

{{-- Modal Confirmar Eliminación (Sólo lo ve el Admin) --}}
@if (Auth::user()->isAdmin())
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Confirmar Eliminación</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p>¿Estás seguro de eliminar el producto:</p>
                <h4 id="productNameModal" class="fw-bold text-danger"></h4>
                <p class="small text-muted">Esta acción es irreversible.</p>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancelar</button>
                <form id="deleteForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm fw-bold">Sí, Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif

<script>
    document.addEventListener("DOMContentLoaded", function() {
        // --- 1. LÓGICA DE ALERTA FLOTANTE ---
        var alertElement = document.getElementById('success-alert');
        if (alertElement) {
            setTimeout(function() {
                alertElement.style.transition = "opacity 0.5s ease";
                alertElement.style.opacity = "0";
                setTimeout(function() {
                    alertElement.remove();
                }, 500);
            }, 2000); 
        }
        
        // --- Lógica para pasar el nombre y ID al modal de eliminar ---
        var confirmDeleteModal = document.getElementById('confirmDeleteModal');
        if (confirmDeleteModal) {
            confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget; 
                var productId = button.getAttribute('data-product-id');
                var productName = button.getAttribute('data-product-name');
                
                var modalTitle = confirmDeleteModal.querySelector('#productNameModal');
                var deleteForm = confirmDeleteModal.querySelector('#deleteForm');

                modalTitle.textContent = productName;
                deleteForm.action = '/dashboard/' + productId; 
            });
        }

        // --- 2. LÓGICA DE BÚSQUEDA EN VIVO (LIVE SEARCH) ---
        const searchInput = document.getElementById('liveSearchInput');

        if(searchInput) {
            searchInput.addEventListener('keyup', function() {
                const term = searchInput.value.toLowerCase().trim();
                
                // A) FILTRO PARA ESCRITORIO (TABLA)
                const rows = document.querySelectorAll('.product-row');
                rows.forEach(row => {
                    const nameCell = row.querySelector('.product-name');
                    const skuCell = row.querySelector('.product-sku');
                    
                    if (nameCell && skuCell) {
                        const nameText = nameCell.textContent.toLowerCase();
                        const skuText = skuCell.textContent.toLowerCase();

                        if (nameText.includes(term) || skuText.includes(term)) {
                            row.style.display = ''; 
                        } else {
                            row.style.display = 'none'; 
                        }
                    }
                });

                // B) FILTRO PARA MÓVIL (CARDS)
                const cards = document.querySelectorAll('.mobile-card');
                cards.forEach(card => {
                    // Buscar en el texto completo de la card
                    const cardText = card.textContent.toLowerCase(); 
                    if (cardText.includes(term)) {
                        card.style.display = ''; 
                    } else {
                        card.style.display = 'none'; 
                    }
                });
            });

            // Evitar recarga al presionar Enter en el input (Opcional)
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                }
            });
        }
    });
</script>

@endsection