<?php

echo "<h1> CRUD mysql orientacion a objetos";

$conexion = null;


try {
    $conexion = new mysqli("db", "root", "test");
    echo "conexion correcta <br/>";

    $sql="CREATE DATABASE myDB";
    if($conexion ->query($sql)){
        echo "Base de datos creada correctamente <br/>";

    }else{

        echo "Error en la conexion : <br/>" . $conexion->error;
    }
} catch (mysqli_sql_exception $e) {

    echo 'Error en la conexión: ' . $e->getMessage() . '<br>';

}finally 
{
    if(isset($conexion) && $conexion->connect_errno===0){
        $conexion->close();
        echo "conexion cerra";
    }
}
