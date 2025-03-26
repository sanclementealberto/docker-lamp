<?php

require_once __DIR__ . '/entity/Usuario.php';
require_once __DIR__ . '/entity/Tarea.php';
require_once __DIR__ . '/entity/Fichero.php';

function conectaPDO()
{
    $servername = $_ENV["DATABASE_HOST"];
    $username = $_ENV['DATABASE_USER'];
    $password = $_ENV["DATABASE_PASSWORD"];
    $dbname = $_ENV["DATABASE_NAME"];

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


        $resultados = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $usuario = new Usuario();
            $usuario->setId($row['id']);
            $usuario->setUsername($row['username']);
            $usuario->setNombre($row['nombre']);
            $usuario->setApellidos($row['apellidos']);
            //from convierte el valor de la b en una isntancia de Rol
            $usuario->setRol(Rol::from($row['rol']));
            $usuario->setContrasena($row['contrasena']);
            //com empty($resultados) puedo comprobar si el array esta vacio
            //un bvalor en especifio isset($resultados['nombreusuarioejemplo'])
            $resultados[] = $usuario;
        }
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
            $tarea = new Tarea($row['titulo'], $$row['descripcion'], $usuario, Estado::from($row['estado']));
            $tarea->setId($row['id']);
            $tareas[] = $tarea;
        }
        return [true, $tareas];
    } catch (PDOException $e) {
        return [false, $e->getMessage()];
    } finally {
        $con = null;
    }

}

function nuevoUsuario($usuario)
{
    try {
        $con = conectaPDO();
        $stmt = $con->prepare("INSERT INTO usuarios (nombre, apellidos, username, contrasena) VALUES (:nombre, :apellidos, :username, :contrasena)");

        $nombre = $usuario->getNombre();
        $apellidos = $usuario->getApellidos();
        $username = $usuario->getUsername();
        $rol = $usuario->getRol()->value;
        $hasheado = password_hash($usuario->getContrasena(), PASSWORD_DEFAULT);


        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':rol', $rol);
        $stmt->bindParam(':contrasena', $hasheado);
        $stmt->execute();

        //close cursor libera los recuros de la consulta sociada
        $stmt->closeCursor();

        return [true, null];
    } catch (PDOException $e) {
        return [false, $e->getMessage()];
    } finally {
        $con = null;
    }
}

function actualizaUsuario($usuario)
{
    try {
        $con = conectaPDO();
        $sql = "UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos, username = :username";

        if (isset($contrasena)) {
            $sql = $sql . ', contrasena = :contrasena';
        }

        $sql = $sql . ' WHERE id = :id';

        $stmt = $con->prepare($sql);

        $nombre = $usuario->getNombre();
        $apellidos = $usuario->getApellidos();
        $username = $usuario->getUsername();
        $rol = $usuario->getRol()->value;
        $id = $usuario->getId();


        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':rol', $rol);
        if (!empty($usuario->getContrasena())) {
            $hasheado = password_hash($usuario->getContrasena(), PASSWORD_DEFAULT);
            $stmt->bindParam(':contrasena', $hasheado);
        }
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

function buscaUsuario($id)
{

    try {
        $con = conectaPDO();
        $stmt = $con->prepare('SELECT * FROM usuarios WHERE id = ' . $id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $usuario = null;
        if ($row = $stmt->fetch()) {
            $usuario = new Usuario();
            $usuario->setId($row['id']);
            $usuario->setUsername($row['username']);
            $usuario->setNombre($row['nombre']);
            $usuario->setApellidos($row['apellidos']);
            $usuario->setRol(Rol::from($row['rol']));
            $usuario->setContrasena($row['contrasena']);

        }
        return $usuario;
        if ($stmt->rowCount() == 1) {
            return $stmt->fetch();
        }
        else
        {
            return null;
        }
    } catch (PDOException $e) {
        return null;
    } finally {
        $con = null;
    }

}

//PDO
function buscarUsername($username)
{
    try {
        $con = conectaPDO();
        $stmt = $con->prepare('SELECT id,rol ,contrasena FROM usuarios where username="' . $username . '"');
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);


        if ($stmt->rowCount() == 1) {
            $usuario=null;
            if($row=$stmt->fetch()){
                $usuario=new Usuario();
                $usuario->setId($row['id']);
                $usuario->setRol(Rol::from($row['rol']));
                $usuario->setContrasena($row['contrasena']);
            }
            return $usuario;
        } else {
            return null;
        }
    } catch (PDOException $e) {
        return null;
    } finally {
        $con = null;
    }
}
