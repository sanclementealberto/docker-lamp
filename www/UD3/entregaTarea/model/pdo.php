<?php

function conexionPDO()
{
    $servername = "db";
    $username = "root";
    $password = "test";

    try {
        $conexion = new PDO("mysql:host=$servername", $username, $password);
        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sqlCrearDB = "CREATE DATABASE IF NOT EXISTS tareas";
        if ($conexion->exec($sqlCrearDB)) {

            return $conexion;

        } else {
            throw new Exception("error al crear la bd");
        }
    } catch (PDOException $e) {
        throw new Exception("error al crear la bd" . $e->getMessage());

    }



}


function crearTablaUsuario()
{

    $sqlTablaUsuario = 'CREATE TABLE usuarios(
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    nombre VARCHAR(30) NOT NULL,
    apellidos VARCHAR(30) NOT NULL,
    contrasena VARCHAR(100) NOT NULL
    )';

    try {
        $conexion = conexionPDO();
        if (!$conexion) {
            return [false, "fallo en la conexion"];

        }
        $conexion->exec("USE tareas");
        $conexion->exec($sqlTablaUsuario);


        return [true, "tabla usuarios ha sido creada con exito"];
    } catch (PDOException $e) {
        return [false, $e->getMessage()];

    } finally {
        cerrarConexionPDO($conexion);
    }



}





//puede ser null
function editaUsuarioPD0($id, $username, $nombre, $apellidos, $contrasena)
{



    try {
        $conexion = conexionPDO();
        if (!$conexion) {
            return [false, "fallo en la conexion bd"];
        }
        $conexion->exec("USE tareas");

        $sqlEditaUsuario = $conexion->prepare("UPDATE usuarios u SET 
    username=:username,
    nombre=:nombre,
    apellidos=:apellidos
    where id=:id");

    //.=concatenar cadenas
     if (!empty($contrasena)) {
        $sqlEditaUsuario .= ", contrasena = :contrasena";
    }



        //asocio los bindeos parametros a la consulta

        $sqlEditaUsuario->bindParam(':username', $username);
        $sqlEditaUsuario->bindParam(':nombre', $nombre);
        $sqlEditaUsuario->bindParam(':apellidos', $apellidos);

        //si no es null  la actualiza
        if (!empty($contrasena)) {
            $sqlEditaUsuario->bindParam(":contrasena", $contrasena);
        }
        $sqlEditaUsuario->bindParam(':id', $id);

        $sqlEditaUsuario->execute();

        if ($sqlEditaUsuario->rowCount() > 0) {
            return [true, "usuario actualizado correctamente"];
        } else {
            return [false, "fallo al actualizar usuario"];
        }


    } catch (PDOException $e) {
        return [false, $e->getMessage()];

    } finally {
        cerrarConexionPDO($conexion);
    }
}

function buscaUsuarioPDD($id){
    try{
        $conexion=conexionPDO();
        if(!$conexion){
            return [false,"fallo al conectar a la bd"];
        }
        $conexion->exec("USE tareas");
        $sqlusuario=$conexion->prepare("SELECT username,nombre,apellidos,contrasena FROM usuarios where id=:id");
      
        $sqlusuario->bindParam(":id",$id);



        $sqlusuario->execute();
        $usuario=$sqlusuario->fetch(PDO::FETCH_ASSOC);

        if ($usuario) {
            return [true, $usuario]; 
        } else {
            return [false, "No se encontró un usuario con ese id "];
        }

    }catch(PDOException $e){
        return[false,"error al buscar usuario"];

    }finally{
        cerrarConexionPDO($conexion);

    }
}


function borrarUsuarioPDO($id){
    try{
        $conexion=conexionPDO();
        if(!$conexion){
            return [false,"fallo al conectar a la bd"];
        }
        $conexion->exec("USE tareas");
        
        $sqlborrar=$conexion->prepare("DELETE FROM usuarios where id=:id");
        //binding
        $sqlborrar->bindParam(":id",$id);
        $sqlborrar->execute();
        if($sqlborrar->rowCount()>0){
            return [true,"usuario eliminado "];
        }else{
            return [false,"no se encontro usuario con ese ID"];
        }

    }catch(PDOException $e){
        return [false,"error al borrar usuario"];
    }finally{
        cerrarConexionPDO($conexion);
    }


}




function nuevoUsuarioPDO($username, $nombre, $apellidos, $contrasena)
{
    try {
        $conexion = conexionPDO();

        if (!$conexion) {
            return [false, "problema al conectarse a la bd"];
        }
        //selecione la BD'''
        $conexion->exec("USE tareas");
        //preparalo la consulta y bindeo parametros
        $sqlNuevoUsuario = $conexion->prepare("INSERT INTO usuarios(username,nombre,apellidos,contrasena)
        VALUES (:username,:nombre,:apellidos,:contrasena)");
        $sqlNuevoUsuario->bindParam(':username', $username);
        $sqlNuevoUsuario->bindParam(':nombre', $nombre);
        $sqlNuevoUsuario->bindParam(':apellidos', $apellidos);
        $sqlNuevoUsuario->bindParam(':contrasena', $contrasena);


        $sqlNuevoUsuario->execute();

        return [true, "usuario añadido correctamente"];


    } catch (PDOException $e) {
        return [false, "problema al añadir usuario"];


    } finally {
        cerrarConexionPDO($conexion);
    }


}


function listaUsuariosPDO()
{
    try {
        $conexion = conexionPDO();

        if (!$conexion) {
            return [false, "problema al conectarse la bd"];
        }
        $conexion->exec("USE tareas");

        $sqlListaUsuarios = $conexion->prepare("SELECT id,username,nombre,apellidos FROM usuarios");
        $sqlListaUsuarios->execute();

        $listaUsuarios = $sqlListaUsuarios->fetchAll(PDO::FETCH_ASSOC);

        return [true, $listaUsuarios];


    } catch (PDOException $e) {

        return [true, "error al mostrar la lista de usuarios", $e->getMessage()];

    } finally {
        cerrarConexionPDO($conexion);
    }
}






function cerrarConexionPDO($conexion)
{
    $conexion = null;

}




















