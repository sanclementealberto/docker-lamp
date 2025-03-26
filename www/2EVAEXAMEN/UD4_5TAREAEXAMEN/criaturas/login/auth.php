<?php
session_start();

require_once('../modelo/entity/Criatura.php');

require_once('../modelo/pdo.php');

function comprobarCriatura($nombre,$pass,$conPDO)
{
 //obtengo la contraseña ,el id y erol mediante el usuario
    //con el nombre el usuario obtengo el id,rol y contrasena
    $usuarioBD = buscaUsername($nombre);

    //Comprobamos que haya usuario
    if ($usuarioBD)
    {
        $passBD=$usuarioBD->getContrasena();
        //Comprobamos la contraseña introducida dehaseheo la pass
        if (password_verify($pass, $passBD))
        {
            $usuario = new Usuario();
            $usuario->setId($usuarioBD->getId());
            $usuario->setUsername($nombre);
            $usuario->setRol($usuarioBD->getRol());
            return $usuario;
        }
        else
        {
            return null;
        }
    }
    else
    {
        return null;
    }
}

//obtengo los datos del formulario de login

if($_SERVER["REQUEST_METHOD"]=="POST"){
    //son los inputs y los obtengo por su id de input
    $usuario = $_POST["username"];
    $pass = $_POST["pass"];

     // >>>> IMPORTANTE: estas líneas están solo para permitir el primer acceso, cuando no está creada la base de datos. Solo se deben descomentar para la primera conexión.
     if ($usuario == 'admintest' && $pass == 'test123')
     {
         $user = new Usuario();
         $user->setUsername('admintest');
         $user->setRol(Rol::ADMIN);
         $user->setId(0);
         $_SESSION['usuario'] = $user;
         //Redirigimos a index.php
         header('Location: ../index.php');
         exit();
     }

     if (empty($usuario) || empty($pass))
     {
         header('Location: ./login.php?error=true&message=Los campos del formulario son obligatorios.');
     }
 
     $conPDO = conectaPDO();
     if (is_string($conPDO))
     {
         header('Location: ./login.php?error=true&message=' . $conPDO);
     }
     $user = comprobarUsuario($usuario, $pass, $conPDO);
     if(!$user)
     {
         header('Location: ./login.php?error=true');
     }
     else
     {
         $_SESSION['usuario'] = $user;
         //Redirigimos a index.php
         header('Location: ../index.php');
     }
 }
 
