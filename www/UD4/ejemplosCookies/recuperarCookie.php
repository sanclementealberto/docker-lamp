<!--include_once solo una vez | include -->

<?php
include_once 'crearCookie.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if(!isset($_COOKIE[$cookie__name])){
        echo "La cookie con nombre '" .$cookie_nombre ."' no está definida !";
    }else{
        echo "La cookie '".$cookie_name . "' está definida !<br>";
        echo " Su vallor es ". $_COOKIE[$cookie__name];
    }

?>
    
</body>
</html>