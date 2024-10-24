document.addEventListener('DOMContentLoaded', function() {
    (function(){
        'use strict'
        
        var form = document.getElementById('form');
        
        form.addEventListener('submit', function(event){
            var archivoInput = document.getElementById('archivo');
            
            // Validación manual
            if (archivoInput.files.length === 0) {
                event.preventDefault();
                event.stopPropagation();
                archivoInput.setCustomValidity('Por favor, selecciona un archivo.');
            } else {
                archivoInput.setCustomValidity(''); // Resetear el mensaje de error
            }

            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add('was-validated');
        }, false);
    })();
});
