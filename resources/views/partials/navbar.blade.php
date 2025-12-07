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
            <ul class="navbar-nav d-flex flex-row align-items-center ms-auto gap-4 justify-content-end pb-2 pb-lg-0">
                
                @auth
                    {{-- MENÚ USUARIO --}}
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle user-trigger" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i class="bi bi-person-circle fs-5"></i>
                            <span class="fw-bold text-white">{{ Auth::user()->name }}</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-end custom-dropdown animate slideIn" aria-labelledby="navbarDropdown">
                            <div class="dropdown-header text-muted small text-uppercase">Mi Cuenta</div>
                            <a class="dropdown-item custom-item" href="{{ route('dashboard') }}">
                                <i class="bi bi-speedometer2 me-2 text-primary"></i> Acceder al CRUD
                            </a>
                            <div class="dropdown-divider my-2"></div>
                            <a class="dropdown-item custom-item text-danger" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right me-2"></i> {{ __('Cerrar Sesión') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </div>
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

                {{-- CARRITO DE COMPRAS --}}
                <li class="nav-item">
                    <a class="nav-link text-white d-flex align-items-center gap-2" href="#">
                        <div class="position-relative">
                            <i class="bi bi-cart" style="font-size: 1.8rem;"></i> 
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-warning text-dark border border-dark" style="font-size: 0.7rem;">0</span>
                        </div>
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
                
                {{-- MENÚ DE HERRAMIENTAS (Nivel 1) --}}
                <li class="nav-item me-lg-5 dropdown hover-dropdown">
                    <a class="nav-link dropdown-toggle text-dark" href="#" id="herramientasDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Herramientas
                    </a>
                    <ul class="dropdown-menu shadow border-0 tools-menu" aria-labelledby="herramientasDropdown">
                        
                        {{-- 1. HERRAMIENTAS DE PERFORACIÓN --}}
                        <li class="dropdown-submenu position-relative">
                            <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
                                Herramientas de perforación y ajuste
                                <i class="bi bi-chevron-right ms-2" style="font-size: 0.8rem;"></i>
                            </a>
                            <ul class="dropdown-menu shadow border-0 submenu-tools">
                                <li><a class="dropdown-item" href="#">Kit's y COMBOS</a></li>
                                <li><a class="dropdown-item" href="#">Taladros percutores</a></li>
                                <li><a class="dropdown-item" href="#">Taladros atornilladores y percutores</a></li>
                                <li><a class="dropdown-item" href="#">Atornilladores de impacto</a></li>
                                <li><a class="dropdown-item" href="#">Llaves de impacto</a></li>
                                <li><a class="dropdown-item" href="#">Atornilladores compactos</a></li>
                                <li><a class="dropdown-item" href="#">Atornilladores de drywall</a></li>
                                <li><a class="dropdown-item" href="#">Rotomartillos</a></li>
                                <li><a class="dropdown-item" href="#">Demoledores</a></li>
                                <li><a class="dropdown-item" href="#">Pistolas de clavos</a></li>
                                <li><a class="dropdown-item" href="#">Mini taladros</a></li>
                                <li><a class="dropdown-item" href="#">Taladros de banco</a></li>
                            </ul>
                        </li>

                        {{-- 2. HERRAMIENTAS DE CORTE --}}
                        <li class="dropdown-submenu position-relative">
                            <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
                                Herramientas de corte
                                <i class="bi bi-chevron-right ms-2" style="font-size: 0.8rem;"></i>
                            </a>
                            <ul class="dropdown-menu shadow border-0 submenu-tools">
                                <li><a class="dropdown-item" href="#">Kit's y COMBOS</a></li>
                                <li><a class="dropdown-item" href="#">Amoladoras - Esmeriles</a></li>
                                <li><a class="dropdown-item" href="#">Sierras caladoras</a></li>
                                <li><a class="dropdown-item" href="#">Sierras circulares - radiales</a></li>
                                <li><a class="dropdown-item" href="#">Sierras ingleteadoras</a></li>
                                <li><a class="dropdown-item" href="#">Sierras tronzadoras</a></li>
                                <li><a class="dropdown-item" href="#">Sierras oscilantes</a></li>
                                <li><a class="dropdown-item" href="#">Cortadoras de concreto y marmol</a></li>
                                <li><a class="dropdown-item" href="#">Cortadoras de cerámica</a></li>
                                <li><a class="dropdown-item" href="#">Motosierras</a></li>
                                <li><a class="dropdown-item" href="#">Sierra de mesa</a></li>
                            </ul>
                        </li>

                        {{-- 3. HERRAMIENTAS DE ACABADOS --}}
                        <li class="dropdown-submenu position-relative">
                            <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
                                Herramientas de acabados
                                <i class="bi bi-chevron-right ms-2" style="font-size: 0.8rem;"></i>
                            </a>
                            <ul class="dropdown-menu shadow border-0 submenu-tools">
                                <li><a class="dropdown-item" href="#">Fresadora de palma y router</a></li>
                                <li><a class="dropdown-item" href="#">Mezcladoras y vibradoras</a></li>
                                <li><a class="dropdown-item" href="#">Lijadoras y cepilladoras</a></li>
                                <li><a class="dropdown-item" href="#">Pistola de pinturas</a></li>
                                <li><a class="dropdown-item" href="#">Compresoras</a></li>
                                <li><a class="dropdown-item" href="#">Pistolas de calor</a></li>
                                <li><a class="dropdown-item" href="#">Pulidoras</a></li>
                            </ul>
                        </li>

                        {{-- 4. HERRAMIENTAS DE LIMPIEZA --}}
                        <li class="dropdown-submenu position-relative">
                            <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
                                Herramientas de limpieza
                                <i class="bi bi-chevron-right ms-2" style="font-size: 0.8rem;"></i>
                            </a>
                            <ul class="dropdown-menu shadow border-0 submenu-tools">
                                <li><a class="dropdown-item" href="#">Aspiradoras/Sopladoras</a></li>
                                <li><a class="dropdown-item" href="#">Aspiradoras de succión</a></li>
                                <li><a class="dropdown-item" href="#">Hidrolavadoras</a></li>
                            </ul>
                        </li>

                        {{-- 5. DUPLICADORAS DE LLAVES (SIMPLE) --}}
                        <li><a class="dropdown-item" href="#">Duplicadoras de Llaves</a></li>

                        {{-- 6. EQUIPOS PARA SOLDAR --}}
                        <li class="dropdown-submenu position-relative">
                            <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
                                Equipos para soldar
                                <i class="bi bi-chevron-right ms-2" style="font-size: 0.8rem;"></i>
                            </a>
                            <ul class="dropdown-menu shadow border-0 submenu-tools">
                                <li><a class="dropdown-item" href="#">Máquinas de soldar</a></li>
                            </ul>
                        </li>
                        
                        {{-- 7. HERRAMIENTAS DE MEDICIÓN --}}
                        <li class="dropdown-submenu position-relative">
                            <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
                                Herramientas de medición
                                <i class="bi bi-chevron-right ms-2" style="font-size: 0.8rem;"></i>
                            </a>
                            <ul class="dropdown-menu shadow border-0 submenu-tools">
                                <li><a class="dropdown-item" href="#">Pinzas amperimétricas</a></li>
                                <li><a class="dropdown-item" href="#">Medidores laser</a></li>
                                <li><a class="dropdown-item" href="#">Multímetros</a></li>
                                <li><a class="dropdown-item" href="#">Detector de voltaje</a></li>
                                <li><a class="dropdown-item" href="#">Nivel laser</a></li>
                                <li><a class="dropdown-item" href="#">Reglas</a></li>
                                <li><a class="dropdown-item" href="#">Calibradores</a></li>
                                <li><a class="dropdown-item" href="#">Balanzas</a></li>
                            </ul>
                        </li>

                        {{-- 8. ACCESORIOS Y REPUESTOS --}}
                        <li class="dropdown-submenu position-relative">
                            <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
                                Accesorios y repuestos
                                <i class="bi bi-chevron-right ms-2" style="font-size: 0.8rem;"></i>
                            </a>
                            <ul class="dropdown-menu shadow border-0 submenu-tools">
                                <li><a class="dropdown-item" href="#">Para cortadoras de cerámica</a></li>
                                <li><a class="dropdown-item" href="#">Para aspirado y limpieza</a></li>
                                <li><a class="dropdown-item" href="#">Baterías y cargadores</a></li>
                                <li><a class="dropdown-item" href="#">Discos de corte</a></li>
                                <li><a class="dropdown-item" href="#">Brocas y cinceles</a></li>
                            </ul>
                        </li>


                        {{-- 9. ESCALERAS (Simple) --}}
                        <li><a class="dropdown-item" href="#">Escaleras</a></li>

                        {{-- 10. COMPRESORAS (NUEVO SUBMENÚ) --}}
                        <li class="dropdown-submenu position-relative">
                            <a class="dropdown-item d-flex justify-content-between align-items-center" href="#">
                                Compresoras
                                <i class="bi bi-chevron-right ms-2" style="font-size: 0.8rem;"></i>
                            </a>
                            <ul class="dropdown-menu shadow border-0 submenu-tools">
                                <li><a class="dropdown-item" href="#">Compresoras tradiciones</a></li>
                                <li><a class="dropdown-item" href="#">Compresoras silenciosas (Libre de aceite)</a></li>
                                <li><a class="dropdown-item" href="#">Compresoras verticales</a></li>
                            </ul>
                        </li>

                        {{-- 11. CAJAS DE HERRAMIENTAS (Simple) --}}
                        <li><a class="dropdown-item" href="#">Cajas de herramientas</a></li>
                    </ul>
                </li>

                <li class="nav-item me-lg-5"><a class="nav-link text-dark" href="{{ route('faqs.index') }}">Preguntas Frecuentes</a></li>
                <li class="nav-item"><a class="nav-link text-dark" href="#">Clientes satisfechos</a></li>
            </ul>
        </div>
    </div>
</nav>