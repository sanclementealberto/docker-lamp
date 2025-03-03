<?php

class Alien{
    private $nomeAlien;
    private  static $contador=0;

    function __construct($nombreAlien){
        $this->nomeAlien=$nombreAlien;
        self::$contador++;
        
    }


    public static function getNumberOfAliens(){
        return self::$contador;
    }



}


$alien1= new Alien("pepe");
$alien2= new Alien("pepes");
$alien3= new Alien("pepea");
$alien4= new Alien("pepea");

$alien5= new Alien("pepea");
$alien6= new Alien("pepea");
$alien7= new Alien("pepea");


// invocar metodos estaticos clase::metodo() para invocar metodos estaticos
echo Alien::getNumberOfAliens();




?>