<?php
echo "<h1> creacion de mi tabla en la bd mydb";
$conexion=null;


try
{
$conexion = new mysqli("db","root", "test","myDB");
echo "conexion correcta <br/>";

//crear tabla si no existe
$sql_tabla= 'CREATE TABLE IF NOT EXISTS clientes(
    id INT(7) AUTO_INCREMENT PRIMARY KEY,
    Nombre VARCHAR(30) NOT NULL,
    apellido VARCHAR(30) NOT NULL,
    email VARCHAR(50)
    )';
    $conexion ->select_db("myDB");
    if($conexion->query($sql_tabla)){
        echo "tabla creada correctamente <br/>";
    }else
    {
        echo "Error creado la tabla ".$conexion->error . "<br/>";
    }

//insertar datos | con la . (concatenacion podes añadir varias conultas simultaneas)
/**
 * $sql_insert.="consulta";
 */
$sql_insert="INSERT INTO clientes(nombre,apellido,email)
VALUES ('Marco','Magan','marco@iessanclemente.net');"; 
$sql_insert.="INSERT INTO clientes(nombre,apellido,email)
VALUES ('alberto','garcia','alberto@iessanclemente.net');"; 
$sql_insert.="INSERT INTO clientes(nombre,apellido,email)
VALUES ('Maria','manerio','maria@iessanclemente.net');"; 

if($conexion ->multi_query($sql_insert)){
    echo "se ha creado un nuevo registro";
}
else{
    echo " no se pudo crear el nuevo registro ".$conexion->error;
}

/**
 * una consulta |query
 */
if($conexion ->query($sql_insert)){
    echo "se ha creado un nuevo registro";
}
else{
    echo " no se pudo crear el nuevo registro ".$conexion->error;
}


}catch (mysqli_sql_exception $error)
{
    echo "Error en la conexion :" .$error->getMessage() . "<br/>";


}finally
{
    //cerrar la conexion si se establecio
    if(isset($conexion) ){
        $conexion->close();
    }
}


