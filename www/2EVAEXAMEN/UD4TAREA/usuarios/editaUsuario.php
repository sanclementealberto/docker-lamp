<?php
require_once('../login/sesiones.php');
if (!checkAdmin()) redirectIndex();
require_once('../utils.php');
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$username = $_POST['username'];
$contrasena = $_POST['contrasena'];
$rol =$_POST['rol'];

$response='error';
$messages=array();

require_once('../modelo/entity/Usuario.php');
require_once('../modelo/entity/Rol.php');
require_once('../modelo/pdo.php');


$errores=array();

if(!empty($contrasena)){
    $errores=Usuario::validate($_POST);
}
else
{
    $errores=Usuario::validateWithoutPassword($_POST);
}


if(empty($errores)){
    $usuario = new Usuario(filtraCampo($nombre), filtraCampo($apellidos), filtraCampo($username), $contrasena, Rol::from((int)$rol));
    $usuario->setId($id);
    
    if($resultado[0])
    {
        $messages=['Usuario actualizado correctamente'];
        $response='success';
    }
    else
    {
        $messages=['Ocurrio un error actualizando el usuario:'. $resultado[1]];
    }
 
}
else
{
    $messages=$errores;
}





$_SESSION['status']=$response;
$_SESSION['messages']=$messages;
//en las url los parametros se pasan por ? - ?id=$id
//los parametros se unen mediante &
header("Location: editaUsuarioForm.php?id=$id&status=$status&message=$message");

?>


