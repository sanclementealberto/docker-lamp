<?php

class Car{
    public $name;
    public $color;



    function __construct($name){
        $this->name =$name;
    }
    // un destructor cuando se destruye el objeto o se detiene o se sale del script.
    function __destruct(){
        echo " the fruit is {$this->name}.";
    }

    function getName(){
        return $this->name;
    }

   
}
$car=new Car("Apple");
echo $car->getName();