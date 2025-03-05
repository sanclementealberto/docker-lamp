<?php
include_once("../modelo/Usuario.php");
include_once("../modelo/Fichero.php");

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
        $stmt = $con->prepare('SELECT id, username, nombre, apellidos, rol, contrasena FROM usuarios');
        $stmt->execute();

        $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $usuarios = [];

        foreach ($resultados as $usuario) {
            $usuarios[] = new Usuario(
                $usuario['id'],
                $usuario['username'],
                $usuario['nombre'],
                $usuario['apellidos'],
                $usuario['rol'],
                $usuario['contrasena']
            );
        }


        return [true, $usuarios];
    } catch (PDOException $e) {
        return [false, $e->getMessage()];
    } finally {
        $con = null;
    }

}

function listaTareasPDO($id_usuario, $estado = null)
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
        $tareas = [];
        while ($row = $stmt->fetch()) {
            $usuario = buscaUsuario($row['id_usuario']);
            if ($usuario) {
                $row['username'] = $usuario['username'];
            }
            $tareas[] = $row; // Agregamos la tarea a la lista
        }
        return [true, $tareas];
    } catch (PDOException $e) {
        return [false, $e->getMessage()];
    } finally {
        $con = null;
    }

}

function nuevoUsuario(Usuario $usuario)
{
    try {
        $con = conectaPDO();
        $stmt = $con->prepare("INSERT INTO usuarios (nombre, apellidos, username, rol, contrasena) VALUES (:nombre, :apellidos, :username, :rol, :contrasena)");

        $nombre = $usuario->getNombre();
        $apellidos = $usuario->getApellidos();
        $username = $usuario->getUsername();
        $rol = $usuario->getRol();
        $contrasena = password_hash($usuario->getContrasena(), PASSWORD_BCRYPT);



        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':rol', $rol);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->execute();

        $stmt->closeCursor();

        return [true, null];
    } catch (PDOException $e) {
        return [false, $e->getMessage()];
    } finally {
        $con = null;
    }
}

function actualizaUsuario(Usuario $usuario)
{
    try {
        $con = conectaPDO();
        $sql = "UPDATE usuarios SET nombre = :nombre, apellidos = :apellidos, username = :username, rol = :rol";

        if (isset($contrasena)) {
            $sql = $sql . ', contrasena = :contrasena';
        }

        $sql = $sql . ' WHERE id = :id';

        $stmt = $con->prepare($sql);

        $nombre = $usuario->getNombre();
        $apellidos = $usuario->getApellidos();
        $username = $usuario->getUsername();
        $rol = $usuario->getRol();
        $id = $usuario->getId();
        $contrasena = $usuario->getContrasena();

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellidos', $apellidos);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':rol', $rol);
        if (isset($contrasena)) {
            $hasheado = password_hash($contrasena, PASSWORD_DEFAULT);
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

function borraUsuario(Usuario $usuario)
{
    try {
        $con = conectaPDO();

        $con->beginTransaction();

        $id = $usuario->getIdUsuario();

        //PRIMERO tengo que borrar las tareas asociadas al usuario para poder borrarlo
        $stmt = $con->prepare('DELETE FROM tareas WHERE id_usuario = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();



        $stmt = $con->prepare('DELETE FROM usuarios WHERE id = :id');
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        // Confirmar la transacción
        $con->commit();

        return [true, ''];
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
        $stmt = $con->prepare('SELECT id, username, nombre, apellidos, rol, contrasena FROM usuarios WHERE id =:id');

        //para prevenir inyecicon sql
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);

        if ($row = $stmt->fetch()) {
            return new Usuario(
                $row['id'],
                $row['username'],
                $row['nombre'],
                $row['apellidos'],
                $row['rol'],
                $row['contrasena']
            );
        } else {
            return null;
        }
    } catch (PDOException $e) {
        return null;
    } finally {
        $con = null;
    }

}

function buscaUsername($username)
{
    try {
        $con = conectaPDO();
        $stmt = $con->prepare('SELECT id, username, nombre, apellidos, contrasena, rol FROM usuarios WHERE username = :username');
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->execute();

        $datos = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($datos !== false) {
            return new Usuario(
                $datos['id'],
                $datos['username'],
                $datos['nombre'],
                $datos['apellidos'],
                $datos['rol'],
                $datos['contrasena']
            );
        } else {
            return null;
        }
    } catch (PDOException $e) {
        return null;
    } finally {
        $con = null;
    }

}

function listaFicheros($id_tarea)
{
    try {
        $con = conectaPDO();
        $sql = 'SELECT * FROM ficheros WHERE id_tarea = ' . $id_tarea;
        $stmt = $con->prepare($sql);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $ficheros = array();
        while ($row = $stmt->fetch()) {
            array_push($ficheros, $row);
        }
        return $ficheros;
    } catch (PDOException $e) {
        return  throw new DatabaseException(
            "Error al elistar ficheros: " . $e->getMessage(),
            "execute",
            $sql,
            $e->getCode(),
            $e
        );
    } finally {
        $con = null;
    }
}

function buscaFichero($id)
{
    try {
        $con = conectaPDO();
        $sql = 'SELECT * FROM ficheros WHERE id = ' . $id;
        $stmt = $con->prepare($sql);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $fichero = null;
        if ($row = $stmt->fetch()) {
            $tarea = null;
            if ($row['id_tarea']) {
                $usuario = buscaUsuario($row['id']);

                $tarea = new Tarea(
                    $usuario,
                    $row['$id']
                );
            }


            $fichero = new Fichero(
                $tarea,
                $row['id'],
                $row['nombre'],
                $row['file'],
                $row['descripcion']

            );
        }
        return $fichero;
    } catch (PDOException $e) {
        throw new DatabaseException(
            "Error al ejecutar la consulta en busqueda fichero: " . $e->getMessage(),
            "execute",
            $sql,
            $e->getCode(),
            $e
        );
    } finally {
        $con = null;
    }
}

function borraFichero($id)
{
    try {
        $con = conectaPDO();
        $sql = 'DELETE FROM ficheros WHERE id = ' . $id;
        $stmt = $con->prepare($sql);
        $stmt->execute();

        return true;
    } catch (PDOException $e) {
        //en la vista se lanza la excepcion databaseException
        return false;
    } finally {
        $con = null;
    }
}

function nuevoFichero(Fichero $file)
{
    try {
        $con = conectaPDO();
        $stmt = $con->prepare("INSERT INTO ficheros (nombre, file, descripcion, id_tarea) VALUES (:nombre, :file, :descripcion, :idTarea)");

        $nombre = $file->getNombre();
        $filepath = $file->getFile();
        $descripcion = $file->getDescripcion();
        $idtarea = $file->getTarea()->getIdTarea();

        $stmt->bindParam(':file', $filepath);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':idTarea', $idtarea);
        $stmt->execute();

        $stmt->closeCursor();

        return [true, null];
    } catch (PDOException $e) {
        return [false,  throw new DatabaseException(
            "Error al ejecutar la consulta en busqueda fichero: " . $e->getMessage(),
            "execute",
            $stmt,
            $e->getCode(),
            $e
        )];
    } finally {
        $con = null;
    }
}