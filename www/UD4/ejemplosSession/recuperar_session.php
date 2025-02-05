<?php
session_start();
?>
<!DOCTYPE html>
<html>

<body>

    <?php
    // Echo session variables that were set on previous page| si no paso por el primer fichero o cierro el navegador no las paso. solo se mantendria si el navegador se mantiene abierto
    echo "El color favorito es: " . $_SESSION["favcolor"] . ".<br>";
    echo "El animal favorito es:  " . $_SESSION["favanimal"] . ".";

    //obtener el id de la sesion
    echo 'A sesión actual é: ' . session_id();

    //cambio el color de verde y amarillo con solo sobreescribirla
    $_SESSION["favcolor"] = "amarillo";
    print_r($_SESSION);

    //eliminar una variable de sesion
    
    unset($_SESSION['favcolor']);
    // Eliminar todas las variables de la sessión 
   // session_unset();

    // Destruir la sesión
   // session_destroy();

    ?>

</body>

</html>