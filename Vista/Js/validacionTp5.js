// Ejemplo de JavaScript inicial para deshabilitar el envío de formularios si hay campos no válidos
(function () {
    'use strict'
    // Obtener todos los formularios a los que queremos aplicar estilos de validación de Bootstrap personalizados
    var forms = document.querySelectorAll('.needs-validation')
    // Bucle sobre ellos y evitar el envío
    Array.prototype.slice.call(forms)
    .forEach(function (form) {
        form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }
        form.classList.add('was-validated')
        }, false)
    })
})()

//***************************************************** */
//Validar email
/****************************************************** */
function validarEmail(obj){

    if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($(obj).val())){
        obj.setCustomValidity('');  // Restablecer la validez 
        return true;
    }else{
        obj.setCustomValidity(' '); 
        return false;
    }  
}

//***************************************************** */
//Validar el Usuario
/****************************************************** */
function validarUsuario(obj){
    // Expresión regular para permitir solo letras mayúsculas y minúsculas
    var soloLetras = /^[A-Za-z]+$/;
    // Validar el valor del campo usuario
    if(soloLetras.test(obj.value)){
        obj.setCustomValidity(''); 
        return true;
    }else{
        obj.setCustomValidity('El nombre de usuario solo debe contener letras sin números ni símbolos.'); // Mensaje de error
        return false;
    }
}
