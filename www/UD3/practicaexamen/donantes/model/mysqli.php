<?php

function conexionDonantesMYSQL()
{
    try {
        $conexion = new mysqli('db', 'root', 'test');

        if ($conexion->connect_error) {
            throw new Exception("conexion fallida" . $conexion->connect_error);

        }


        $sqlcndonantes = "CREATE DATABASE IF NOT EXISTS donantes";
        if (!$conexion->query($sqlcndonantes)) {
            throw new Exception("Error al crear la base de datos" . $conexion->error);
        }

        return $conexion;
    } catch (mysqli_sql_exception $e) {

        return $e->getMessage();

    }

}
function conexionBDDonantesMYSQL()
{
    try {
        $conexion = conexionDonantesMYSQL();
        if (!$conexion->select_db("donantes")) {
            throw new Exception("Error seleccionando la base de datos donantes" . $conexion->error);
        }

        return $conexion;

    } catch (mysqli_sql_exception $e) {
        throw new Exception("error en la conexion BD donantesmysqli" . $e->getMessage());

    }
}

//puedo  ponere expresion regulares en sql
function crearTablaDonantesMYSQLI()
{
    try {
        $conexion = conexionBDDonantesMYSQL();
        $sqlTablaDonantes = "CREATE TABLE IF NOT EXISTS donantes(
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(50) NOT NULL,
        apellidos VARCHAR(50) NOT NULL,
        edad INT NOT NULL,
        grupo_sanguineo ENUM('O-', 'O+', 'A-', 'A+', 'B-', 'B+', 'AB-', 'AB+') NOT NULL,
        codigo_postal CHAR(5) NOT NULL CHECK (codigo_postal REGEXP  '^[0-9]{5}$'), 
        telefono_movil CHAR(9) NOT NULL CHECK  (telefono_movil REGEXP '^[0-9]{9}$')
        
        )";
        if (!$conexion->query($sqlTablaDonantes)) {
            return [false, "fallo en la consulta  al crear la tabla donantes "];
        }
        return [true, "tabla donantes creada"];


    } catch (mysqli_sql_exception $error) {
        return [false, $error->getMessage()];

    } finally {
        desconexionBDdonantesMYSQL($conexion);
    }
}
/*
 * Summary of crearTablaDonaciones
 * @return array
 * ON DELETE CASCADE CUANDO BORRO UN DONANTES SE BORRA EN DONACIONES
 */
function crearTablaDonacionesMYSQLI()
{
    try {
        $sqlTablaDonaciones = 'CREATE TABLE IF NOT EXISTS donaciones(
        id INT AUTO_INCREMENT PRIMARY KEY,
        id_donante INT NOT NULL,
        fecha_donacion DATE NOT NULL,
        fecha_proxima_donacion DATE NOT NULL,
        FOREIGN KEY (id_donante) REFERENCES donantes(id) ON DELETE CASCADE 
        )';
        $conexion = conexionBDDonantesMYSQL();

        if (!$conexion->query($sqlTablaDonaciones)) {
            return [false, "fallo en la consulta al crear la tabla donaciones"];
        }
        return [true, "tabla donaciones creada con exito"];

    } catch (mysqli_sql_exception $error) {
        return [false, "fallo al crear la tabla donaciones"];
    } finally {
        desconexionBDdonantesMYSQL($conexion);
    }

}

function crearTablaAdministradoresMYSQLI()
{
    try {
        $sqlTablAdministradores = 'CREATE TABLE IF NOT EXISTS administradores(
        usuario VARCHAR(50) PRIMARY KEY,
        contrasinal VARCHAR(50) NOT NULL)';
        $conexion = conexionBDDonantesMYSQL();
        if (!$conexion->query($sqlTablAdministradores)) {
            return [false, "fallo en la consulta administradores"];
        }

        return [true, "tabla administradores creada"];

    } catch (mysqli_sql_exception $error) {
        return [false, "fallo al crear la tabla administradores"];
    } finally {
        desconexionBDdonantesMYSQL($conexion);
    }

}

function registarDonanteMYSQLI($nombre, $apellidos, $edad, $grupoSanguino, $codigoPostal, $telefonoMovil)
{
    try {
        $conexion = conexionBDDonantesMYSQL();
        $sqlNuevoDonante = $conexion->prepare('INSERT INTO donantes (nombre,apellidos,edad,grupo_sanguineo,codigo_postal,telefono_movil)
        VALUES(?,?,?,?,?,?)');
        $sqlNuevoDonante->bind_param("ssisss",$nombre,$apellidos,$edad,$grupoSanguino,$codigoPostal,$telefonoMovil);

        if(!$sqlNuevoDonante->execute()){
            return [false,"fallo al ejecutar la consulta"];
        }       

        return [true, "Donante registrado "];
    } catch (mysqli_sql_exception $error) {
        return [false, $error->getMessage()];
    } finally {
        desconexionBDdonantesMYSQL($conexion);
    }
}

function listaDonantesMYSQL(){
    try{
        $conexion=conexionBDDonantesMYSQL();
        $sqlListaDonantes='SELECT  id,nombre,apellidos,edad,grupo_sanguineo,codigo_postal,telefono_movil FROM  donantes';
        $resultado=$conexion->query($sqlListaDonantes);

        if(!$resultado){    
            return[false,"fallo en la query lista donantes"];
            
        }
        $donantes = $resultado->fetch_all(MYSQLI_ASSOC);
        
        return [true,$donantes];           
    }catch(mysqli_sql_exception $e){
        return [false, $e->getMessage()];
    }finally{
        desconexionBDdonantesMYSQL($conexion )  ;
    }
}
/**
 * affected_rows	INSERT, UPDATE, DELETE, REPLACE	Cuenta filas afectadas por operaciones
 *  que modifican la base de datos.
* num_rows	SELECT	Cuenta el número de filas devueltas por una consulta SELECT.
 * 
 * 
 */

function eliminarDonanteMYSQL($id){
    try{
        $conexion=conexionBDDonantesMYSQL();
        $sqlEliminarDonante=$conexion->prepare("DELETE FROM donantes where id =?");
        $sqlEliminarDonante->bind_param("i",$id);
        
         if(!$sqlEliminarDonante->execute()){
            return [false,"error al ejecutar la consulta ".$sqlEliminarDonante->error];
         }
        //devolver si afecto a algun registro de la bd
         if ($sqlEliminarDonante->affected_rows == 0) {
            return [false, "No se encontró un donante con el ID proporcionado."];
        }   


         return[true,"donante eliminado"];

    }catch(mysqli_sql_exception $e){
        return [false,$e->getMessage()];
    }finally{
        desconexionBDdonantesMYSQL($conexion);
    }
}

function obtenerNombreDonante($id_donante){

    try{

        $conexion=conexionBDDonantesMYSQL();
        $sqlencontrardonante=$conexion->prepare("SELECT nombre FROM donantes where id=?");
        $sqlencontrardonante->bind_param("i",$id_donante);
        
        
        if(!$sqlencontrardonante->execute()){
            return[false,"error al ejecutar la consulta".$sqlencontrardonante->error];
        }
        $resultado=$sqlencontrardonante->get_result();
        if($resultado->num_rows==0) {
            return [false,"donante no encontrado".$sqlencontrardonante->error];
        }
        //fetch_assoc solo devuelve una fila
        $fila=$resultado->fetch_assoc();
        return [true,$fila['nombre']];



    }catch(mysqli_sql_exception  $e){
        return [false,"fallo ".$e->getMessage()];

    }finally{
        desconexionBDdonantesMYSQL($conexion);
    }

}

/**
 * Summary of buscarDonantes
 * 
 * 
 * 
 * 
 * COALESCE evita que la bd devuelva un campo null y muetra
 * otro texto mas legible 
 */
function buscarDonantesMYSQLI($codigoPostal,$grupo_sanguineo){

    try{
        $conexion=conexionBDDonantesMYSQL();
        $sql="SELECT d.nombre,d.apellidos,d.edad, d.grupo_sanguineo,d.codigo_postal,
        COALESCE (o.fecha_proxima_donacion,'No registrada') AS fecha_proxima_donacion FROM
        donantes d LEFT JOIN donaciones o ON d.id=o.id_donante 
        where d.codigo_postal=? ";

        //la declaron vacia por si no se selecciona
        $params=[];
        $param_types="s";//codigo postal
        $params[]=$codigoPostal;

        //filtro grupo sanguineo

        if(!empty($grupo_sanguineo)){
            $sql .=" AND d.grupo_sanguineo=?";
            $param_types .="s";
            $params[]=$grupo_sanguineo;
        }

        $sql.="ORDER BY o.fecha_proxima_donacion DESC";

        $prepare=$conexion->prepare($sql);
        $prepare->bind_param($param_types,...$params);

        if(!$prepare->execute()){
            return [false, "error al ejecutar la consulta".$prepare->error];
        }
            $resultado=$prepare->get_result();
            $donantes=$resultado->fetch_all(MYSQLI_ASSOC);
            
            return[true,$donantes];
        
    }catch(mysqli_sql_exception $e){
        return [false,$e->getMessage()];
    }finally{
        desconexionBDdonantesMYSQL($conexion);
    }
}




function registrarDonacion($id_donante,$fecha_donacion,$fecha_proxima_donacion){
    try{

        $conexion=conexionBDDonantesMYSQL();
        $sqlregistrardonacion=$conexion->prepare('INSERT INTO donaciones (id_donante,fecha_donacion,fecha_proxima_donacion)  VALUES (?,?,?)');
        $sqlregistrardonacion->bind_param("iss",$id_donante,$fecha_donacion,$fecha_proxima_donacion);

        if(!$sqlregistrardonacion->execute()){
            return [false,"fallo al ejecutar la consulta donacion ".$sqlregistrardonacion->error];
        }
        return [true,"donacion registrada"];
    
    }catch(mysqli_sql_exception $e){
        return [false,$e->getMessage()];

    }finally{
        desconexionBDdonantesMYSQL($conexion);
    }
}

//nombre ,apellido edad ,grupo sanguineo y ordenados fecha decreciente
function listaDonacionesMYSQLI(){
    try{
        $conexion=conexionBDDonantesMYSQL();
        $sqlListaDonantes='SELECT d.nombre,d.apellidos,d.edad,d.grupo_sanguineo,o.fecha_donacion
         from donantes d INNER JOIN donaciones o on d.id=o.id_donante
         ORDER BY fecha_donacion DESC';
        $resultado=$conexion->query($sqlListaDonantes);

        if(!$resultado){
            return[false,"fallo en la query lista donaciones"];
        }
        $donaciones=$resultado->fetch_all(MYSQLI_ASSOC);
        return [true ,$donaciones];

    }catch(mysqli_sql_exception $e){
        return[false,$e->getMessage()];

    }finally{
        desconexionBDdonantesMYSQL($conexion);
    }
}

     


function desconexionBDdonantesMYSQL($conexion)
{
    $conexion = conexionBDDonantesMYSQL();
    if ($conexion->connect_errno === 0) {
        $conexion->close();
    }

}