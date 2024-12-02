<?php



function conexion($servername, $username, $password,$namedb){
   
    try{
        $conexion = new PDO("mysql:host=$servername",$username,$password);
        $conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $sqldatabase="CREATE DATABASE IF NOT EXISTS $namedb";
        $conexion->exec($sqldatabase);
    }catch(PDOException  $e){
        echo $sqldatabase . $e->getMessage();

    }finally{
        //cerra conexion
        $conexion=null;
    }
}