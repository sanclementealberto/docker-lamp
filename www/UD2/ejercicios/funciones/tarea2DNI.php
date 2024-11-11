<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 

        function comprobar_nif($dni){
            $dni_letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E'];
           
            $numero_dni=intval(substr($dni,0,-1));
            $letra_dni=strtoupper(substr($dni,-1));

            $comprobarletra=$numero_dni%23;
            $obtener_letra=$dni_letras[$comprobarletra];

            if(strlen($dni)==9){
                if($letra_dni===$obtener_letra) {
                    return  strtoupper($dni)."  DNI VALIDO";
                }else{
                    return  strtoupper($dni)." DNI INVALIDO";
                }

            }else{
                return false."el dni no tiene la longitud correcta";
            }



        }
        echo comprobar_nif("53795281a");

?>
</body>
</html>