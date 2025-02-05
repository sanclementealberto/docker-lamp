<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    //con 'w' sobreescribis los datos, con 'a' el puntero del archivo se situa en el ultimo caracter del fichero.
    $mifichero = fopen("nuevoarchivo.txt", "a") or die("Unable to open file!");
    $txt = "Alejandro\n";
    fwrite($mifichero, $txt);
    $txt = "Julián\n";
    fwrite($mifichero, $txt);
    fclose($mifichero);
    echo "agregado nuevo texto";
    
?>
</body>
</html>