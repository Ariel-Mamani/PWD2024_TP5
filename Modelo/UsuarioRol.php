<?php

/*
Este código define una clase UsuarioRol que también extiende de BaseDatos. Esta clase representa la relación entre un usuario y un rol en una base de datos, permitiendo vincular usuarios con roles específicos y gestionar estas asociaciones.

La clase UsuarioRol gestiona la relación entre usuarios y roles en una base de datos. Permite:

Buscar relaciones usuario-rol.
Insertar nuevas relaciones.
Modificar el rol asignado a un usuario.
Eliminar una relación específica.
Listar todas las relaciones usuario-rol que cumplen con una condición.
Estos métodos utilizan las instancias de Usuario y Rol para acceder a los datos de cada entidad y manejan errores mediante mensajeoperacion.
*/

class UsuarioRol extends BaseDatos{
    private $objUsuario; // Objeto de la clase Usuario
    private $objRol;     // Objeto de la clase Rol
    private $mensajeoperacion;

    public function __construct(){
        parent::__construct();
        $this->objUsuario = new Usuario();
        $this->objRol = new Rol();
        $this->mensajeoperacion = "";
    }

    //Asigna un usuario y un rol a la relación, utilizando los métodos setUsuario y setRol.
    public function setear($objUsuario, $objRol){
        $this->setUsuario($objUsuario);
        $this->setRol($objRol);
    }

    // Métodos Get y Set para el objeto Usuario
    public function getUsuario(){
        return $this->objUsuario;
    }

    public function setUsuario($objUsuario){
        $this->objUsuario = $objUsuario;
    }

    // Métodos Get y Set para el objeto Rol
    public function getRol(){
        return $this->objRol;
    }

    public function setRol($objRol){
        $this->objRol = $objRol;
    }

    // Métodos Get y Set para mensajeoperacion
    public function getMensajeoperacion(){
        return $this->mensajeoperacion;
    }

    public function setMensajeoperacion($valor){
        $this->mensajeoperacion = $valor;
    }


    /**
     * Método para buscar una relación usuario-rol
     * Busca en la base de datos una relación usuario-rol específica, utilizando el idusuario y idrol del objeto Usuario y Rol asociados. 
     * Si encuentra una coincidencia, carga los datos del usuario y el rol y actualiza el objeto UsuarioRol.
     * @return bool $exito
     */
    public function cargar(){
        $exito = false;
        $sql = "SELECT * FROM usuariorol WHERE 
        idusuario = ".$this->getUsuario()->getidusuario()." AND 
        idrol = ".$this->getRol()->getidrol();
        if($this->Iniciar()){
            $res = $this->Ejecutar($sql);
            if($res > -1){
                $row = $this->Registro();
                $objUsuario = new Usuario();
                $objUsuario->setidusuario($row['idusuario']);
                $objUsuario->cargar();
                $objRol = new Rol();
                $objRol->setidrol($row['idrol']);
                $objRol->cargar(); 
                $this->setear($objUsuario, $objRol);
                $exito = true;             
            }else{
                $this->setMensajeoperacion("UsuarioRol->buscar: " . $this->getError());
            }
        }else{
            $this->setMensajeoperacion("UsuarioRol->buscar: " . $this->getError());
        }
        return $exito;
    }


    /**
     * Método para insertar una nueva relación usuario-rol
     * Inserta una nueva relación usuario-rol en la tabla usuariorol, utilizando los IDs del usuario y el rol. 
     * Devuelve true si la inserción fue exitosa o false en caso de error.
     * @return bool $false
     */
    public function insertar(){
        $resp = false;
        $sql = "INSERT INTO usuariorol(idusuario, idrol) VALUES(" 
        .$this->getUsuario()->getidusuario().", " 
        .$this->getRol()->getidrol().")";
        if($this->Iniciar()) {
            if($this->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setMensajeoperacion("UsuarioRol->insertar: " . $this->getError());
            }
        }else{
            $this->setMensajeoperacion("UsuarioRol->insertar: " . $this->getError());
        }
        return $resp;
    }


    /**
     * Summary of modificar
     * Este método actualiza la relación para un idusuario dado, asignándole un nuevo idrol. Toma el nuevo rol como parámetro
     * Devuelve true si la actualización fue exitosa.
     * @param mixed $nuevo
     * @return bool $resp
     */
    public function modificar($nuevo){
        $resp = false;
        $sql = "UPDATE usuariorol SET 
        idrol = ".$nuevo." 
        WHERE idusuario = ".$this->getUsuario()->getidusuario()." and idrol = ".$this->getRol()->getidrol();
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
     * Método para eliminar una relación usuario-rol
     * Elimina una relación usuario-rol específica de la tabla usuariorol, basada en el idusuario y idrol del objeto actual. 
     * Devuelve true si la eliminación fue exitosa.
     * @return bool $resp
     */
    public function eliminar(){
        $resp = false;
        $sql = "DELETE FROM usuariorol WHERE idusuario = " 
        . $this->getUsuario()->getidusuario() . " AND idrol = " 
        . $this->getRol()->getidrol();
        if($this->Iniciar()){
            if($this->Ejecutar($sql)){
                $resp = true;
            }else{
                $this->setMensajeoperacion("UsuarioRol->eliminar: " . $this->getError());
            }
        }else{
            $this->setMensajeoperacion("UsuarioRol->eliminar: " . $this->getError());
        }
        return $resp;
    }


    /**
     * Método para listar todas las relaciones usuario-rol
     * Este método devuelve un arreglo de todas las relaciones usuario-rol que cumplen con un parámetro opcional ($parametro). 
     * Para cada registro encontrado en la tabla usuariorol, crea un objeto UsuarioRol con un Usuario y un Rol y lo añade al arreglo de resultados.
     * @return array $arreglo
     */
    public function listar($parametro = ""){
        $arreglo = array();
        $sql = "SELECT * FROM usuariorol ";

        if($parametro != ""){
            $sql .= " WHERE " . $parametro;
        }

        if($this->Iniciar()){
            if ($this->Ejecutar($sql)){
                while ($row = $this->Registro()){
                    $objUsuario = new Usuario();
                    $objUsuario->setidusuario($row['idusuario']);
                    $objUsuario->cargar();
                    $objRol = new Rol();
                    $objRol->setidrol($row['idrol']);
                    $objRol->cargar();
                    $obj = new UsuarioRol();
                    $obj->setear($objUsuario, $objRol);
                    array_push($arreglo, $obj);
                }
            }else{
                self::setMensajeoperacion("UsuarioRol->listar: " . $this->getError());
            }
        }
        return $arreglo;
    }
}
?>
