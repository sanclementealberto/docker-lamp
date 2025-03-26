<?php
//var_dump para depuarar y visulizar una variable y su informacion
class Criatura{

    private int $id;
    private string $poder;
    private string $tipo;
    private string $nombre;
    private $fichero;



    public function __construct(string $poder='',string $tipo='',string $nombre='',$fichero=null)
    {
        $this->id=0;
        $this->poder=$poder;
        $this->tipo=$tipo;
        $this->nombre=$nombre;
        $this->fichero=$fichero;


    }
    public function getImage()
    {
        return $this->fichero;
    }

    public function setImage($fichero)
    {
        $this->fichero=$fichero;
    }

    public function getId(){
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id=$id;
    }

    public function getPoder()
    {
        return $this->poder;
    }

    public function setPoder(string $poder)
    {
        $this->poder=$poder;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo)
    {
        $this->tipo=$tipo;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre)
    {
        $this->nombre=$nombre;
    }
    //poder ,tipo e nombre

    public static function validate(array $data)
    {
        $errores=[];
        if(empty($data['nombre']))
        {
            $errores['poder']=' el poder es obligatorio';
        }
        elseif(strlen($data['poder'])<5){
            $errores['poder']='el poder debe tener al menos 5 caracteres';
        }

        if(empty($data['tipo'])){
            $errores['tipo']='el tipo es obligatorio';
        }
        elseif(strlen($data['tipo'])<5)
        {
            $errores['tipo']=' el tipo debe tener al menos 5 caracteres';
        }

        if(empty($data['nombre']))
        {
            $errores['nombre']='el nombre es obligatorio';
        }
        elseif(strlen($data['nombre'])<5)
        {
            $errores['nombre']='el nombre debe contener al menos 5 caracteres';
        }

        return $errores;
    }
}


