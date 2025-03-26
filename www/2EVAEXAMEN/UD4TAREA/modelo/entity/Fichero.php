<?php

require_once __DIR__ .'/Tarea.php';


class Fichero
{

    private int $id;
    private string $nombre;
    private string $file;

    private string $descripcion;
    private Tarea $tarea;

    //formato MIME
    public const FORMATOS=['application/pdf','image/jpeg','image/png'];

    public const MAX_SIZE= 10455760;


    public function __construct(string $nombre, string $file,string $descripcion,Tarea $tarea=null)
    {
        $this->id=0;
        $this->nombre=$nombre;
        $this->file=$file;
        $this->descripcion=$descripcion;
        if($tarea)$this->tarea=$tarea;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id=$id;
    }

    public function getNombre()
    {
        $this->id;
    }

    public function setNombre(string $nombre)
    {
        $this->nombre=$nombre;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile(string $file)
    {
        $this->file=$file;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion)
    {
        $this->descripcion=$descripcion;
    }

    public function getTarea()
    {
        return $this->tarea;
    }

    public function setTarea(Tarea $tarea)
    {
        $this->tarea=$tarea;
    }


    public static function validate(array $data)
    {
        $errores=[];

        if(empty($data['nombre']))
        {
            $errores['nombre']='EL nombre es obligatorio';
        }
        elseif(strlen($data['nombre'])<=3)
        {
            $errores['nombre']='El nombre debe tener mas de 3 caracteres';
        }

        if(empty($data['file']))
        {
            $errores['file']='El archivo es obligatorio';
        }
        elseif(!in_array($data['file']['type'],self::FORMATOS)){
            $errores['file']='El formato del archivo no es valido . Solo se aceptan PDF,DOC,DOCX,JPG Y PNG';
        }
        elseif($data['file']['file']> self::MAX_SIZE)
        {
            $errores['file']='El archivo excede el tamaño maximo permitido';
        }

        if(empty($data['descripcion']))
        {
            $errores['descripcion']='La descripcion es obligatoria';

        }
        if(empty($data['tarea']))
        {
            $errores['tarea']='La tarea es obligatoria';
        }
        return $errores;

    }


}
