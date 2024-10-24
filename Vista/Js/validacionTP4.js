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


//***************************************************** */
//Validar nombre y apellido
/****************************************************** */
function validarNombre(obj){

    if ($(obj).val() != "" && validarSoloLetra($(obj).val())){
        obj.setCustomValidity('');  // Restablecer la validez 
        return true;
    }else{
        obj.setCustomValidity(' '); 
        return false;
    } 
}

//***************************************************** */

//***************************************************** */
//Validar nombre de usuario
/****************************************************** */
function validarUsuario(obj){

    if ($(obj).val() != "" && validarLetraNum($(obj).val())){
        obj.setCustomValidity('');  // Restablecer la validez 
        return true;
    }else{
        obj.setCustomValidity(' '); 
        return false;
    }
}
//***************************************************** */

//***************************************************** */
//Validar contraseña
/****************************************************** */
function validarContrasenia(obj){
    var cadena = $(obj).val();

    if (cadena != "" && validarLetraNum(cadena) && cadena.length > 8){
        obj.setCustomValidity('');  // Restablecer la validez 
        return true;
    }else{
        obj.setCustomValidity(' '); 
        return false;
    } 
}
//***************************************************** */

//***************************************************** */
//Validar Modelo AA y AAAA menor al año actual
/****************************************************** */
function validarModelo(obj){
    const fechaActual = new Date();
    var cadena = parseInt(obj.value);
    
    if (((cadena <= fechaActual.getFullYear()) && (cadena >= 1900)) || ((cadena <= 99) && (cadena >= 30))){
        obj.setCustomValidity('');  // Restablecer la validez 
        return true;
    }else{
        obj.setCustomValidity(' '); 
        return false;
    }
}

//***************************************************** */
//Validar numero de dni entre 1M y 99M 
/****************************************************** */
function validarDni(obj){

    var cadena = $(obj).val();
    
    if (cadena != "" && esNumero(cadena) && cadena.length > 6 && cadena<99999999 && cadena>1000000){ 
        obj.setCustomValidity('');  // Restablecer la validez 
        return true;
    }else{
        obj.setCustomValidity(' '); 
        return false;
    }
}
//***************************************************** */
//Validar numero telefono minimo de 8 digitos
/****************************************************** */
function validarTelefono(obj){
    var pre = obj.value.slice(0, 3);
    var fijo = obj.value.slice(4 );
    
    if (cadena != "" && esNumero(cadena) && cadena.length > 8 && cadena.length<15){ 
        obj.setCustomValidity('');  // Restablecer la validez 
        return true;
    }else{
        obj.setCustomValidity(' '); 
        return false;
    }
}

//***************************************************** */
//Validar numero
/****************************************************** */
function esNumero(cadena){
    var i = 0; 
    while (i < cadena.length){
        if (!(/[0-9]/.test(cadena.at(i)))) {return false;}
        i++;
    }
    return true;
}
//***************************************************** */
//Validar fechas
/****************************************************** */
function esPositivo(obj){
    var valor = parseInt(obj.value);
    var cadena = obj.value;
    var i = 0; 
	
    while (i < cadena.length){
        if (!(/[0-9]/.test(cadena.at(i)))) {return 0;}
        i++;
    }
    return valor;
}



//************************************************************************ */


//Validar cadena por formato
function validarSoloLetra(cadena){
    var i = 0; 
	
    while (i < cadena.length){
        if (!(/[A-z ñÑ'áéíóúüÁÉÍÓÚ]/.test(cadena.at(i)))) {return false;}
        i++;
    }
    return true;
}
//Validar cadena por formato
function validarLetraNum(cadena){
    var i = 0; 
	
    while (i < cadena.length){
        if (!(/[A-z 0-9 ñÑ'áéíóúüÁÉÍÓÚ]/.test(cadena.at(i)))) {return false;}
        i++;
    }
    return true;
}
//^(?!\s*$)[1-9]{1,5}\d*-[1-9]{5,9}\d*$