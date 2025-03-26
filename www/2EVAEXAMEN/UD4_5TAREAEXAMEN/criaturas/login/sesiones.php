<?php
session_start();
require_once(__DIR__ . '/../modelo/entity/Criatura.php');

$url_sesiones = str_replace($_SERVER['DOCUMENT_ROOT'], '', __DIR__);




if(!checkSession()){
    redirectLogin();
}


function checkSession()
{
    return isset($_SESSION['criatura']);
}

function redirectLogin()
{
    global $url_sesiones;
    header("Location : $url_sesiones/login.php?redirect=true");
}

function checkAdmin()
{
    return (checkSession() && $_SESSION['usuario']->getTipo()==Tipo::AGUA);
}

function redirectIndex()
{
    global $url_sesiones;
    header("Location: $url_sesiones/../index.php?redirect=true");
    exit();
}