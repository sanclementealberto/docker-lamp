<?php
    //eligo el nombre de la cookie a modificar
    // cargamos primero esta pagina y luego la de recuperar cookie
    $cookie_name = "usuario";
    $cookie_value = "alberto";
    setcookie($cookie_name, $cookie_value, time() + (86000 * 30), "/");
    echo "cookie modificada  alberto";
  ?>


