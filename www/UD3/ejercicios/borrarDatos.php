<?php
echo "<h1> borrado de  datos <h1/>";

$conexion=null;



try{
    $conexion=mysqli_connect("db","root","test","myDB");
    echo " conexion correcta bd <br/>";
    $sql ="DELETE FROM clientes  Where nombre ='alberto'";

    if($conexion->query($sql)){
        echo "campo borrado correctamente";
    }else{
        echo "error al actualizar :" . $conexion->error;
    }

}
catch(mysqli_sql_exception $e)
{
    echo "".$e->getMessage()."";
}