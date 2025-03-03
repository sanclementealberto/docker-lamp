<?php 
class Participante{
    private $nom;
    private $eda;

    function __construct($nombre,$edad){
        $this->nom=$nombre;
        $this->eda=$edad;
    }

    function __destruct(){
        echo "objetos destruidos ";
    }


    function getNom(){
        return $this->nom;
    }


    function setNom($nombre){
        $this->nom=$nombre;
    }

    function getEda(){
        return $this->eda;
    }

    function setEda($edad){
        $this->eda=$edad;
    }

}


class Jugador extends Participante{

    private $cargo;
    function __construct($nombre,$edad,$cargo){
        parent::__construct($nombre,$edad);
        $this->cargo=$cargo;

    }
    
    function getCargo(){
       return $this->cargo;
    }
    function setCargo($cargo){
        $this->cargo=$cargo;
    }


}


class Arbitro extends Participante{
    private $añosArbitraje;

    function __construct($nombre,$edad,$añosArbitraje){
        parent::__construct($nombre,$edad);
        $this->añosArbitraje=$añosArbitraje;
    }

    function getAñosArbitraje(){
        return $this->añosArbitraje;
    }

    function setAñosArbitraje($añosArbitraje){
        $this->añosArbitraje->$añosArbitraje;
    }

}


$arbitro1= new Arbitro("manolo",32,5);
echo "nombre :". $arbitro1->getNom()." edad :". $arbitro1->getEda()." años:".$arbitro1->getAñosArbitraje()."<br>";

$arbitro2=new Arbitro("alberot",35,10);

echo "nombre :". $arbitro2->getNom()." edad :". $arbitro2->getEda()." años:".$arbitro2->getAñosArbitraje()."<br>";


$arbitro1->setNom("benito");

echo " cambio nombre nombre :". $arbitro1->getNom()." edad :". $arbitro1->getEda()." años:".$arbitro1->getAñosArbitraje()."<br>";



$jugador1=new Jugador("alberto",25,"delantero");

echo "nombre :". $jugador1->getNom()." edad :". $jugador1->getEda()." cargo:".$jugador1->getCargo()."<br>";


$jugador1->setNom("MARIA");

echo "cambio jugador nombre :". $jugador1->getNom()." edad :". $jugador1->getEda()." cargo:".$jugador1->getCargo()."<br>";


$jugador2=new Jugador("javier",25,"defensa");

echo "nombre :". $jugador2->getNom()." edad :". $jugador2->getEda()." cargo:".$jugador2->getCargo()."<br>";






?>