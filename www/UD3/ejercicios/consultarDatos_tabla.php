
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">


</head>
<body>

<?php

echo "<h1> consultar datos para sacarlos en una tabla";
$conexion=null;

try {
    $conexion=new mysqli("db","root","test","myDB");
    echo "conexion correcta bd <br/>";
    $sql = "SELECT id, nombre, apellido FROM clientes";
    $resultados=$conexion->query($sql);
    //si me devuelve 1 fila o mas
    if ($resultados->num_rows > 0) {
        //fecth_assoc()coloca todos los resultados en una matriz
        //que podemos recorrer con un bucle
        echo "<div class='container-fluid full-body-table'>";   
    echo "<table class='table table-striped table-hover table-responsive'>";
    echo "<thead><tr>";
    echo "<th>Id</th>";
    echo "<th>Nombre</th>";
    echo "<th>Apellido</th>";
    echo "</tr></thead>";
        while($row = $resultados->fetch_assoc()){
          
            echo "<tr>";
            echo "<td>". $row['id']. "</td>"; 
            echo "<td>". $row['nombre']. "</td>"; 
            echo "<td>". $row['apellido']. "</td>";
            echo "<td> <a class='btn btn-primary' href='borrar.php?id=".$row['id']."'>Borrar</a> </td>";
            echo "</tr>";
        }
        echo "</table>"; 
        echo "</div>";   
        
    }else{
        echo "no hay resultados";
    }
    
    
    } 
    catch (mysqli_sql_exception $e) {
    }
    


?>

    
</body>
</html>