<?php
require_once('../modelo//entity/Usuario.php');
require_once('../modelo//entity/Rol.php');

session_start();
//siempre al principio y para recuperar y poder usar $_SESSION()

require_once("../modelo/pdo.php");


function comprobarUsuario($nombre,$pass, $conPDO)
{
    $usuarioDB=buscaUsername($nombre);
    if($usuarioDB){
        $passDB=$usuarioDB->getContrasena();

        // comprobamos la contraseña introducida
        if(password_verify($pass,$passDB))
        {
            $usuario=new Usuario();
            $usuario->setId($usuarioDB->getId());
            $usuario->setUsername($nombre);
            $usuario->setRol($usuarioDB->getRol());
          
            return $usuario;
        }else{
            return null;
        }
    }
    else{
        return null;
    }
}   

//comprobar si recibe datos do formulario de login.php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $usuario =$_POST["username"];
    $pass=$_POST["pass"];

    //pimer acceso a la bd para testing
    if($usuario=="admintest" && $pass=='test123')
    {
        $user=new Usuario();

        $user->setUsername('admintest');
        $user->setRol(Rol::ADMIN);
        $user->setId(0);
        $_SESSION['usuario']=$user;
        //redirigimos a index.php
        header("Location: ../index.php");
        exit();
    }

    if(empty($usuario) || empty($pass))
    {
        header("Location: ./login.php?error=true&message=Los campos del formulario son obligatorios.");
    }
    $conPDO=conectaPDO();
    if(is_string($conPDO))
    {
        header("Location: ./login.php?error=true&message=" .$conPDO);
    }
    $user=comprobarUsuario($usuario,$pass,$conPDO);
    if(!$user)
    {
        header("Location: ./login.php?error=true");
    }
    elseif(is_string($user))
    {
        header("Location: ./login.php?error=true&message=" .$user);
    }
    else
    {
        $_SESSION['usuario']=$user;
        //redirigimos al index.php
        header("Location: ../index.php");
    }

}



?>