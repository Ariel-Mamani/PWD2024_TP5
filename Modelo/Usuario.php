<?php

/*
Este código define una clase Usuario que hereda de BaseDatos. La clase Usuario representa a un usuario en una base de datos y ofrece métodos para realizar operaciones básicas (CRUD): crear, leer, actualizar y eliminar.
Esta clase permite gestionar usuarios en una base de datos, proporcionando métodos para crear, leer, actualizar y deshabilitar usuarios. 
Los métodos están bien estructurados para manejar cualquier error y mantener un registro en mensajeoperacion en caso de que falle alguna operación.
*/

class Usuario extends BaseDatos{
    private $idusuario;
    private $usnombre;
    private $uspass;
    private $usmail;
    private $usdeshabilitado;
    private $mensajeoperacion;

    public function __construct()
    {
        parent::__construct();
        $this->idusuario = "";
        $this->usnombre = "";
        $this->uspass = "";
        $this->usmail = "";
        $this->mensajeoperacion = "";
    }

    //Este método asigna valores a las propiedades del usuario. Llama a los métodos set correspondientes para actualizar cada propiedad.
    public function setear($idusuario, $usnombre, $uspass, $usmail, $usdes){
        $this->setidusuario($idusuario);
        $this->setusnombre($usnombre);
        $this->setuspass($uspass);
        $this->setusmail($usmail);
        $this->setusdeshabilitado($usdes);
    }
    // Metodo get y set ID
    public function getidusuario(){
        return $this->idusuario;
    }
    public function setidusuario($valor){
        $this->idusuario = $valor;
    }
    
    // Metodo get y set usnombre
    public function getusnombre(){
        return $this->usnombre;
    }
    public function setusnombre($valor){
        $this->usnombre = $valor;
    }
    
    // Metodo get y set uspass
    public function getuspass(){
        return $this->uspass;
    }
    public function setuspass($valor){
        $this->uspass = $valor;
    }
        
    // Metodo get y set usmail
    public function getusmail(){
        return $this->usmail;
    }
    public function setusmail($valor){
        $this->usmail = $valor;
    }
    public function getusdeshabilitado(){
        return $this->usdeshabilitado;
    }
    public function setusdeshabilitado($valor){
        $this->usdeshabilitado = $valor;
    }

    // Metodo get y set MENSAJE ERROR
    public function getmensajeoperacion(){
        return $this->mensajeoperacion;
    }
    public function setmensajeoperacion($valor){
        $this->mensajeoperacion = $valor; 
    }


    /**
     * Busca en la base de datos los datos de un usuario específico por idusuario y los carga en las propiedades del objeto. 
     * Devuelve true si fue exitoso o false en caso de error, almacenando un mensaje de error en mensajeoperacion.
     * @return bool $exito
     */
    public function cargar(){
        //Inicializo variables
        $exito = false;

        //Ejecuta consulta SELECT a la BD
        $sql = "SELECT * FROM usuario WHERE idusuario =" . $this->getidusuario();

        if($this ->Iniciar()){
            $res = $this->Ejecutar($sql);
            if($res > -1){
                $row = $this->Registro();
                $this->setear($row['idusuario'], $row['usnombre'], $row['uspass'], $row['usmail'], $row['usdeshabilitado']);
                $exito = true;
            }else{
                $this->setmensajeoperacion("Usuario->cargar: ".$this->getError());
            }
        }else{
                $this->setmensajeoperacion("Usuario->cargar: ".$this->getError());
        }
        return $exito;
    }


    /**
     * Este método inserta un nuevo usuario en la base de datos con los datos del objeto actual (usnombre, uspass, usmail). 
     * Asigna automáticamente el idusuario generado a la propiedad correspondiente.
     * Devuelve true si fue exitoso, o false en caso de error.
     * @return bool $resp
     */
    public function insertar(){
        //Inicializo variables
        $resp = false;

        //Ejecuta consulta INSERT INTO a la BD
        $sql  =  "INSERT INTO usuario (idusuario, usnombre, uspass, usmail, usdeshabilitado) VALUES (null, '"
        .$this->getusnombre()."', '"
        .$this->getuspass()."', '"
        .$this->getusmail()."', 
        NULL);";

        if ($this->Iniciar()) {
            if($elid = $this->Ejecutar($sql)){
                $this->setidusuario($elid);
                $resp = true;
            }else{
                $this->setmensajeoperacion("Usuario->insertar: ".$this->getError());
            }
        }else{
            $this->setmensajeoperacion("Usuario->insertar: ".$this->getError());
        }
        return $resp;
    }


    /**
     * Summary of modificar
     * Actualiza los datos del usuario en la base de datos, incluyendo usnombre, uspass y usmail, para el idusuario especificado. 
     * Devuelve true si fue exitoso.
     * @return bool $resp
     */
    public function modificar(){
        //Inicializo variables
        $resp = false;

        //Ejecuta consulta UPDATE a la BD
        $sql = "UPDATE usuario SET 
        usnombre = '".$this->getusnombre()."', 
        uspass = '".$this->getuspass()."', 
        usmail = '".$this->getusmail()."',
        usdeshabilitado = null WHERE idusuario = ".$this->getidusuario();

        if ($this->Iniciar()) {
            if($this->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setmensajeoperacion("Usuario->modificar: ".$this->getError());
            }
        }else{
            $this->setmensajeoperacion("Usuario->modificar: ".$this->getError());
        }
        return $resp;
    }


    /**
     * Summary of modificar sin uspass
     * Modifica los datos del usuario excepto la contraseña (uspass).
     * Omite el campo usdeshabilitado.
     * @return bool $resp
     */
    public function modificarSinPass(){
        //Inicializo variables
        $resp = false;

        //Ejecuta consulta UPDATE a la BD
        $sql = "UPDATE usuario SET 
        usnombre = '".$this->getusnombre()."', 
        usmail = '".$this->getusmail()."',
        usdeshabilitado = 'null' WHERE idusuario = ".$this->getidusuario();

        if ($this->Iniciar()) {
            if($this->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setmensajeoperacion("Usuario->modificar: ".$this->getError());
            }
        }else{
            $this->setmensajeoperacion("Usuario->modificar: ".$this->getError());
        }
        return $resp;
    }


    /**
     * Summary of modificar sin uspass
     * Modifica solo la contraseña (uspass).
     * Omite el campo usdeshabilitado.
     * @return bool $resp
     */
    public function modificarPass(){
        //Inicializo variables
        $resp = false;

        //Ejecuta consulta UPDATE a la BD
        $sql = "UPDATE usuario SET 
        uspass = '".$this->getuspass()."',
        usdeshabilitado = 'null' WHERE idusuario = ".$this->getidusuario();

        if ($this->Iniciar()) {
            if($this->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setmensajeoperacion("Usuario->modificar: ".$this->getError());
            }
        }else{
            $this->setmensajeoperacion("Usuario->modificar: ".$this->getError());
        }
        return $resp;
    }


    /**
     * Eliminar, borrado lógico
     * Realiza un "borrado lógico" del usuario, es decir, marca el usuario como deshabilitado sin eliminarlo físicamente. 
     * Para esto, almacena la fecha y hora actuales en el campo usdeshabilitado.
     * @return bool $resp
     */
    public function eliminar(){
        //Inicializo variables
        $resp = false;

        //Ejecuta consulta UPDATE a la BD
        $sql = "UPDATE usuario SET usdeshabilitado = '".date("Y-m-d h:i:sa")."' WHERE idusuario = ".$this->getidusuario();

        if ($this->Iniciar()) {
            if ($this->Ejecutar($sql)) {
                $resp = true;
            }else{
                $this->setmensajeoperacion("Usuario->eliminar: ".$this->getError());
            }
        }else{
            $this->setmensajeoperacion("Usuario->eliminar: ".$this->getError());
        }
        return $resp;
    }


    /**
     * Obtiene una lista de usuarios habilitados de la base de datos. 
     * Si el campo usdeshabilitado tiene un valor de NULL (lo que indica que no está deshabilitado), crea un nuevo objeto Usuario y lo añade a un arreglo que se devuelve al final.
     * @return array $arreglo
     */
    public function listar($parametro=""){
        //Inicializo variables
        $arreglo = array();

        //Ejecuta consulta SELECT a la BD
        $sql = "SELECT * FROM usuario ";

        if ($parametro != "") {
            $sql .= " WHERE " .$parametro;
        }

        if ($this->Iniciar()) {
            $res = $this->Ejecutar($sql);
            if($res > -1){
                if($res > 0){
                    while ($row = $this->Registro()){
                        if ($row['usdeshabilitado'] == NULL ){
                            $obj = new Usuario();
                            $obj->setear($row['idusuario'], $row['usnombre'], $row['uspass'], $row['usmail'], $row['usdeshabilitado'] );
                            array_push($arreglo, $obj);
                        }
                    }
                }
            }else{
                $this->setmensajeoperacion("Usuario->listar: ".$this->getError());
            }
        }
        return $arreglo;
    }
}

?>