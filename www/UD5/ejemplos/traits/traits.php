<?php 

/**
 * Los traits de PHP son la forma más conveniente de reutilizar el código.
 *  Permiten a los programadores escribir métodos que pueden usarse en cualquier clase, manteniendo el código limpio y fácil de mantener.
 */
// Trait con un método
trait Saludo {
    public function saludar() {
        parent::saludar();
        echo 'Mundo!';
    }
}

// Clase base
class Base {
    public function saludar() {
        echo '¡Hola ';
    }
}

// Clase extendida de Base
class Derivada extends Base {
    use Saludo;
}

$b = new Base();
$b->saludar(); // Muestra "¡Hola "

$d = new Derivada();
$d->saludar(); // Muestra "¡Hola Mundo!"