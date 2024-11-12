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

        echo "Error en la conexion : <br/>";
    }
} catch (mysqli_sql_exception $e) {

    echo 'Error en la conexión: ' . $e->getMessage() . '<br>';

}
