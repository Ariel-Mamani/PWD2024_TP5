<?php
$titulo = "TP 5 - Registrar ";
include_once '../Estructura/header.php';
?>
<div class="divtitulo">
    <h1 class='text-center mb-4 text-white'><?php echo $titulo;?></h1>
</div>
<?php
// El mensaje viene del script verificarLogin.php
// Se mostrara un mensaje ya que el usuario quiso entrar al login sin haberse registrado antes
// Verifica si hay un mensaje en la sesión y lo muestra
if (isset($_SESSION['mensaje']) && $_SESSION['mensaje'] != '') {
    echo "<h1>{$_SESSION['mensaje']}</h1>";
    unset($_SESSION['mensaje']); // Limpia el mensaje después de mostrarlo
} 
?>
<body>

<div class="divform rounded p-4 shadow">
<!-- Formulario de Registro -->
    <form id="form" name="form" action="procesar_registro.php" method="get">
        <!-- Nombre usuario  -->
        <div class="input-group mb-4">
            <span class="input-group-text" id="basic-addon1"><i class="bi bi-person" style="font-size: 22px; color: black;"></i></span>
            <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Usuario" required><br><br>
        </div>
        <!-- Contraseña -->
        <div class="input-group mb-4">
        <span class="input-group-text" id="basic-addon2"><i class="bi bi-lock-fill" style="font-size: 22px;"></i></span>
        <input id="clave" name="clave" type="password" class="form-control" placeholder="Contraseña" required>
        <input type="hidden" name="clave_md5" id="clave_md5">
            <!-- investigar sobre password_hash() -->
        </div>
        <!-- Email -->
        <div class="input-group">
            <span class="input-group-text">usuario123@example.com</span>
            <input type="email" name="email" id="email" class="form-control" required><br><br>
        </div>
        <input type="submit" value="Registrar" onclick="convertirClaveMD5()" class="btn btn-primary mt-5">
        </div>
    </form>
</div>
</body>
<script>
    function convertirClaveMD5(){
        var clave = document.getElementById('clave').value;
        document.getElementById('clave_md5').value = hex_md5(clave);
        //Borro el valor original de la contraseña en el campo clave 
        document.getElementById('clave').value = ''; 
    }
</script>
<!-- Footer -->
<?php include_once '../Estructura/footer.php'; ?>