<?php 
//final se usa para evitar la herencia de las clases o metodos
//final class Fruita
//final public function intro(){}
class Fruita {

    public $name;
    public $color;
  
    public function __construct($name, $color) {
      $this->name = $name;
      $this->color = $color;
    }
    //protected solo lo puedo usar dentro de la clase asi que lo sobreescribo
    //private de ninguna manera solo de dentro de la clase
    protected  function intro() {
      echo "The fruit is {$this->name} and the color is {$this->color}.";
    }
  }
  
class Strawberry extends Fruita{
    public $weight;
    public function __construct($name, $color, $weight) {
        $this->name = $name;
        $this->color = $color;
        $this->weight = $weight;
      }
    public function message(){
        echo "Am I a fruit or a berry";
        //asi tambien podria para invocar un protected.
        $this->intro();
    }
    //overwrite o sobreescrito
    public function intro() {
        echo "The fruit is {$this->name}, the color is {$this->color}, and the weight is {$this->weight} gram.";
      }

}


$strawberry = new Strawberry("Strawberry", "red",25);
$strawberry->message();
$strawberry->intro();