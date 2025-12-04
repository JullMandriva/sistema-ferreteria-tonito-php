<div class="bg-soft-blue text-center py-1 small fw-bold top-bar-container text-white" style="background-color: #0d6efd;">
    <span id="shipping-message" class="top-bar-message"></span>
</div>

<nav class="navbar navbar-expand-lg navbar-dark bg-black sticky-top">
    <div class="container-fluid py-1 py-lg-2"> 
        
        {{-- LOGO --}}
        <a class="navbar-brand text-white fw-bold d-flex align-items-center" href="{{ url('/') }}" style="font-size: 24px;">
            <img src="{{ asset('img/IconoFerreteria_2.webp') }}" alt="Logo" width="40" height="40" class="d-inline-block me-2">
            <span>Ferretería Toñito</span>
        </a>
        
        {{-- BOTÓN HAMBURGUESA --}}
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbarCollapse" aria-controls="mainNavbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbarCollapse">
            
            {{-- BUSCADOR CENTRAL --}}
            <div class="mx-auto col-12 col-lg-7 col-md-9 my-3 my-lg-0">
                <form class="d-flex" role="search">
                    <div class="input-group" style="height: 45px; border-radius: 8px; overflow: hidden;">
                        <span class="input-group-text bg-white border-0" id="basic-addon1">
                            <i class="bi bi-search"></i> 
                        </span>
                        <input class="form-control border-0 shadow-none" type="search" placeholder="Estoy buscando..." aria-label="Search">
                        <button class="btn btn-soft-blue px-4 fw-bold" type="submit" style="z-index: 10; position: relative;">
                            Buscar
                        </button>
                    </div>
                </form>
            </div>

            {{-- ZONA DE USUARIO Y CARRITO --}}
            {{-- Usamos 'justify-content-lg-end' para PC y 'justify-content-between' o 'start' en móvil si fuera necesario, 
                 pero 'gap-3' ayuda a separar --}}
            <ul class="navbar-nav d-flex flex-row align-items-center ms-auto gap-4 justify-content-end pb-2 pb-lg-0">
                
                @auth
                    {{-- MENÚ USUARIO --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-primary fw-bold d-flex align-items-center" 
                           href="#" 
                           id="userDropdown" 
                           role="button" 
                           data-bs-toggle="dropdown" 
                           aria-expanded="false">
                            <i class="bi bi-person-circle me-2 fs-4"></i> 
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2 me-2"></i> Acceder al CRUD</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i> Cerrar Sesión</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    {{-- INVITADO --}}
                    <li class="nav-item">
                        <a class="nav-link text-white d-flex align-items-center" href="{{ route('login') }}">
                            <i class="bi bi-person-circle me-2 fs-4"></i> 
                            <div class="d-flex flex-column" style="line-height: 1;">
                                <span class="fw-bold">Acceso Cuenta</span>
                            </div>
                        </a>
                    </li>
                @endauth

                {{-- CARRITO DE COMPRAS (RESTAURADO) --}}
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center gap-2" href="#">
                        {{-- Ícono con contador --}}
                        <div class="position-relative">
                            <i class="bi bi-cart" style="font-size: 1.8rem;"></i> 
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark border border-dark" style="font-size: 0.7rem;">
                                0
                            </span>
                        </div>
                        
                        {{-- Texto y Precio (Vuelven a aparecer) --}}
                        <div class="d-flex flex-column align-items-start" style="line-height: 1.2;">
                            <span class="fw-bold" style="font-size: 0.9rem;">Carrito</span>
                            <span class="text-warning small font-monospace">S/. 0.00</span>
                        </div>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>

{{-- NAVBAR SECUNDARIO (Categorías) --}}
<nav class="navbar navbar-expand-lg navbar-light d-none d-lg-block" style="background-color: #f8f9fa; border-top: 1px solid #eee;">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="secondaryNavbarCollapse">
            <ul class="navbar-nav mx-auto fw-bold">
                <li class="nav-item me-lg-5"><a class="nav-link text-dark" href="{{ url('/') }}">Inicio</a></li>
                <li class="nav-item me-lg-5 dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" data-bs-toggle="dropdown">Herramientas</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Eléctricas</a></li>
                        <li><a class="dropdown-item" href="#">Manuales</a></li>
                        <li><a class="dropdown-item" href="#">Jardinería</a></li>
                    </ul>
                </li>
                <li class="nav-item me-lg-5"><a class="nav-link text-dark" href="#">Preguntas Frecuentes</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="#">Clientes satisfechos</a></li>
            </ul>
        </div>
    </div>
</nav>