// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
        if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
        }

        form.classList.add('was-validated')
        }, false)
    })
    })()
    //***************************************************** */
    //Validar nombre y apellido
    /****************************************************** */
    function validarNombre(obj){
        if($(obj).val() != "" && validarSoloLetra($(obj).val())){
            obj.setCustomValidity('');  // Restablecer la validez 
            return true;
        }else{
            obj.setCustomValidity(' '); 
            return false;
        } 
    }
    //***************************************************** */
    //Validar contraseña, contraeña no mayor a 8 caracteres y contenga  una letra
    /****************************************************** */
    function validarClave(obj){
        var cadena = $(obj).val();
        // Expresión regular para verificar si la contraseña contiene al menos una letra y un número, y tiene 8 o más caracteres
        var contieneLetraYNumero = /^(?=[^A-Za-z]*[A-Za-z][^A-Za-z]*$)(?=\d*\d\d\d\d\d\d\d$)[A-Za-z\d]{8}$/;
    
        // Verificar si la contraseña no está vacía, si contiene letras, números y si tiene al menos 8 caracteres
        if (cadena === "" || !contieneLetraYNumero.test(cadena)) {
            obj.setCustomValidity('');  // Restablecer la validez si es correcta
            return true;
        } else {
            obj.setCustomValidity('La contraseña debe tener al menos una letra, un número y un mínimo de 8 caracteres.');
            return false;
        }
    }
    
