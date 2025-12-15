@extends('layouts.guest')

@section('title', 'Punto de Venta (TPV)')

@section('content')
<div class="container-fluid pt-3 pb-5" style="max-width: 95%;">

    <div class="text-center mb-4 border-bottom">
        <h1 class="display-6 fw-bold text-success"><i class="bi bi-shop"></i> Módulo de Venta / Caja</h1>
        {{-- Muestra el usuario y rol actual --}}
        <p class="text-muted">Bienvenido(a), {{ Auth::user()->name }} ({{ Auth::user()->role }})</p>
    </div>

    {{-- Mostrar mensajes de éxito o error del controlador (Stock insuficiente, Venta exitosa) --}}
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row g-4">
        
        {{-- COLUMNA IZQUIERDA: BÚSQUEDA DE PRODUCTOS --}}
        <div class="col-lg-7">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white fw-bold"><i class="bi bi-search"></i> Buscar y Añadir Productos</div>
                <div class="card-body">
                    
                    {{-- Formulario de Búsqueda --}}
                    <div class="mb-3">
                        <input type="text" id="productSearch" class="form-control form-control-lg" placeholder="Escribe el nombre o SKU para buscar...">
                    </div>
                    
                    {{-- Listado de Resultados de Búsqueda (Simulación de tabla de stock) --}}
                    <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                        <table class="table table-sm table-hover table-striped">
                            <thead class="sticky-top bg-light">
                                <tr>
                                    <th>SKU</th>
                                    <th>Producto</th>
                                    <th class="text-center">Stock</th>
                                    <th class="text-end">Precio (S/.)</th>
                                    <th class="text-center">Acción</th>
                                </tr>
                            </thead>
                            <tbody id="productResults">
                                {{-- Lista de todos los productos cargados desde el controlador --}}
                                @forelse ($productos as $product)
                                <tr data-name="{{ strtolower($product->nombre) }}" data-sku="{{ strtolower($product->codigo_sku) }}">
                                    <td>{{ $product->codigo_sku }}</td>
                                    <td>{{ $product->nombre }}</td>
                                    <td class="text-center">{{ $product->cantidad }}</td>
                                    <td class="text-end">{{ number_format($product->precio, 2) }}</td>
                                    <td class="text-center">
                                        {{-- Botón para añadir al carrito --}}
                                        <button type="button" 
                                                class="btn btn-sm btn-primary add-to-cart-btn"
                                                data-id="{{ $product->id }}"
                                                data-nombre="{{ $product->nombre }}"
                                                data-precio="{{ $product->precio }}"
                                                data-stock="{{ $product->cantidad }}"
                                                {{ $product->cantidad <= 0 ? 'disabled' : '' }} {{-- Deshabilita si no hay stock --}}>
                                            <i class="bi bi-plus"></i>
                                        </button>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No hay productos disponibles para la venta.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- COLUMNA DERECHA: CARRITO DE VENTA --}}
        <div class="col-lg-5">
            <div class="card shadow-lg border-success">
                <div class="card-header bg-success text-white fw-bold"><i class="bi bi-cart"></i> Carrito (Items: <span id="cartCount">0</span>)</div>
                <div class="card-body">
                    
                    <form action="{{ route('ventas.store') }}" method="POST">
                        @csrf
                        
                        {{-- Detalles del Cliente (Opcional para Boleta/Factura) --}}
                        <div class="mb-3">
                            <label for="cliente_nombre" class="form-label small text-muted">Nombre del Cliente (Opcional)</label>
                            <input type="text" name="cliente_nombre" id="cliente_nombre" class="form-control form-control-sm">
                        </div>
                        
                        {{-- Tipo de Documento (Simple) --}}
                        <div class="mb-3">
                            <label for="documento_tipo" class="form-label small text-muted">Tipo de Documento</label>
                            <select name="documento_tipo" id="documento_tipo" class="form-select form-select-sm">
                                <option value="Boleta">Boleta</option>
                                <option value="Factura">Factura</option>
                                <option value="Ticket">Ticket</option>
                            </select>
                        </div>

                        {{-- TABLA DEL CARRITO --}}
                        <div class="table-responsive mb-3" style="min-height: 150px;">
                            <table class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th class="text-center">Cant.</th>
                                        <th class="text-end">Subtotal</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="cartTableBody">
                                    {{-- Los productos se agregarán aquí con JS --}}
                                    <tr id="emptyCartMessage">
                                        <td colspan="4" class="text-center text-muted">Carrito vacío. Agregue productos.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- RESUMEN DE TOTALES --}}
                        <h4 class="text-end fw-bolder">TOTAL: S/. <span id="grandTotal">0.00</span></h4>
                        <input type="hidden" name="total" id="inputGrandTotal" value="0.00">

                        {{-- Botón de Pago/Registro --}}
                        <div class="d-grid gap-2 mt-3">
                            <button type="submit" id="checkoutBtn" class="btn btn-success btn-lg fw-bold" disabled>
                                <i class="bi bi-wallet2"></i> Procesar Venta
                            </button>
                            <button type="button" id="clearCartBtn" class="btn btn-outline-danger btn-sm">Limpiar Carrito</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const cart = {}; // Almacena el carrito: {productId: {nombre, precio, stockMax, cantidad, precioUnitario}}
    const cartTableBody = document.getElementById('cartTableBody');
    const grandTotalElement = document.getElementById('grandTotal');
    const inputGrandTotal = document.getElementById('inputGrandTotal');
    const cartCountElement = document.getElementById('cartCount');
    const checkoutBtn = document.getElementById('checkoutBtn');
    const emptyCartMessage = document.getElementById('emptyCartMessage');
    const clearCartBtn = document.getElementById('clearCartBtn');

    // --- 1. LÓGICA DEL CARRITO ---

    function updateCartDisplay() {
        let total = 0;
        let itemCount = 0;
        cartTableBody.innerHTML = '';
        
        const cartKeys = Object.keys(cart);

        if (cartKeys.length === 0) {
            // Clonamos el mensaje para que se pueda reinsertar
            const msgRow = emptyCartMessage.cloneNode(true);
            cartTableBody.appendChild(msgRow); 
            checkoutBtn.disabled = true;
        } else {
            // Aseguramos que el mensaje vacío se remueva si existe
            const existingEmptyMsg = document.getElementById('emptyCartMessage');
            if (existingEmptyMsg) existingEmptyMsg.remove();
            
            checkoutBtn.disabled = false;
        }

        cartKeys.forEach(productId => {
            const item = cart[productId];
            const subtotal = item.cantidad * item.precio;
            total += subtotal;
            itemCount += item.cantidad;

            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.nombre}</td>
                <td class="text-center">
                    <input type="number" name="productos[${productId}][cantidad]" 
                           value="${item.cantidad}" min="1" max="${item.stockMax}"
                           data-id="${productId}" class="form-control form-control-sm text-center cart-quantity-input" style="width: 70px; display: inline-block;">
                    <input type="hidden" name="productos[${productId}][precio_unitario]" value="${item.precio}">
                </td>
                <td class="text-end cart-subtotal">S/. ${subtotal.toFixed(2)}</td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger remove-item-btn" data-id="${productId}">
                        <i class="bi bi-x"></i>
                    </button>
                </td>
            `;
            cartTableBody.appendChild(row);
        });

        grandTotalElement.textContent = total.toFixed(2);
        inputGrandTotal.value = total.toFixed(2);
        cartCountElement.textContent = cartKeys.length;
    }

    function addToCart(productId, nombre, precio, stockMax) {
        stockMax = parseInt(stockMax);
        if (stockMax <= 0) {
             alert('Este producto no tiene stock disponible.');
             return;
        }

        if (cart[productId]) {
            // Si ya está en el carrito, solo aumenta la cantidad (si hay stock)
            if (cart[productId].cantidad < stockMax) {
                cart[productId].cantidad++;
            } else {
                alert('Stock máximo (' + stockMax + ') alcanzado para ' + nombre);
            }
        } else {
            // Si es nuevo, añade 1
            cart[productId] = { 
                nombre: nombre, 
                precio: parseFloat(precio), 
                stockMax: stockMax,
                cantidad: 1, 
            };
        }
        updateCartDisplay();
    }

    // --- 2. MANEJO DE EVENTOS ---

    // Evento para añadir al carrito (desde la tabla de stock)
    document.getElementById('productResults').addEventListener('click', function(e) {
        if (e.target.classList.contains('add-to-cart-btn')) {
            const btn = e.target;
            const id = btn.dataset.id;
            const nombre = btn.dataset.nombre;
            const precio = btn.dataset.precio;
            const stock = btn.dataset.stock;
            addToCart(id, nombre, precio, stock);
        }
    });

    // Evento para cambiar la cantidad en el carrito o eliminar
    cartTableBody.addEventListener('change', function(e) {
        if (e.target.classList.contains('cart-quantity-input')) {
            const input = e.target;
            const productId = input.dataset.id;
            let newQuantity = parseInt(input.value);
            
            if (newQuantity <= 0 || isNaN(newQuantity)) {
                delete cart[productId];
            } else if (newQuantity > cart[productId].stockMax) {
                alert(`Máximo stock disponible: ${cart[productId].stockMax}`);
                newQuantity = cart[productId].stockMax;
                input.value = newQuantity;
                cart[productId].cantidad = newQuantity;
            } else {
                cart[productId].cantidad = newQuantity;
            }
            updateCartDisplay();
        }
    });

    // Evento para eliminar ítem del carrito
    cartTableBody.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-item-btn') || e.target.closest('.remove-item-btn')) {
            const btn = e.target.closest('.remove-item-btn');
            const productId = btn.dataset.id;
            delete cart[productId];
            updateCartDisplay();
        }
    });
    
    // Evento para Limpiar Carrito
    clearCartBtn.addEventListener('click', function() {
        if (confirm('¿Estás seguro de que deseas vaciar el carrito?')) {
            for (const key in cart) {
                delete cart[key];
            }
            updateCartDisplay();
        }
    });

    // Evento para búsqueda en la tabla de stock (Live Search)
    document.getElementById('productSearch').addEventListener('keyup', function(e) {
        const searchTerm = e.target.value.toLowerCase().trim();
        const rows = document.querySelectorAll('#productResults tr');

        rows.forEach(row => {
            const name = row.dataset.name || '';
            const sku = row.dataset.sku || '';

            if (name.includes(searchTerm) || sku.includes(searchTerm)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
    
    // Inicializar el carrito
    updateCartDisplay();
});
</script>

<a href="{{ route('dashboard') }}" class="btn btn-secondary mt-3 ms-4"><i class="bi bi-arrow-left"></i> Volver al Dashboard</a>
@endsection