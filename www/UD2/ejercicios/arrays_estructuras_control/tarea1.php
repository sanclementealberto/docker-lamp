<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        function diezPares(){

            for($i= 0; $i<=10; $i++){
                
                if($i%2==0){
                    echo "numeros pares :".$i."<br/>";
                }
            }

        }
        diezPares();

        $v[1]=90;
        $v[10] = 200;
        $v["hola"]=43;
        $v[9]="e";
        function imprimirForEach(){
            global $v;
                foreach($v as $resultado)
                 echo " resultado :". $resultado ."<br/>";
        }
        imprimirForEach();




        

?>

</body>
</html>