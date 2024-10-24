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
function validarModelo(){
    var cadena = document.getElementById("Modelo");
    
    if (((cadena <= fechaActual.getFullYear()) && (cadena >= 2000)) || ((cadena <= 99) && (cadena >= 30))){
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
    var cadena = $(obj).val();
    
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

//Valida que la fecha sea válida, respetando los años biciestos y 
//que la fecha sea menor al día actual
function validarFecha (){
    var v_anio = false;
    var v_mes = false;
    var v_dia = false;
    var anio = esPositivo(document.getElementById("anio"));
    var mes = esPositivo(document.getElementById("mes"));
    var dia = esPositivo(document.getElementById("dia"));
    const fechaActual = new Date();

    if (((anio <= fechaActual.getFullYear()) && (anio >= 1910)) ){
        v_anio = true;
        document.getElementById("anio").style.borderColor="green";
    }else{
        document.getElementById("anio").style.borderColor="red";
    }
    if ((mes <= 12 && mes > 0) && !((anio == fechaActual.getFullYear()) && (mes > fechaActual.getMonth()+1))){
        v_mes = true
        document.getElementById("mes").style.borderColor="green";
    }else{
        document.getElementById("mes").style.borderColor="red";
    }
    if(validarDia(dia, mes, anio)){// && !(anio == fechaActual.getFullYear() && (mes >= (fechaActual.getMonth()+1)) && (dia > fechaActual.getDate()-1))){
        v_dia =true;
        document.getElementById("dia").style.borderColor="green";
    }else{
        document.getElementById("dia").style.borderColor="red";
    }
    if (v_anio && v_mes && v_dia){
        return true;
    }else{
        return false;
    }    
}

// valida el dia
function validarDia (dia, mes, anio){
    var meses = [31, 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];

    if(((dia<=meses[mes]) && dia>0)|| ((mes==2) && (dia == 29) && (anio%4 == 0))){
        return true;
    }
    return false;
}
//************************************************************************ */

//Validar la ciudad

function validarCiudad(){
    var obj = document.getElementById("ciudad")
    if (obj.value != ""){
        obj.style.borderColor="green";
        return true;
    }else{
        obj.style.borderColor="red";
        return false;
    }
}

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

