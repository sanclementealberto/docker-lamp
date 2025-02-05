<?php
    /**
     * @var mixed
     * En el ejemplo anterior establecemos que la cookie caducará después de 30 días (86400 * 30). 
     * El “/” significa que la cookie está disponible en todo el sitio web (también podríamos seleccionar el directorio que queramos).
     */
    $cookie__name="usuario";
    $cookie_value="sabela";
    setcookie($cookie__name,$cookie_value,time()+(86000*30),"/"); //86000 s 1 dia osea seria 1 mes

?>