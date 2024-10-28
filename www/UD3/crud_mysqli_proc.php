<?php
echo '<h1>CRUD mysqli procedimental</h1>';

//Crear la conexión
$con = mysqli_connect('db', 'root', 'test', 'myDBproc');
//Comprobar la conexión
if(!$con){
    die('Fallo en la conexión: ' . mysqli_connect_error());
}
echo 'Conexión correcta <br>';

echo '<h3>INSERT</h3>';
$sql = "INSERT INTO clientes (nombre, apellido, email) 
    VALUES ('Marco', 'Magán', 'marco@iessanclemente.net')";
if(mysqli_query($con, $sql)){
    $ultimo_id = mysqli_insert_id($con);
    echo 'Se ha insertado un registro con un ID: ' . $ultimo_id . '<br>';
}else{
    echo 'No se pudo insertar el registro: ' . mysqli_error($con) . '<br>';
}

$sql = "INSERT INTO clientes (nombre, apellido, email) 
    VALUES ('Sabela', 'Sobrino', 'marco@iessanclemente.net');";
$sql .=  "INSERT INTO clientes (nombre, apellido, email) 
    VALUES ('Maria', 'Garcia', 'maria@iessanclemente.net');";
$sql .=  "INSERT INTO clientes (nombre, apellido, email) 
    VALUES ('Julia', 'Rode', 'julia@iessanclemente.net');";
if (mysqli_multi_query($con, $sql)) {
    do {
        $ultimo_id = mysqli_insert_id($con);
        echo "Se ha creado un nuevo registro con el id: " . $ultimo_id . '<br>';
    } while ($con->next_result()); //Es necesario recorrerlos todos para liberar la conexión para los siguientes usos  
}
else{
    echo 'Se ha insertado un registro con un ID: ' . $ultimo_id . '<br>';
}


echo '<h3>SELECT</h3>';
$sql = "SELECT id, nombre, apellido FROM clientes";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        echo "id: " . $row["id"]. " - Nombre: " . $row["nombre"]. " " . $row["apellido"]. "<br>";
    }
}
else {
  echo "Sin resultados";
}

echo '<h3>UPDATE</h3>';

echo '<h3>DELETE</h3>';


mysqli_close($con);