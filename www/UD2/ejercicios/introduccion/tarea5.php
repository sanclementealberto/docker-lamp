<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $celsius=0;
        function farenheitToCelsius($temperaturaFarenheit){
            global $celsius;

            return ($temperaturaFarenheit-32)*5/9;    
            
        }

        $celsius=farenheitToCelsius(70);
        echo $celsius ."<br/>";

        $x=20;
        $y= 10;
        $resultado;

        function  suma($x,$y){
            return $resultado=$x + $y;
        }

        function resta($x,$y){
            return $resultado=$x-$y;
        }

        function multiplicacion($x,$y){
            return $resultado=$x*$y;
        }

        function division( $x,$y){
            return $resultado=$x/$y;
        }

        function modulo($x,$y){
            return $resultado=$x %$y;
        }

        echo suma($x,$y)."<br/>";
        echo resta($x,$y)."<br/>";
        echo multiplicacion($x,$y)."<br/>";
        echo division( $x,$y)."<br/>";
        echo modulo($x,$y)."<br/>";

    ?>



</body>

</html>