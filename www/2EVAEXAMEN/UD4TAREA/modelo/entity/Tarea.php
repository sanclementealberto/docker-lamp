<?php


require_once __DIR__ . '/Estado.php';
require_once __DIR__ . '/Usuario.php';

class Tarea
{

    private int $id;

    private string $titulo;

    private string $descripcion;

    private Estado $estado;

    private Usuario $usuario;


    public function __construct(string $titulo,string $descripcion,Usuario $usuario,Estado $estado=Estado::PENDIENTE)
    {
        $this->id=0;
        $this->titulo=$titulo;
        $this->descripcion=$descripcion;
        $this->estado=$estado;
        $this->usuario=$usuario;
    }


    public function getId()
    {
        return $this->id;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function getDescription()
    {
        return $this->descripcion;
    }
    
    public function getEstado()
    {
        return $this->estado;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setId(int $id)
    {
        $this->id=$id;
    }

    public function setTitulo(string $titulo)
    {
        $this->titulo=$titulo;
    }

    public function setDescripcion(string $descripcion)
    {
        $this->descripcion=$descripcion;
    }

    public function setEstado(Estado $estado)
    {
        $this->estado=$estado;
    }

    public function setUsuario(Usuario $usuario)
    {
        $this->usuario=$usuario;
    }

    public static function validate(array $data)
    {
        $errors=[];

        if(empty($data['titulo']))
        {
            $errors['titulo']='el tiulo no puede estar vacio';
        }
        elseif(strlen($data['titulo'])<3)
        {
            $errors['titulo']=' el titulo debe tener al menos 3 caracteres';
        }

        $valores=array_column(Estado::cases(),'value');
        if(!isset($data['estado']) || !in_array($data['estado'],$valores)){
            $errors['rol']='El estado no es valido';
        }
        
        if(empty($data['usuario']))
        {
            $errors['usuario']='el usuario no puede estar vacio';
        }
        return $errors;

    }
}