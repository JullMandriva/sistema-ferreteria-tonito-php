@extends('layouts.app')

@section('content')
<div class="container py-5">
    
    {{-- TÍTULO Y FECHA DE ACTUALIZACIÓN --}}
    <h1 class="fw-bold">📄 Políticas de Privacidad – Ferretería Toñito</h1>
    <p class="text-muted small mb-5">Última actualización: 07/12/2025</p>

    <p>En Ferretería Toñito nos comprometemos a proteger la privacidad de nuestros clientes, trabajadores y usuarios que acceden a nuestro sistema o página web. La presente Política de Privacidad explica cómo recopilamos, usamos y protegemos la información personal.</p>

    ---

    <h2 class="fw-bold">1. Información que recopilamos</h2>
    <p>Recopilamos únicamente la información necesaria para operar correctamente nuestros servicios, como:</p>

    <h3 class="fw-bold fs-5 mt-4">1.1. Datos de clientes</h3>
    <ul>
        <li>Nombre y apellidos</li>
        <li>Número de teléfono o WhatsApp</li>
        <li>Correo electrónico (si aplica)</li>
        <li>Dirección (solo cuando se realiza un envío)</li>
        <li>Historial de compras</li>
    </ul>

    <h3 class="fw-bold fs-5 mt-4">1.2. Datos de trabajadores</h3>
    <ul>
        <li>Usuario y contraseña para ingresar al sistema</li>
        <li>Registro de actividades (ej: quien hizo cambios en inventario, ventas, recepción de mercadería)</li>
    </ul>

    <h3 class="fw-bold fs-5 mt-4">1.3. Datos de navegación (en caso de usar web)</h3>
    <ul>
        <li>Cookies básicas</li>
        <li>Dirección IP</li>
        <li>Datos del dispositivo y navegador</li>
    </ul>

    ---

    <h2 class="fw-bold">2. Cómo usamos la información</h2>
    <p>Utilizamos los datos únicamente para:</p>
    <ul>
        <li>Gestionar pedidos y ventas</li>
        <li>Realizar entregas o coordinar recojo</li>
        <li>Llevar control del inventario</li>
        <li>Mejorar la experiencia del usuario</li>
        <li>Registrar qué trabajador realizó cambios en la base de datos</li>
        <li>Emitir boletas o comprobantes</li>
        <li>Responder consultas mediante WhatsApp o formulario web</li>
    </ul>

    ---

    <h2 class="fw-bold">3. Bases del tratamiento</h2>
    <p>Tratamos la información personal bajo los siguientes fundamentos:</p>
    <ul>
        <li>Consentimiento del usuario</li>
        <li>Ejecución de un contrato (ej.: completar una compra)</li>
        <li>Obligaciones legales (facturación, control tributario)</li>
        <li>Interés legítimo (seguridad del sistema, mejora del servicio)</li>
    </ul>

    ---

    <h2 class="fw-bold">4. Compartición de datos</h2>
    <p>Ferretería Toñito no vende ni comparte información personal con terceros, salvo en los siguientes casos:</p>
    <ul>
        <li>Empresas de reparto (solo nombre, dirección y teléfono para entregar pedidos)</li>
        <li>Proveedores de servicios tecnológicos (hosting, base de datos, servidor Apache o Nginx)</li>
        <li>Obligaciones legales ante SUNAT si se emiten comprobantes electrónicos</li>
    </ul>
    <blockquote class="blockquote border-start border-danger border-5 ps-3 py-2 mt-3">
        <p class="mb-0 small text-danger">En ningún caso se comparten contraseñas ni datos sensibles de trabajadores o clientes.</p>
    </blockquote>

    ---

    <h2 class="fw-bold">5. Seguridad de la información</h2>
    <p>Aplicamos medidas razonables de seguridad:</p>
    <ul>
        <li>Contraseñas encriptadas</li>
        <li>Control de acceso por roles (administrador, vendedor, almacén, cajero)</li>
        <li>Uso de conexiones seguras (HTTPS si es web)</li>
        <li>Registros (logs) de usuarios que modifican el inventario</li>
        <li>Base de datos protegida y accesible solo por personal autorizado</li>
    </ul>

    ---

    <h2 class="fw-bold">6. Derechos del usuario</h2>
    <p>Los usuarios pueden solicitar:</p>
    <ul>
        <li>Acceso a su información</li>
        <li>Rectificación de datos incorrectos</li>
        <li>Eliminación de su información (salvo datos de facturación obligatorios por ley)</li>
        <li>Oposición al uso de sus datos</li>
        <li>Revocación del consentimiento</li>
    </ul>
    <p class="small">Las solicitudes pueden hacerse por correo o WhatsApp oficial de la ferretería.</p>

    ---

    <h2 class="fw-bold">7. Conservación de los datos</h2>
    <p>Guardamos la información:</p>
    <ul>
        <li>Datos de compras: 5 años (por temas tributarios)</li>
        <li>Datos de navegación: el mínimo necesario</li>
        <li>Datos del trabajador: mientras tenga relación laboral</li>
    </ul>

    ---

    <h2 class="fw-bold">8. Uso de WhatsApp y redes sociales</h2>
    <p>Si el cliente nos contacta por WhatsApp, autoriza que usemos su número solo para:</p>
    <ul>
        <li>Coordinar compra o entrega</li>
        <li>Enviar información relacionada a su pedido</li>
    </ul>
    <p class="small text-muted">No se envían ofertas masivas sin autorización.</p>

    ---

    <h2 class="fw-bold">9. Cambios en esta Política</h2>
    <p>Podemos actualizar esta Política en cualquier momento. La fecha de última actualización siempre será visible en la parte superior del documento.</p>

    ---

    <h2 class="fw-bold">10. Contacto</h2>
    <p>Para consultas sobre privacidad:</p>
    <address>
        <strong>📍 Ferretería Toñito</strong><br>
        📞 Teléfono/WhatsApp: +51 980555045<br>
        📧 Correo: jhnwarr@gmail.com
    </address>

</div>
@endsection