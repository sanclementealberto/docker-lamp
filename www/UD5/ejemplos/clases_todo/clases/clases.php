<?php

class Fruit
{
  //modificadores de acceso public cualquier  lugar
  public $name;
  // solo metodo de la propia clase o clases derivadas herencia
  protected $color;
  //solo accesible dentro de la clase
  private $peso;


  function setColor($n)
  { // a public function
    $this->color = $n;
  }
  function setPeso($n)
  { // a public function por defento si no lleva protected o private
    $this->peso = $n;
  }

  function setName($name)
  {
    $this->name = $name;
  }

  function getName()
  {
    return $this->name;
  }

}
$apple = new Fruit();
$banana = new Fruit();
$verdura = new Fruit();
$banana = new Fruit();

echo $apple->getName();
echo "<br>";
echo $banan->getName();

$mango = new Fruit();
$mango->name = 'Mango'; // OK
$mango->setColor('Yellow'); // OK
$mango->setPeso('300'); // OK

//podemos unsar la palabra clave instaceof para verificar si un objeto pertenece a una clase especifica
$apple = new Fruit();
var_dump($apple instanceof Fruit);

?>