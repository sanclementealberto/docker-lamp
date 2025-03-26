<?php
require_once('../login/sesiones.php');
if (!checkAdmin()) redirectIndex();

require_once('../utils.php');
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$username = $_POST['username'];
$contrasena = $_POST['contrasena'];
$rol =$_POST['rol'];
$response ='error';
$messages=array();
require_once('../modelo/entity/Usuario.php');
require_once('../modelo/entity/Rol.php');
require_once('../modelo/pdo.php');

$errores=Usuario::validate($_POST);
//verificar nombre
if(empty($errores)){
    $usuario = new Usuario(filtraCampo($nombre), filtraCampo($apellidos), filtraCampo($username), $contrasena, Rol::from((int)$rol));
    $resultado= nuevoUsuario($usuario);
    if($resultado[0]){
        $messages=['Usuario guardado correctamente'];
        $response='success';
    }
    else
    {
        $messages=['Ocurrio un error guardado el usuario:'. $resultado[1]];
    }
}


require_once('../modelo/entity/Usuario.php');
require_once('../modelo/entity/Rol.php');

header("Location : nuevoUsuarioForm.php?status=$status&message=$message");