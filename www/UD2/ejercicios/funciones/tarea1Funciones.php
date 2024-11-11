<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        function numeroDiezCero($valor){
            if($valor<0  || $valor>9){
                echo "$valor no es un numero entre 0 y 9 <br/>";
            }else{
            echo "$valor es un numero entre 0 y 9 <br/>";
            }
        }

        numeroDiezCero("a");
        numeroDiezCero(8);
        numeroDiezCero(11);
        numeroDiezCero(-1);

        function longitudString($cadena){
            echo  "la longitud de la cadena: ".strlen($cadena)."<br/>";
        }

        longitudString("iria");
        longitudString("rachel");
        longitudString("marina");


        function numeroMasElevado($num1,$num2,$num3){
            if($num1>$num2 && $num1>$num3){
                echo "$num1 es mayor que $num2 y $num3 <br/>";
            }else if( $num2>$num3){
                echo "$num2 es mayor que $num3 y $num1 <br/>" ;
            }else{
                echo "$num3 es mayor que $num1 y $num2 <br/>";
            }
        }

        numeroMasElevado(10,5,8);
        numeroMasElevado(8,10,6);
        numeroMasElevado(10,5,12);
        numeroMasElevado(10,13,11);

        function esUnaVocal($vocal){
            if($vocal=== "a" || $vocal=== "e" || $vocal=== "i" || $vocal=== "o" || $vocal=== "u"){
                echo " $vocal es una vocal <br/>";
                return true;
            }
            echo " $vocal no es una vocal <br/>";
            return false;


        }
        esUnaVocal("a");
        esUnaVocal("b");
        esUnaVocal("f");
        esUnaVocal("u");
        esUnaVocal("i");


        function esPar($numero){
          
            if(is_numeric($numero)){
               
                if($numero % 2 == 0){
                    return "$numero es par <br/>";
                } else {
                    return "$numero es impar <br/>";
                }
            } else {
                return "El valor $numero ingresado no es un número válido. <br/>";
            }
        }
        
       echo esPar(5);
       echo esPar(10);
       echo esPar("a");
        function devolverMayusculas($palabra){
             
            
            
            return "Devuelvo en mayúsculas: " . strtoupper($palabra)."<br/>";
            
        }
        
        echo devolverMayusculas("alberto");

        function zonaHoraria(){
            $zona_horaria=date_default_timezone_get();
            
            return "la hora del sistema es $zona_horaria ".date("H:i") ."<br/>";
        }

        echo zonaHoraria();

?>
</body>
</html>