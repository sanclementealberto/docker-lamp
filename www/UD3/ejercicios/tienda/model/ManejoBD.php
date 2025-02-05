<?php




function crearBDTienda()
{

    global $conexion;

    try {
        $conexion = conexion();
        $crearBD = "CREATE DATABASE IF NOT EXISTS tienda";
        if($conexion->query($crearBD)){
            return true;

        }else{
            return "error :". $conexion->error;
        }
   



    } catch (mysqli_sql_exception $e) {
        $e->getMessage();
    } finally {
        $conexion->close();
    }

}


function conexionBDTienda()
{
    
    try {
        $conexion = new mysqli("db", "root", "test", "tienda");

        if ($conexion->connect_error) {
            return throw new Exception("Error en la conexión: " . $conexion->connect_error);
        }


        return $conexion;
    } catch (mysqli_sql_exception $e) {
        return $e->getMessage();
    }
}





function conexion()
{
    global $conexion;
    try {
        $conexion = new mysqli("db", "root", "test");

        if ($conexion->connect_error) {
            return throw new Exception("Error en la conexión: " . $conexion->connect_error);
        }


        return $conexion;
    } catch (mysqli_sql_exception $e) {
        return $e->getMessage();
    }


}










