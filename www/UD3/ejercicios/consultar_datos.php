<?php
echo "<h1> Proba select bd consultar datos <h1/>";
$conexion = null;

try {
$conexion=new mysqli("db","root","test","myDB");
echo "conexion correcta bd <br/>";
$sql = "SELECT id, nombre, apellido FROM clientes";
$resultados=$conexion->query($sql);
//si me devuelve 1 fila o mas
if ($resultados->num_rows > 0) {
    //fecth_assoc()coloca todos los resultados en una matriz
    //que podemos recorrer con un bucle
    while($row=$resultados->fetch_assoc()){
        echo $row["id"]. " - " . $row ["nombre"] ." ".$row["apellido"] . "<br/>";
    }
}else{
    echo "no hay resultados";
}


} 
catch (mysqli_sql_exception $e) {
}
