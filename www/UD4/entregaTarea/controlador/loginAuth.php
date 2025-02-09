<?php 
session_start();



include_once("../modelo/pdo.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $usuario =$_POST["username"];
    $contraseña=$_POST["contraseña"];
    $correctoUser=comprobarUsuario($usuario,$contraseña);

    if(!$correctoUser)
    {
        $error=true;
        
    }
    else
    {
        $_SESSION['usuario']=$correctoUser['username'];
        $_SESSION['rol']=$correctoUser['rol'];
        //redirigo  a la pagina principal al ser el login correcto
        header('Location: ../index.php');
        //evito que el script se siga ejecutando
        exit();
        
    }

}


?>