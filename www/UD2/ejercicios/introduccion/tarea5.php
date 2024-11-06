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
        
        function cuadradoNumero(){
            $cuadrado=0;
           

            for($i= 0; $i< 30; $i++ )
            {
                $numero1=$i*$i;
                $resultado="el resultado de ".$i." es " .$cuadrado." <br/>"; 

               
            }

            return $numero1. "<br/>";
        }

       echo cuadradoNumero();
       
        function areaRectangulo($base,$altura){
            
            $area=$base*$altura;
            
            return "<p>la area es ".$area ."</p> </br/>";

        }

        echo areaRectangulo(5,4);


        function perimetroRectangulo($base,$altura){
            $perimetro=2*$base+ 2*$altura;

            return "<p> el perimetro es ".$perimetro. "</p>";

        }
        echo perimetroRectangulo(5,4);




    ?>



</body>

</html>