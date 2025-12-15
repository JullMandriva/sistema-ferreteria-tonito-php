@extends('layouts.guest')

@section('title', 'Añadir Nuevo Producto')

@section('content')

{{-- Contenedor principal --}}
<div class="container d-flex justify-content-center align-items-center min-vh-100 py-5">
    
    {{-- Tarjeta del formulario --}}
    <div class="card shadow-lg border-0 card-rounded" style="width: 100%; max-width: 800px;">
        
        {{-- Encabezado --}}
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3 card-header-rounded">
            <h4 class="mb-0 fw-bold"><i class="bi bi-box-seam"></i> Nuevo Producto</h4>
            <a href="{{ route('dashboard') }}" class="btn btn-light btn-sm text-primary fw-bold shadow-sm">
                <i class="bi bi-arrow-return-left"></i> Volver
            </a>
        </div>

        {{-- Cuerpo --}}
        <div class="card-body p-4 p-md-5">
            
            {{-- Alerta general (Opcional, útil para resumen rápido) --}}
            @if ($errors->any())
                <div class="alert alert-danger shadow-sm border-0 rounded-3 mb-4">
                    <ul class="mb-0 small">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('dashboard.store') }}" method="POST">
                @csrf

                {{-- Fila 1: Nombre --}}
                <div class="mb-4">
                    <label for="nombre" class="form-label">Nombre del Producto</label>
                    <input type="text" name="nombre" id="nombre" 
                           class="form-control form-control-lg @error('nombre') is-invalid @enderror" 
                           placeholder="Ej: Taladro Percutor..." 
                           value="{{ old('nombre') }}" required>
                    
                    @error('nombre')
                        <div class="invalid-feedback fw-bold">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Fila 2: SKU --}}
                <div class="mb-4">
                    <label for="codigo_sku" class="form-label">Código SKU</label>
                    <input type="text" name="codigo_sku" id="codigo_sku" 
                           class="form-control @error('codigo_sku') is-invalid @enderror" 
                           placeholder="Ej: HER-001" 
                           value="{{ old('codigo_sku') }}" required>
                    
                    @error('codigo_sku')
                        <div class="invalid-feedback fw-bold d-block">
                            <i class="bi bi-exclamation-triangle-fill"></i> {{ $message }}
                        </div>
                    @enderror
                </div>

                {{-- Fila 3: Precio y Stock --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="precio" class="form-label">Precio (S/.)</label>
                        <div class="input-group">
                            <span class="input-group-text">S/.</span>
                            <input type="number" step="0.01" name="precio" id="precio" 
                                   class="form-control @error('precio') is-invalid @enderror" 
                                   placeholder="0.00" 
                                   value="{{ old('precio') }}" required>
                        </div>
                        @error('precio')
                            <div class="invalid-feedback fw-bold d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="cantidad" class="form-label">Stock / Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" 
                               class="form-control @error('cantidad') is-invalid @enderror" 
                               placeholder="0" 
                               value="{{ old('cantidad') }}" required>
                        @error('cantidad')
                            <div class="invalid-feedback fw-bold d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Fila 4: Descripción --}}
                <div class="mb-4">
                    <label for="descripcion" class="form-label">Descripción</label>
                    {{-- Nota: En textarea, el valor old() va DENTRO de las etiquetas, no en un atributo value --}}
                    <textarea name="descripcion" id="descripcion" rows="4" class="form-control" 
                              placeholder="Escribe aquí los detalles del producto...">{{ old('descripcion') }}</textarea>
                </div>

                {{-- Botón Guardar --}}
                <div class="d-grid pt-2">
                    <button type="submit" class="btn btn-primary btn-lg fw-bold shadow">
                        <i class="bi bi-save"></i> Guardar Producto
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection