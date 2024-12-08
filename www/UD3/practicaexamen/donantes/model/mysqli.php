<?php



function conexionDonantes(){
    try{
    $conexion= new mysqli('db','root','test');
    
    if($conexion->connect_error){
        throw new Exception("conexion fallida".$conexion->connect_error);
        
    }
   

    $sqlcndonantes="CREATE DATABASE IF NOT EXISTS donantes";
    if($conexion->query($sqlcndonantes)){
        return [$conexion,"conexion realizada"];
    }
    
    
    }catch(mysqli_sql_exception $e){
       
        return[false , $e->getMessage()];
        
    }

}











function desconexionBDdonantes(){
    
}