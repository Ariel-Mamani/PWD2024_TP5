//***************************************************** */
//Validar campos vacios
/****************************************************** */
// Función para validar si el campo está vacío
function validarCampo(obj) {
    if (obj.value === '') {
        obj.style.backgroundColor = '#FFB0B0';
        obj.style.borderColor = 'red';
        obj.placeholder = 'Campo obligatorio'; // Mensaje dentro del input     obj.style.color = 'red'
        return false; // Prevenir el envío si está vacío
    }else{
        obj.style.backgroundColor = '';
        obj.style.borderColor = 'green';
        obj.placeholder = ''; // Limpiar el mensaje si es válido
        return true; // Permitir el envío si está lleno
    }
}


//***************************************************** */
//Validar nombre y apellido
/****************************************************** */
function validarNombre(obj){
    var  nombreRegex = /^[A-Za-zÀ-ÿ\s]+$/; 
    if (!nombreRegex.test(obj.value)) {
        obj.style.backgroundColor = '#FFB0B0';
        obj.style.borderColor = 'red';
        obj.placeholder = 'Valor invalido, contiene numeros y simbolos'; // Mensaje dentro del input     obj.style.color = 'red'
        return false; // Prevenir el envío si está vacío
    }else{
        obj.style.backgroundColor = '';
        obj.style.borderColor = 'green';
        obj.placeholder = ''; // Limpiar el mensaje si es válido
        return true; // Permitir el envío si está lleno
    }
    
}
