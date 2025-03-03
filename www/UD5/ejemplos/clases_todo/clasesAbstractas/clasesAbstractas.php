<?php

// Clase base abstracta 
abstract class Car {
    public $name;
    public function __construct($name) {
      $this->name = $name;
    }
  
    //Método abstracto que debe definirse en todas las clases secundarias y deben devolver una cadena
    abstract public function intro() : string;
  }
  
  // Clases hijas
  class Audi extends Car {
    //Método heredado implementado 
    public function intro() : string {
      return "Choose German quality! I'm an $this->name!";
    }
  }
  
  class Volvo extends Car {
    //Método heredado implementado 
    public function intro() : string {
      return "Proud to be Swedish! I'm a $this->name!";
    }
  }
  
  //Creación de objetos 
  $audi = new audi("Audi");
  echo $audi->intro();
  echo "<br>";
  
  $volvo = new volvo("Volvo");
  echo $volvo->intro();
  echo "<br>";