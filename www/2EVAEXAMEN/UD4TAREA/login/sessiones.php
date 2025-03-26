<?php 
require_once(__DIR__ .'/../modelo/entity/Rol.php');
require_once(__DIR__ .'/../modelo/entity/Usuario.php');
session_start();
//session estar siempre debe ser la 1º linea en el pagina sin spacios
$raiz= $_ENV["RAIZ_UD4"];

if(!checkSession()){
    redirectLogin();
}

function checkSession()
{
    return isset($_SESSION['usuario']);
}

function redirectLogin()
{
    global $raiz;
    header("Location: $raiz/login/login.php?redirect=true");
    exit();
}

function checkAdmin(){
    global $raiz;
    return (checkSession() && $_SESSION["usuario"]->getRol()==Rol::ADMIN);
}

function redirectIndex()
{
    global $raiz;
    header("Location: $raiz/index.php?redirect=true");
    exit();
}
?>