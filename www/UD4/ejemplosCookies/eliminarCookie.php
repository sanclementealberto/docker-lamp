<?php

setcookie("usuario","",time()-3600,"/");
if (isset($_COOKIE["usuario"])) {
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

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
   
   if (!isset($_COOKIE["usuario"])) {
       echo "Cookie 'usuario' fue eliminada correctamente.";
   } else {
       echo "Error: La cookie 'usuario' aún existe.";
   }
   

?>
</body>
</html>