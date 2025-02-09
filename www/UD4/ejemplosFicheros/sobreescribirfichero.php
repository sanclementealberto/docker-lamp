<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    $mifichero = fopen("nuevoarchivo.txt", "w") or die("Unable to open file!");
    $txt = "Miguel\n";
    fwrite($mifichero, $txt);
    $txt = "Iván\n";
    fwrite($mifichero, $txt);
    fclose($mifichero);
    echo "archivo sobreescrito";
?>
</body>
</html>