<?php

include_once('Tarea.php');

function conecta($host, $user, $pass, $db)
{
    $conexion = new mysqli($host, $user, $pass, $db);
    return $conexion;
}

function conectaTareas()
{
    $host = $_ENV['DATABASE_HOST'];
    $user = $_ENV['DATABASE_USER'];
    $pass = $_ENV['DATABASE_PASSWORD'];
    $name = $_ENV['DATABASE_NAME'];
    return conecta($host, $user, $pass, $name);
}

function cerrarConexion($conexion)
{
    if (isset($conexion) && $conexion->connect_errno === 0) {
        $conexion->close();
    }
}

function creaDB()
{
    try {
        $host = $_ENV['DATABASE_HOST'];
        $user = $_ENV['DATABASE_USER'];
        $pass = $_ENV['DATABASE_PASSWORD'];
        $conexion = conecta($host, $user, $pass, null);
        
        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            // Verificar si la base de datos ya existe
            $sqlCheck = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'tareas'";
            $resultado = $conexion->query($sqlCheck);
            if ($resultado && $resultado->num_rows > 0) {
                return [false, 'La base de datos "tareas" ya existía.'];
            }

            $sql = 'CREATE DATABASE IF NOT EXISTS tareas';
            if ($conexion->query($sql))
            {
                return [true, 'Base de datos "tareas" creada correctamente'];
            }
            else
            {
                return [false, 'No se pudo crear la base de datos "tareas".'];
            }
        }
    }
    catch (mysqli_sql_exception $e)
    {
        return [false, $e->getMessage()];
    }
    finally
    {
        cerrarConexion($conexion);
    }
}

function createTablaUsuarios()
{
    try {
        $conexion = conectaTareas();
        
        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            // Verificar si la tabla ya existe
            $sqlCheck = "SHOW TABLES LIKE 'usuarios'";
            $resultado = $conexion->query($sqlCheck);

            if ($resultado && $resultado->num_rows > 0)
            {
                return [false, 'La tabla "usuarios" ya existía.'];
            }

            $sql = 'CREATE TABLE `usuarios` (`id` INT NOT NULL AUTO_INCREMENT , `username` VARCHAR(50) NOT NULL , `rol` INT DEFAULT 0, `nombre` VARCHAR(50) NOT NULL , `apellidos` VARCHAR(100) NOT NULL , `contrasena` VARCHAR(255) NOT NULL , PRIMARY KEY (`id`)) ';
            if ($conexion->query($sql))
            {
                return [true, 'Tabla "usuarios" creada correctamente'];
            }
            else
            {
                return [false, 'No se pudo crear la tabla "usuarios".'];
            }
        }
    }
    catch (mysqli_sql_exception $e)
    {
        return [false, $e->getMessage()];
    }
    finally
    {
        cerrarConexion($conexion);
    }
}

function createTablaTareas()
{
    try {
        $conexion = conectaTareas();
        
        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            // Verificar si la tabla ya existe
            $sqlCheck = "SHOW TABLES LIKE 'tareas'";
            $resultado = $conexion->query($sqlCheck);

            if ($resultado && $resultado->num_rows > 0)
            {
                return [false, 'La tabla "tareas" ya existía.'];
            }

            $sql = 'CREATE TABLE `tareas` (`id` INT NOT NULL AUTO_INCREMENT, `titulo` VARCHAR(50) NOT NULL, `descripcion` VARCHAR(250) NOT NULL, `estado` VARCHAR(50) NOT NULL, `id_usuario` INT NOT NULL, PRIMARY KEY (`id`), FOREIGN KEY (`id_usuario`) REFERENCES `usuarios`(`id`))';
            if ($conexion->query($sql))
            {
                return [true, 'Tabla "tareas" creada correctamente'];
            }
            else
            {
                return [false, 'No se pudo crear la tabla "tareas".'];
            }
        }
    }
    catch (mysqli_sql_exception $e)
    {
        return [false, $e->getMessage()];
    }
    finally
    {
        cerrarConexion($conexion);
    }
}

function createTablaFicheros()
{
    try {
        $conexion = conectaTareas();
        
        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            // Verificar si la tabla ya existe
            $sqlCheck = "SHOW TABLES LIKE 'ficheros'";
            $resultado = $conexion->query($sqlCheck);

            if ($resultado && $resultado->num_rows > 0)
            {
                return [false, 'La tabla "ficheros" ya existía.'];
            }

            $sql = 'CREATE TABLE `ficheros` (`id` INT NOT NULL AUTO_INCREMENT, `nombre` VARCHAR(100) NOT NULL, `file` VARCHAR(250) NOT NULL, `descripcion` VARCHAR(250) NOT NULL, `id_tarea` INT NOT NULL, PRIMARY KEY (`id`), FOREIGN KEY (`id_tarea`) REFERENCES `tareas`(`id`))';
            if ($conexion->query($sql))
            {
                return [true, 'Tabla "ficheros" creada correctamente'];
            }
            else
            {
                return [false, 'No se pudo crear la tabla "ficheros".'];
            }
        }
    }
    catch (mysqli_sql_exception $e)
    {
        return [false, $e->getMessage()];
    }
    finally
    {
        cerrarConexion($conexion);
    }
}

function listaTareas()
{
    try {
        $conexion = conectaTareas();

        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $sql = "SELECT * FROM tareas";
            $resultados = $conexion->query($sql);
            $tareas =[];
            while ($row = $resultados->fetch_assoc()) {
                // Busca el usuario relacionado con la tarea
                $usuario = buscaUsuarioMysqli($row['id_usuario']);
                
                
                $usuario = new Usuario(
                    $usuario['id'],
                    $usuario['username'],
                    $usuario['nombre'],
                    $usuario['apellidos'],
                    $usuario['rol'],
                    $usuario['contrasena']
                );
                
               
                $tareaObj = new Tarea(
                    $usuario,
                    $row['id'],
                    $row['titulo'],
                    $row['descripcion'],
                    $row['estado'] 
                );
                
                // Agrega la tarea al arreglo
                array_push($tareas, $tareaObj);
            }
            return [true, $tareas];
        }
        
    }
    catch (mysqli_sql_exception $e) {
        return [false, $e->getMessage()];
    }
    finally
    {
        cerrarConexion($conexion);
    }
}

function nuevaTarea(Tarea $tarea)
{
    try {
        $conexion = conectaTareas();
        
        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $stmt = $conexion->prepare("INSERT INTO tareas (titulo, descripcion, estado, id_usuario) VALUES (?,?,?,?)");
            
            $titulo=$tarea->getTitulo();
            $descripcion=$tarea->getDescripcion();
            $estado=$tarea->getEstado();
            $usuarioId = $tarea->getUsuario()->getIdUsuario();
            $stmt->bind_param("sssi", $titulo, $descripcion, $estado, $usuarioId);

            $stmt->execute();

            return [true, 'Tarea creada correctamente.'];
        }
    }
    catch (mysqli_sql_exception $e)
    {
        return [false, $e->getMessage()];
    }
    finally
    {
        cerrarConexion($conexion);
    }
}

function actualizaTarea($id, $titulo, $descripcion, $estado,Usuario $usuario)
{
    try {
        $conexion = conectaTareas();
        
        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $usuarioId = $usuario->getIdUsuario();
            $sql = "UPDATE tareas SET titulo = ?, descripcion = ?, estado = ?, id_usuario = ? WHERE id = ?";
            $stmt = $conexion->prepare($sql);
            $stmt->bind_param("sssii", $titulo, $descripcion, $estado, $usuarioId, $id);

            $stmt->execute();

            return [true, 'Tarea actualizada correctamente.'];
        }
    }
    catch (mysqli_sql_exception $e)
    {
        return [false, $e->getMessage()];
    }
    finally
    {
        cerrarConexion($conexion);
    }
}

function borraTarea($id)
{
    try {
        $conexion = conectaTareas();

        if ($conexion->connect_error)
        {
            return [false, $conexion->error];
        }
        else
        {
            $sql = "DELETE FROM tareas WHERE id = " . $id;
            if ($conexion->query($sql))
            {
                return [true, 'Tarea borrada correctamente.'];
            }
            else
            {
                return [false, 'No se pudo borrar la tarea.'];
            }
            
        }
        
    }
    catch (mysqli_sql_exception $e) {
        return [false, $e->getMessage()];
    }
    finally
    {
        cerrarConexion($conexion);
    }
}

function buscaTarea($id)
{
    $conexion = conectaTareas();

    if ($conexion->connect_error)
    {
        return [false, $conexion->error];
    }
    else
    {
        $sql = "SELECT * FROM tareas WHERE id = " . $id;
        $resultados = $conexion->query($sql);
        if ($resultados->num_rows == 1)
        {
            return $resultados->fetch_assoc();
        }
        else
        {
            return null;
        }
    }
}

function esPropietarioTarea($idUsuario, $idTarea)
{
    $tarea = buscaTarea($idTarea);
    if ($tarea)
    {
        return $tarea['id_usuario'] == $idUsuario;
    }
    else
    {
        return false;
    }
}

function buscaUsuarioMysqli($id)
{
    $conexion = conectaTareas();

    if ($conexion->connect_error)
    {
        return [false, $conexion->error];
    }
    else
    {
        $sql = "SELECT id, username, nombre, apellidos, rol, contrasena  FROM usuarios WHERE id = " . $id;
        $resultados = $conexion->query($sql);
        if ($resultados->num_rows == 1)
        {
            return $resultados->fetch_assoc();
        }
        else
        {
            return null;
        }
    }
}