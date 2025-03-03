<?php
class ExPropia extends Exception
{

}

class ExPropiaCLasss{

    public  static function testNumberr($number){
        if($number===0){ 
            new ExPropia("error no puede ser 0 ");
        }
        return "Número válido: " . $number;

    }
}
try {
    $test = ExPropiaCLasss::testNumberr(0); 
    echo $test."<br>";
} catch (ExPropia $e) {
    echo "Excepción capturada: " . $e->getMessage(); 
}


try {
    $test = ExPropiaCLasss::testNumberr(5); 
    echo $test."<br>";
} catch (ExPropia $e) {
    echo "Excepción capturada: " . $e->getMessage(); 
}
?>