<?php

function conectaPDO()
{
    $servername = $_ENV['DATABASE_HOST'];
    $username = $_ENV['DATABASE_USER'];
    $password = $_ENV['DATABASE_PASSWORD'];
    $dbname = $_ENV['DATABASE_NAME'];

    $conPDO = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conPDO;
}

function listaUsuarios()
{
    try {
        $con = conectaPDO();
        $stmt = $con->prepare('SELECT id, username, nombre, apellidos FROM usuarios');
        $stmt->execute();

        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $resultados = $stmt->fetchAll();
        return [true, $resultados];
    } catch (PDOException $e) {
        return [false, $e->getMessage()];
    } finally {
        $con = null;
    }
}

function listaTareasPDO($id_usuario, $estado)
{
    try {
        $con = conectaPDO();
        $sql = 'SELECT * FROM tareas WHERE id_usuario = ' . $id_usuario;
        if (isset($estado)) {
            $sql = $sql . " AND estado = '" . $estado . "'";
        }
        $stmt = $con->prepare($sql);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $tareas = array();
        while ($row = $stmt->fetch()) {
            $usuario = buscaUsuario($row['id_usuario']);
            $row['id_usuario'] = $usuario['username'];
            array_push($tareas, $row);
        }
        return [true, $tareas];
    } catch (PDOException $e) {
        return [false, $e->getMessage()];
    } finally {
        $con = null;
    }
}





function nuevoUsuario($nombre, $apellidos, $rol, $username, $contrasena)
{
    try {
        $con = conectaPDO();
        $stmt = $con->prepare("INSERT INTO usuarios (nombre, apellidos,rol, username, contrasena) VALUES (:nombre, :apellidos, :rol,:username, :contrasena)");
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':rol', $rol);
        $stmt->bindParam(':username', $username);
        //hasheo la contraseña antes de guardarla
        $passwordHasheada = password_hash($contrasena, PASSWORD_DEFAULT);
        $stmt->bindParam(':contrasena', $passwordHasheada);

        $stmt->execute();

        $stmt->closeCursor();

        return [true, null];
    } catch (PDOException $e) {
        return [false, $e->getMessage()];
    } finally {
        $con = null;
    }
}

function actualizaUsuario($id, $nombre, $apellidos, $rol, $username, $contrasena)
{
    try {
        $con = conectaPDO();
        $sql = "UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos,rol =:rol, username = :username";

        if (isset($contrasena)) {
            $sql = $sql . ', contrasena = :contrasena';
        }

        $sql = $sql . ' WHERE id = :id';

        $stmt = $con->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':rol', $rol);

        $stmt->bindParam(':username', $username);
        if (isset($contrasena))
            $stmt->bindParam(':contrasena', $contrasena);
        $stmt->bindParam(':id', $id);

        $stmt->execute();

        $stmt->closeCursor();

        return [true, null];
    } catch (PDOException $e) {
        return [false, $e->getMessage()];
    } finally {
        $con = null;
    }
}
function añadirFichero($nombre,$file,$descripcion,$tarea){

    try{
        $conexion=conectaPDO();

     
            $stmt=$conexion->prepare("INSERT INTO ficheros (nombre,file,descripcion,id_tarea)VALUES(:nombre,:file,:descripcion,:tarea) ");
            $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':file', $file);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':tarea', $tarea);



            
            $stmt->execute();
            $stmt->closeCursor();
            return [true, "fichero subido correctamente"];
        
    }
    catch(mysqli_sql_exception $e){
        return[false, $e->getMessage()];
    }
   

}





function borraUsuario($id)
{
    try {
        $con = conectaPDO();

        $con->beginTransaction();

        $stmt = $con->prepare('DELETE FROM tareas WHERE id_usuario = ' . $id);
        $stmt->execute();
        $stmt = $con->prepare('DELETE FROM usuarios WHERE id = ' . $id);
        $stmt->execute();

        return [$con->commit(), ''];
    } catch (PDOException $e) {
        return [false, $e->getMessage()];
    } finally {
        $con = null;
    }
}

function comprobarUsuario($username, $contraseña)
{
    try {
        $con = conectaPDO();
        // Consulta segura con parámetros
        $stmt = $con->prepare('SELECT username, contrasena,rol FROM usuarios WHERE username = :username ');

        // Asociamos los valores con los placeholders
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);

        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        //compruebo si el has de la contraseña coincide con la contraseña ingresada por el usuario
        if ($usuario && password_verify($contraseña, $usuario['contrasena'])) {

            return $usuario;
        } else {

            return null;
        }
    } catch (PDOException $e) {
        return null;
    }
}


function listaFicheros(){
    try{
        $conexion=conectaTareas();
        if($conexion->connect_error){
            return [false,$conexion->error];
        }
        else
        {
            $sql="SELECT * FROM ficheros";
            $resultados=$conexion->query($sql);
            $ficheros=array();

            while($row=$resultados->fetch_assoc())
            {
                array_push($ficheros,$row);
            }
            return [true,$ficheros];
        }
    }
    catch(mysqli_sql_exception $e){
        return [false, $e->getMessage()];
    }
    finally{
        cerrarConexion($conexion);
    }
}




//id?
function buscarRolUsuario($rol)
{
    try {
        $con = conectaPDO();

        $con->beginTransaction();
        $stm = $con->prepare(('SELECT   FROM tareas where rol=' . $rol));
        $stm->execute();
        $stm->setFetchMode(PDO::FETCH_ASSOC);

        if ($stm->rowCount() == 1) {
            return $stm->fetch();
        } else {
            return null;
        }
    } catch (PDOException $e) {
        return null;
    } finally {
        $con = null;
    }
}
function buscaUsuario($id)
{

    try {
        $con = conectaPDO();
        $stmt = $con->prepare('SELECT * FROM usuarios WHERE id = ' . $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if ($stmt->rowCount() == 1) {
            return $stmt->fetch();
        } else {
            return null;
        }
    } catch (PDOException $e) {
        return null;
    } finally {
        $con = null;
    }
}
