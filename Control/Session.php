<?php
class Session {
    private $usuario;
    private $psw;
    private $rol;

    public function __construct(){
        session_start();
        $this->usuario = "";
        $this->psw = "";
        $this->rol = "";
    }
    






}
?>