<?php

class Contato{
    private $nombre;
    private $apellido;
    private $numerotlf;

    function __construct($nombre,$apellido,$numerotlf){
        $this->nombre=$nombre;
        $this->apellido=$apellido;
        $this->numerotlf=$numerotlf;


    }

    function __destruct(){
        echo "Contacto eliminado: {$this->nombre} <br>";
    }
    
    // van sin $ por que estamos accediendo a una propiedad , no a una variable

    function setNombre($nombre){
        $this->nombre=$nombre;

    }
    function getNombre(){
        return $this->nombre;
    }

    public function setApellido($apellido){
        $this->apellido=$apellido;
    }

    public function getApellido(){
        return $this->apellido;
    }

    public function setNumerotlf($telefono){
        $this->numerotlf=$telefono;
    }

    public function getNumerotlf(){
        return $this->numerotlf;
    }

    public function muestraInformacion(){
        echo 'Muestra informacion Apellido: ' . $this->getApellido() . 
        ' Nombre: ' . $this->getNombre() . 
        ' Número de teléfono: ' . $this->getNumerotlf().'<br>';
    }

}

$contacto1= new Contato("alberot","maneiro",12132);
$contacto2=new Contato("maneiro","garcia",1231);
$contacto3=new Contato("1asa","mar",123);



$contacto1->muestraInformacion();

 
 echo 'sin metodo 1  Apellido :'. $contacto1->getApellido(). ' Nombre :'.$contacto1->getNombre().' telefono:'.$contacto1->getNumerotlf().'<br>';





$contacto2->muestraInformacion();

echo 'sin metodo 2 Apellido :'. $contacto2->getApellido(). ' Nombre :'.$contacto2->getNombre().' telefono:'.$contacto2->getNumerotlf().'<br>';




$contacto3->muestraInformacion();

echo 'sin metodo 3 Apellido :'. $contacto3->getApellido(). ' Nombre :'.$contacto3->getNombre().' telefono:'.$contacto3->getNumerotlf().'<br>';

?>
