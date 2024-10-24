
// --------------------------------- FUNCIONES ------------------------------------
//Función para validar campos vacíos
function validarCampoVacio(campo){
    return campo.trim() !== "";
}

//Funcion que valida solo números enteros positivos
function validarNumeros(campo){
    var regexNumeros = /^[0-9]+$/;
    return regexNumeros.test(campo);
}

//Funcion que valida solo números, pueden ser negativos y positivos
function validarNumerosNP(campo){
    var regexNumeros = /^-?\d+$/;
    return regexNumeros.test(campo);
}
//Función para validar nombre
function validarNombre(campo){
    var regexNombre = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ]+$/;
    return regexNombre.test(campo);
}

// Función para validar email
function validarEmail(campo){
    var regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return regex.test(campo);
}

// Función para validar contraseñas (mínimo 8 caracteres, al menos una letra y un número)
function validarContrasena(campo){
    var regexContra = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/; 
    return regexContra.test(campo);
}
// Funcion valida direccion
function validarDireccion(campo){
    var regexDireccion = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9\s]+$/;
    return regexDireccion.test(campo);
}

//-------------------------------- VALIDA FORMULARIOS  ------------------------------------------

document.addEventListener("DOMContentLoaded", function(){
    $("#miFormulario").on("submit", function(event){
        var formularioValido = true; // Inicialmente asumimos que el formulario es válido

        // Recorrer todos los inputs del formulario
        $("#miFormulario input").each(function(){
            var campo = $(this); // input
            var valorCampo = campo.val(); // valor del input
            var campoId = campo.attr('id'); // id del input

            // Validación según el tipo de campo
            // Valida campos que solo contengan letras, no permite numeros ni signos
            if(campoId === "nombre" || campoId === "apellido" || campoId === "nacionalidad"){
                if(!validarCampoVacio(valorCampo) || !validarNombre(valorCampo)){
                    campo.css({
                        "border-color": "red",
                        "background-color": "#FFB0B0"
                    });
                    $('.mensaje-error').text('Por favor, complete el campo con un valor válido. Solo letras.').css({"color": "red"});
                    formularioValido = false;
                } else {
                    campo.css({
                        "border-color": "green",
                        "background-color": ""
                    });
                    $('.mensaje-error').text('');
                }
            }else if(campoId === "numero" || campoId === "edad" || campoId === "año" || campoId === "lunes" || campoId === "martes" || campoId === "miercoles" || campoId === "jueves" || campoId === "viernes"){
                if(!validarCampoVacio(valorCampo) || !validarNumeros(valorCampo)){
                    campo.css({
                        "border-color": "red",
                        "background-color": "#FFB0B0"
                    });
                    $('.error-numero').text('Por favor, ingrese un número válido').css({"color": "red"});
                    formularioValido = false;
                }else{
                    campo.css({
                        "border-color": "green",
                        "background-color": ""
                    });
                    $('.error-numero').text('');
                }
            // Valida campos numeros, pueden ser negativos y positivos
            }else if(campoId === "numeroNP"){
                if(!validarCampoVacio(valorCampo) || !validarNumerosNP(valorCampo)){
                    campo.css({
                        "border-color": "red",
                        "background-color": "#FFB0B0"
                    });
                    $('.error-numero').text('Por favor, ingrese un número válido').css({"color": "red"});
                    formularioValido = false;
                }else{
                    campo.css({
                        "border-color": "green",
                        "background-color": ""
                    });
                    $('.error-numero').text('');
                }
            // Valida campos emails
            }else if(campoId === "email"){
                if(!validarCampoVacio(valorCampo) || !validarEmail(valorCampo)){
                    campo.css({
                        "border-color": "red",
                        "background-color": "#FFB0B0"
                    });
                    $('.error-email').text('Por favor, ingrese un email válido.').css({"color": "red"});
                    formularioValido = false;
                }else{
                    campo.css({
                        "border-color": "",
                        "background-color": ""
                    });
                    $('.error-email').text('');
                }
            // Valida campos de contraseñas
            }else if(campoId === "contrasena"){
                if(!validarCampoVacio(valorCampo) || !validarContrasena(valorCampo)){
                    campo.css({
                        "border-color": "red",
                        "background-color": "#FFB0B0"
                    });
                    $('.error-contraseña').text('Por favor, ingrese una contraseña válida.').css({"color": "red"});
                    formularioValido = false;
                }else{
                    campo.css({
                        "border-color": "",
                        "background-color": ""
                    });
                    $('.error-contraseña').text('');
                }
            }else if(campoId === "direccion"){
                if(!validarCampoVacio(valorCampo) || !validarDireccion(valorCampo)){
                    campo.css({
                        "border-color": "red",
                        "background-color": "#FFB0B0"
                    });
                    $('.error-direccion').text('Campo obligatorio, ingrese una direccion').css({"color": "red"});
                    formularioValido = false;
                } else {
                    campo.css({
                        "border-color": "green",
                        "background-color": ""
                    });
                    $('.error-direccion').text('');
                }
            }            
        });

        // Validar que al menos un radio esté seleccionado solo si existen radios en el formulario
        if($("input[name='estudio']").length > 0){
            var radioSeleccionado = $("input[name='estudio']:checked").length;
            if(radioSeleccionado === 0){
                $('.radio-group').css("border", "2px solid red");
                $('.error-radio').text('Debe seleccionar una opción').css({"color": "red"});
                formularioValido = false;
            }else{
                $('.radio-group').css("border", ""); // Limpiar el borde si está seleccionado
                $('.error-radio').text('')
            }
        }

        //Validar que se haya seleccionado una opción en el campo "sexo" solo si existe el select
        if($("#sexo").length > 0){
            var valorSelect = $("#sexo").val();
            if(valorSelect === ""){
                $('#sexo').css("border-color", "red");
                $('.error-select').text('Debe seleccionar una opción de sexo').css({"color": "red"});
                formularioValido = false;
            }else{
                $('#sexo').css("border-color", ""); // Limpiar el borde si se seleccionó una opción válida
                $('.error-select').text('')
            }
        }
        //Valida checkbox DEPORTES
        if($("input[name='deportes']").length > 0){
            var boxSeleccionado = $("input[name='deportes']:checked").length;
            if (boxSeleccionado === 0) {
                $('.radio-group').css("border", "2px solid red");
                $('.error-box').text('Debe seleccionar una opción').css({"color": "red"});
                formularioValido = false;
            }else{
                $('.radio-group').css("border", ""); // Limpiar el borde si está seleccionado
                $('.error-box').text('')
            }
        }
        
        if($("#operacion").length > 0){
            var valorSelect = $("#operacion").val();
            if(valorSelect === ""){
                $('#operacion').css("border-color", "red");
                $('.error-operacion').text('Debe seleccionar una operacion').css({"color": "red"});
                formularioValido = false;
            }else{
                $('#operacion').css("border-color", ""); // Limpiar el borde si se seleccionó una opción válida
                $('.error-operacion').text('')
            }
        }
        // Si algún campo no es válido, evitamos el envío del formulario
        if(!formularioValido){
            event.preventDefault(); // Detenemos el envío del formulario si no es válido
        }
    });
});


