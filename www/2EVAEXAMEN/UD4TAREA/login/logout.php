<?php
session_start();
    //con session start recupero una sesion activa
    // si no la incluyo $_SESSION No estara disponible
    //esto vacia el array de la session eliminando las variable
    require_once('../modelo/entity/Usuario.php');
    require_once('../modelo/entity/Rol.php');
    $_SESSION=array();
    //destruye la sesion, pero no elimina la cookie
    session_destroy();
    header("location: login.php");


?>