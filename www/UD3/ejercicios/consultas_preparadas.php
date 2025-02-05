<?php
echo "<h1> conexion preparada";
$conexion = null;

try {
    $conexion = new mysqli("db", "root", "test", "myDB");
    echo "conexion correcta <br/>";

    //consulta preparada |insertamos signo de interrogacion ?
    // donde queramos sustiuir por un entero,cadena ...
    $consulta_preparada = $conexion->prepare("INSERT INTO clientes (nombre,apellido,email)
    
    VALUES(?,?,?)");
    //sss enumera los tipos de datos sss por cada string
    // pueden ser i=entero | d=doble | s=cadena | b=blob
    $consulta_preparada->bind_param("sss", $nombre, $apellido, $email);

    $nombre = "alberto";
    $apellido = "garcia";
    $email = "alejandro@edu.com";
    $consulta_preparada->execute();

    $nombre = "Julian";
    $apellido = "Garcia";
    $email = "julian@edu.com";
    $consulta_preparada->execute();

    echo "Nuevos registros añadidos correctamente <br/>";
} catch (mysqli_sql_exception $e) {
    echo "Error conexion" . $e->getMessage() . "";
} finally {
    if (isset($conexion)) {
        $conexion->close();
    }
}
