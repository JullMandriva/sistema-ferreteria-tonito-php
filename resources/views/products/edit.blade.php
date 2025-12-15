@extends('layouts.guest')

@section('title', 'Editar Producto')

@section('content')
{{-- Importar Auth para usar Auth::user() --}}
@php
    use Illuminate\Support\Facades\Auth;
    // Importar Storage para el manejo de imágenes si lo necesitas aquí
    // use Illuminate\Support\Facades\Storage; 
@endphp

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

            {{-- IMPORTANTE: Debemos usar enctype="multipart/form-data" para permitir la subida de la imagen --}}
            <form action="{{ route('dashboard.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                {{-- Fila 1: Nombre --}}
                <div class="mb-4">
                    <label for="nombre" class="form-label">Nombre del Producto</label>
                    <input type="text" name="nombre" id="nombre" class="form-control form-control-lg @error('nombre') is-invalid @enderror" 
                           value="{{ old('nombre', $product->nombre) }}" 
                           {{ Auth::user()->isAlmacenero() ? 'readonly' : 'required' }}>
                    @error('nombre') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                {{-- Fila 2: SKU y Ubicación --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="codigo_sku" class="form-label">Código SKU</label>
                        {{-- 🛠️ MODIFICACIÓN: Se elimina el 'readonly' para que el Administrador pueda corregir el SKU --}}
                        <input type="text" name="codigo_sku" id="codigo_sku" 
                               class="form-control @error('codigo_sku') is-invalid @enderror" 
                               value="{{ old('codigo_sku', $product->codigo_sku) }}">
                        @error('codigo_sku') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    {{-- UBICACIÓN: Editable por Admin y Almacenero --}}
                    <div class="col-md-6">
                        <label for="ubicacion" class="form-label">Ubicación</label>
                        <input type="text" name="ubicacion" id="ubicacion" 
                               class="form-control @error('ubicacion') is-invalid @enderror"
                               placeholder="Agregue ubicación del producto"
                               value="{{ old('ubicacion', $product->ubicacion) }}">
                        @error('ubicacion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Fila 3: Precio y Stock --}}
                <div class="row g-3 mb-4">
                    
                    {{-- 🛑 RESTRICCIÓN DE ROL: PRECIO SOLO PARA ADMIN --}}
                    @if (Auth::user()->isAdmin())
                    <div class="col-md-6">
                        <label for="precio" class="form-label">Precio (S/.)</label>
                        <div class="input-group">
                            <span class="input-group-text">S/.</span>
                            <input type="number" step="0.01" name="precio" id="precio" 
                                   class="form-control @error('precio') is-invalid @enderror" 
                                   value="{{ old('precio', $product->precio) }}" required>
                        </div>
                        @error('precio') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    @else
                    {{-- MOSTRAR SOLO LECTURA DEL PRECIO AL ALMACENERO --}}
                    <div class="col-md-6">
                        <label for="precio_view" class="form-label text-muted">Precio Actual (Solo Admin edita)</label>
                        <div class="input-group">
                            <span class="input-group-text">S/.</span>
                            <input type="text" id="precio_view" class="form-control" 
                                   value="{{ number_format($product->precio, 2) }}" readonly>
                        </div>
                        {{-- **IMPORTANTE:** Necesitamos pasar el precio original oculto para que la validación del Controller no falle --}}
                        <input type="hidden" name="precio" value="{{ $product->precio }}">
                    </div>
                    @endif
                    {{-- 🛑 FIN RESTRICCIÓN DE ROL: PRECIO --}}

                    {{-- STOCK/CANTIDAD: Siempre editable por Admin y Almacenero --}}
                    <div class="{{ Auth::user()->isAdmin() ? 'col-md-6' : 'col-md-6' }}">
                        <label for="cantidad" class="form-label">Stock / Cantidad</label>
                        <input type="number" name="cantidad" id="cantidad" 
                               class="form-control @error('cantidad') is-invalid @enderror" 
                               value="{{ old('cantidad', $product->cantidad) }}" required>
                        @error('cantidad') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Fila 4: Descripción --}}
                <div class="mb-4">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea name="descripcion" id="descripcion" rows="4" 
                              class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion', $product->descripcion) }}</textarea>
                    @error('descripcion') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                
                {{-- 🟢 NUEVA SECCIÓN: IMAGEN --}}
                <div class="mb-4">
                    <label for="imagen" class="form-label">Imagen del Producto (Opcional)</label>
                    
                    @if ($product->imagen)
                        <div class="mb-2">
                            <img src="{{ Storage::url('images/products/' . $product->imagen) }}" 
                                 alt="Imagen actual" 
                                 style="max-width: 150px; height: auto; border: 1px solid #ccc; padding: 5px;">
                            <small class="d-block text-muted">Imagen actual. Sube una nueva para reemplazarla.</small>
                        </div>
                        
                        {{-- Opción para ELIMINAR imagen (oculto, se puede activar con JS si es necesario) --}}
                        {{-- <div class="form-check mb-2">
                            <input class="form-check-input" type="checkbox" name="remove_image" id="remove_image" value="1">
                            <label class="form-check-label text-danger" for="remove_image">
                                Eliminar imagen actual
                            </label>
                        </div> --}}
                    @else
                        <small class="d-block text-muted mb-2">Actualmente sin imagen.</small>
                    @endif
                    
                    <input type="file" name="imagen" id="imagen" 
                           class="form-control @error('imagen') is-invalid @enderror" 
                           accept="image/jpeg,image/png,image/jpg,image/webp">
                    @error('imagen') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <small class="form-text text-muted">Formatos: JPG, PNG, WEBP (Máx. 2MB)</small>
                </div>
                {{-- 🟢 FIN NUEVA SECCIÓN: IMAGEN --}}


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