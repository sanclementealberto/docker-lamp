<?php

class Usuario
{
    private $id;
    private $username;
    private $nombre;
    private $apellidos;
    private $contrasena;
    private $rol;

    public static int $MIN_LENGHT=3;

    // los parametros opcioneles debe ir despues de los obligatorios el id null por que se genera en la BD
    public function __construct($id=null,$username=null,$nombre=null,$apellidos=null,$rol=null,$contrasena='')
    {
        $this->id=$id;
        $this->username=$username;
        $this->nombre=$nombre;
        $this->apellidos=$apellidos;
        $this->contrasena=$contrasena;
        $this->rol=$rol;
    }

    

    public function getIdUsuario(){
        return $this->id;
    }
    public function setIdUsuario($id){
        $this->id=$id;
    }

    public function getUsername(){
        return $this->username;
    }

    public function setUsername($username){
        $this->username=$username;
    }

    public function getNombre(){
        return $this->nombre;
    }

    public function setNombre($nombre){
        $this->nombre=$nombre;
    }

    public function getApellidos(){
        return $this->apellidos;
    }

    public function setApellidos($apellidos){
        $this->apellidos=$apellidos;
    }

    public function getContrasena(){
       return  $this->contrasena;
    }

    public function setContrasena($contrasena){
        $this->contrasena=$contrasena;
    }

    public function getRol(){
        return $this->rol;
    }

    public function setRol($rol){
        $this->rol=$rol;
    }
    public function __destruct()
    {

    }

    public  static function validar()
    {

    }

    


}

?>