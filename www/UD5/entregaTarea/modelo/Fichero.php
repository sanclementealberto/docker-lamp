<?php

class Fichero
{
    private $id;

    private $nombre;

    private $file;

    private $descripcion;

    private $tarea;

    public const FORMATOS = ['image/jpeg', 'image/png', 'application/pdf'];
    public const MAX_SIZE = 10485760;

    public function __construct(?Tarea $tarea = null, $id = null, $nombre = null, $file = null, $descripcion = null)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->file = $file;
        $this->descripcion = $descripcion;
        $this->tarea = $tarea;
    }


    public function getIdFichero()
    {
        return $this->id;
    }

    public function setIdFichero($id)
    {
        $this->id = $id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getFile()
    {
        return $this->file;
    }

    public function setFile($file)
    {
        $this->file > $file;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }


    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getTarea()
    {
        return $this->tarea;
    }

    public function setTarea(?Tarea $tarea)
    {
        $this->tarea = $tarea;
    }

    public static function validarFichero($nombre, $formatos, $descripcion, $tamaño)
    {
        $errores = [];
        //validar nombre,file extension y descripcion
        if (empty($nombre)) {
            $errores['nombre'] = "EL nombre es obligatorio";
        } elseif (strlen($nombre) < 6) {
            $errores['nombre'] = "el nombre debe tener 5 caracteres al menos";
        }


        //validar file
        if (empty($formatos)) {
            $errores['file'] = "el file debe ser obligatorio";
        } else {
            if (is_string($formatos) && !in_array($formatos, Fichero::FORMATOS)) {
                $errores['file'] = "El formato del archivo no es válido. Los formatos permitidos son: " . implode(", ", Fichero::FORMATOS);
            }
        }

        if ($tamaño > Fichero::MAX_SIZE) {
            $errores['file'] = "Tamaño máximo permitido de " . (Fichero::MAX_SIZE / 1024 / 1024) . " MB.";
        }

        if (empty($descripcion)) {
            $errores['descripcion'] = "EL descripcion es obligatorio";
        } elseif (strlen($descripcion) < 6) {
            $errores['descripcion'] = "la descripcion debe tener 5 caracteres al menos";
        }

        return $errores;
    }

}



?>