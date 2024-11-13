<?php
echo "<h1> Actualizar datos <h1/>";

$conexion=null;



try{
    $conexion=mysqli_connect("db","root","test","myDB");
    echo " conexion correcta bd <br/>";
    $sql ="UPDATE clientes set apellido ='maneiro' Where nombre ='Marco'";

    if($conexion->query($sql)){
        echo "campo actualizado correctamente";
    }else{
        echo "error al actualizar :" . $conexion->error;
    }

}
catch(mysqli_sql_exception $e)
{
    echo "".$e->getMessage()."";
}