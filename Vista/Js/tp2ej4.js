(function () {
    'use strict'
    
    // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
    var forms = document.querySelectorAll('.needs-validation')

    // Bucle sobre ellos y evitar el envío
    Array.prototype.slice.call(forms)
        .forEach(function (form){
            form.addEventListener('submit', function (event){
                var anioInput = form.querySelector('#anio');
                
                // Validación personalizada del año
                /*
                if(parseInt(anioInput.value) > 2024){
                    anioInput.setCustomValidity(' ');
                }else{
                    anioInput.setCustomValidity(''); // Restablecer la validez si el año es válido
                }*/
                
                if(!form.checkValidity()){
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false)
        })
})();

function validarAnio(obj){
    var fechaActual = new Date();
    var anio = parseInt(obj.value);
    if((anio <= fechaActual.getFullYear()) && (anio >= 1900) ){
        obj.setCustomValidity('');  // Restablecer la validez si el año es válido
    }else{
        obj.setCustomValidity(' '); 
    }
}