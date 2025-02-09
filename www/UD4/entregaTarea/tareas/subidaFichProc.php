<?php
require_once("../modelo/pdo.php");
//carpeta destino ficheros
$carpeta="../files/";
$extension=['jpg','png','pdf'];


    if($_SERVER['REQUEST_METHOD']==="POST"){
        if ($_FILES["fichero"]["size"] <=20971520 ) {
            $nombre=$_POST['nombre'];
            $descripcion=$_POST['descripcion'];
            $idtarea =$_POST['id'];

            $file = $_FILES["fichero"]["name"];
            

            $extensionMinusculas=strtolower(pathinfo($nombre, PATHINFO_EXTENSION));
            

            if(is_writable($carpeta)){
                $codigoAleatorio = bin2hex(random_bytes(8));
                $nombreArchivo = $codigoAleatorio . "_" . basename($_FILES["fichero"]["name"]); 
                $rutaDestino = $carpeta . $nombreArchivo; 
            
                if (move_uploaded_file($_FILES["fichero"]["tmp_name"], $rutaDestino)) {
                    $url = $_SERVER['HTTP_REFERER'];
                    header("Location: $url");
                    echo "El archivo se ha subido correctamente como $nombreArchivo";
                } else {
                    echo "Hubo un error al subir el archivo.";
                }
            }


           $codigoAleatorio = bin2hex(random_bytes(8));
           
           move_uploaded_file($codigoAleatorio,$carpeta);
           if (!in_array($extensionMinusculas,$extension)) {
           
             }


            añadirFichero($nombre,$file,$descripcion,$idtarea);
        } 

    }


?>