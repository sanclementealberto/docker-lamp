<!--include_once solo una vez | include -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $cookie_name = "usuario";
    if(!isset($_COOKIE[$cookie_name])){
        echo "La cookie con nombre '" . htmlspecialchars($$cookie_name) ."' no está definida !";
    }else{
        echo "La cookie '". htmlspecialchars($cookie_name) . "' está definida !<br>";
        echo " Su valor es ". $_COOKIE[$cookie_name]; //asi obtengo el valor de la cookie con el nombre usuario
    }

?>
    
</body>
</html>