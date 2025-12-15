document.addEventListener('DOMContentLoaded', function() {
    
    // ==========================================================
    // LÓGICA 1: ROTACIÓN DE MENSAJES (CORREGIDA)
    // ==========================================================
    const messageContainer = document.getElementById('shipping-message');
    if (messageContainer) { 
        
        const messages = [
            "Envíos a todo el Perú",
            "Enviamos el mismo día tu producto",
            "Compra 100% Segura"
        ];
        let currentIndex = 0;

        // Inicializamos el primer mensaje
        messageContainer.textContent = messages[0];

        function updateMessage() {
            // 1. Iniciamos SALIDA (Hacia la izquierda)
            messageContainer.classList.add('slide-out');
            
            // Esperamos 500ms (lo que dura la transición CSS)
            setTimeout(() => {
                // 2. Cambiamos el texto
                currentIndex = (currentIndex + 1) % messages.length;
                messageContainer.textContent = messages[currentIndex];
                
                // 3. Quitamos la clase de salida (vuelve invisiblemente al centro/base)
                messageContainer.classList.remove('slide-out');
                
                // 4. Iniciamos ENTRADA (Desde la derecha)
                messageContainer.classList.add('slide-in');

                // 5. Esperamos 500ms a que termine de entrar para limpiar la clase
                // ANTES TENÍAS 100 AQUÍ, ESO CORTABA LA ANIMACIÓN
                setTimeout(() => {
                    messageContainer.classList.remove('slide-in');
                }, 500); 

            }, 500); // Esperamos 500ms para cambiar el texto, no 1000
        }

        // Ejecutar cada 4 segundos
        setInterval(updateMessage, 4000); 
    }

    // ==========================================================
    // LÓGICA 2: CONFIRMACIÓN DE ELIMINACIÓN
    // ==========================================================
    const deleteModal = document.getElementById('confirmDeleteModal');
    if (deleteModal) {
        deleteModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget; 
            const productId = button.getAttribute('data-product-id');
            const productName = button.getAttribute('data-product-name');
            
            const modalBody = deleteModal.querySelector('#productNameModal');
            modalBody.textContent = productName; 

            const deleteForm = document.getElementById('deleteForm');
            const routeUrl = `/dashboard/${productId}`; 
            deleteForm.setAttribute('action', routeUrl); 
        });
    }

    // ==========================================================
    // LÓGICA 3: ALERTA FLOTANTE (SUAVE)
    // ==========================================================
    const successAlertElement = document.getElementById('success-alert');
    if (successAlertElement) {
        setTimeout(function() {
            successAlertElement.style.transition = "opacity 0.5s ease";
            successAlertElement.style.opacity = "0";
            setTimeout(function() {
                successAlertElement.remove();
            }, 500);
        }, 2000);
    }
});