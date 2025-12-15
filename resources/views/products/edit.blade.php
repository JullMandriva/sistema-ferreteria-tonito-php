@extends('layouts.guest')

@section('title', 'Editar Producto')

@section('content')

{{-- Contenedor principal --}}
<div class="container d-flex justify-content-center align-items-center min-vh-100 py-5">
    
    <div class="card shadow-lg border-0 card-rounded" style="width: 100%; max-width: 800px;">
        
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3 card-header-rounded">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-pencil-square fs-4"></i>
                <div>
                    <h5 class="mb-0 fw-bold">Editar Producto</h5>
                    <small class="text-white-50">SKU: {{ $product->codigo_sku }}</small>
                </div>
            </div>
            
            <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm text-primary fw-bold shadow-sm">
                <i class="bi bi-arrow-return-left"></i> Volver
            </a>
        </div>

        <div class="card-body p-4 p-md-5">
            
            @if ($errors->any())
                <div class="alert alert-danger shadow-sm border-0 rounded-3">
                    <ul class="mb-0 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('dashboard.update', $product->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Fila 1: Nombre --}}
                <div class="mb-4">
                    <label for="nombre" class="form-label">Nombre del Producto</label>
                    <input type="text" name="nombre" id="nombre" class="form-control form-control-lg" 
                           value="{{ old('nombre', $product->nombre) }}" required>
                </div>

                {{-- Fila 2: SKU y Ubicación --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="codigo_sku" class="form-label">Código SKU</label>
                        <input type="text" name="codigo_sku" id="codigo_sku" class="form-control" 
                               value="{{ old('codigo_sku', $product->codigo_sku) }}" required>
                    </div>
                    
                    {{-- CAMPO NUEVO: UBICACIÓN --}}
                    <div class="col-md-6">
                        <label for="ubicacion" class="form-label">Ubicación</label>
                        <input type="text" name="ubicacion" id="ubicacion" class="form-control" 
                               placeholder="Agregue ubicación del producto"
                               value="{{ old('ubicacion', $product->ubicacion) }}">
                    </div>
                </div>

                {{-- Fila 3: Precio y Stock --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="precio" class="form-label">Precio (S/.)</label>
                        <div class="input-group">
                            <span class="input-group-text">S/.</span>
                            <input type="number" step="0.01" name="precio" id="precio" class="form-control" 
                                   value="{{ old('precio', $product->precio) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="cantidad" class="form-label">Stock / Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" class="form-control" 
                               value="{{ old('cantidad', $product->cantidad) }}" required>
                    </div>
                </div>

                {{-- Fila 4: Descripción --}}
                <div class="mb-4">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea name="descripcion" id="descripcion" rows="4" class="form-control">{{ old('descripcion', $product->descripcion) }}</textarea>
                </div>

                {{-- Botón Actualizar --}}
                <div class="d-grid pt-2">
                    <button type="submit" class="btn btn-primary btn-lg fw-bold shadow">
                        <i class="bi bi-check-circle-fill"></i> Actualizar Producto
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection