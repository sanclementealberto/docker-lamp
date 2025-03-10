<?php 
abstract class ClaseAbstracta {
    // Forzar a estensión de clase para definir los siguientes métodos
    abstract protected function getValor();
    abstract protected function valorPrefijo($prefijo);

    // Método común (no abstracto)
    public function imprimir() {
        print $this->getValor() . "\n";
    }
}

// Define los métodos abstractos de ClaseAbstracta
class ClaseConcreta1 extends ClaseAbstracta {
    protected function getValor() {
        return "ClaseConcreta1";
    }

    public function valorPrefijo($prefijo) {
        return $prefijo."ClaseConcreta1";
    }
}

// Define los métodos abstractos de ClaseAbstracta
class ClaseConcreta2 extends ClaseAbstracta {
    public function getValor() {
        return "ClaseConcreta2";
    }

    public function valorPrefijo($prefijo) {
        return $prefijo."ClaseConcreta2";
    }
}

// Uso de las clases
$clase1 = new ClaseConcreta1;
$clase1->imprimir();
echo $clase1->valorPrefijo('FOO_') ."\n";

$clase2 = new ClaseConcreta2;
$clase2->imprimir();
echo $clase2->valorPrefijo('FOO_') ."\n";