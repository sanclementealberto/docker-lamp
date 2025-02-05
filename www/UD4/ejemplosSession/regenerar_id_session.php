<?php 
  session_start(); 

  if (!isset($_SESSION['mimarcadecontrol']))
  { 
    // Regenera el ID de sesión manteniendo las variables que había en la sesión.
    // El parámetro true es para que borre el fichero de la ID de sesión antigua.
    session_regenerate_id(true); 
    $_SESSION['mimarcadecontrol'] = true; 
  } 


//se puede cambiar el id de sesión cada vez que un usuario cambie su estado (registrado, autenticado, etc..

if ($usuario_logueado === true)
{
	session_regenerate_id(true);
	$_SESSION['logueado'] = true;
}

?>