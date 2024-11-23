<?php
include_once("ManejoBD.php");


function crearTablaUsuarios()
{
    crearBDTienda();
    $conexion = conexionBDTienda();

    $sql_tablaUsuarios = 'CREATE TABLE IF NOT EXISTS usuarios (
        id INT(10) AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(50) NOT NULL,
        apellidos VARCHAR(100) NOT NULL,
        edad int NOT NULL,
        provincia VARCHAR(50)
    )';

    try {
        $conexion->select_db("tienda");
        $conexion->query($sql_tablaUsuarios);

        //testing para probar la creacion de la tabla
        echo "<script>console.log('PHP: Tabla creada correctamente');</script>";
    } catch (mysqli_sql_exception $e) {
       return  " Error de conexion  al crear la tabla " . $e->getMessage() . "";
    } finally {
        if (isset($conexion) && $conexion->connect_errno === 0) {
            $conexion->close();
        }
    }

}

function nuevoUsuario($nombre, $apellidos, $edad, $provincia)
{
    try {
        $conexion = conexionBDTienda();
        $insert_usuarios =
            $conexion->prepare("INSERT INTO usuarios (nombre, apellidos,edad ,provincia)
        VALUES(?,?,?,?)");
        //i entero , d double , s cadena | b blob
        $insert_usuarios->bind_param("ssis", $nombre, $apellidos, $edad, $provincia);


        if (!$insert_usuarios->execute()) {
            throw new mysqli_sql_exception("error al crear nuevo usuario " . $insert_usuarios->error);
        }

        return true;


    } catch (mysqli_sql_exception $e) {
        return" Error de conexion  al intenar añadir nuevo usuario " . $e->getMessage() . "";
    } finally {
        if (isset($conexion) && $conexion->connect_errno === 0) {
            $conexion->close();
        }
        if (isset($insert_usuarios)) {
            $insert_usuarios->close();
        }
    }
}


function listaUsuarios()
{
    try {
        $conexion = conexionBDTienda();
        $queryListaUsers = "SELECT * FROM usuarios";
        $result = $conexion->query($queryListaUsers);
        //compruebo si devuelve mas de un resultado
        if ($result->num_rows > 0) {
            $usuarios = [];
            while ($fila = $result->fetch_assoc()) {

                $usuarios[] = $fila;
            }
            return $usuarios;

        } else {
            //si n ohay retorna uno vacio
            return [];
        }

    } catch (mysqli_sql_exception $e) {
        
        return "Error al obtener la lista de usuarios: " . $e->getMessage();
    } finally {
        if (isset($conexion)) {
            $conexion->close();
        }
    }
}


function eliminarUsuario($id)
{
    try {
        $conexion = conexionBDTienda();
        $borrarUsuario = $conexion->prepare("DELETE FROM usuarios where id =?");
        $borrarUsuario->bind_param("i", $id);

        if (!$borrarUsuario->execute()) {
            throw new mysqli_sql_exception("error al crear nuevo usuario " . $borrarUsuario->error);
        }

        if ($borrarUsuario->affected_rows > 0) {
            return true;
        } else {
            return "No afecto a ninguna fila";
        }

    } catch (mysqli_sql_exception $e) {
        // tambien puedeo hacer
        //return [false."error en la conexion ".$e->getMessage()];
        return " Error de conexion  al intenar añadir nuevo usuario " . $e->getMessage() . "";

    } finally {
        if (isset($conexion) && $conexion->connect_errno === 0) {
            $conexion->close();
        }
    }

}


function modificarUsuario($id, $nombre, $apellidos, $edad, $provincia)
{
    try {
        $conexion = conexionBDTienda();
        $modificar_usuario = $conexion->prepare("UPDATE usuarios set nombre= ?, apellido= ?, edad= ? , provincia= ?  where id = ? ");

        $modificar_usuario->bind_param("ssisi", $nombre, $apellidos, $edad, $provincia, $id);

        if (!$modificar_usuario->execute()) {
            throw new mysqli_sql_exception("error al crear nuevo usuario " . $modificar_usuario->error);
        }
        if ($modificar_usuario->affected_rows > 0) {
            return true;
        } else {
            return "No se encontró ningun usuario ";
        }

    } catch (mysqli_sql_exception $e) {
        return" Error de conexion  al intenar añadir nuevo usuario " . $e->getMessage() . "";
    } finally {
        if (isset($conexion) && $conexion->connect_errno === 0) {
            $conexion->close();
        }
    }

}


function validarCampos($nombre, $apellidos, $edad, $provincia)
{



    if (empty($nombre) || empty($apellidos) || empty($edad) || empty($provincia)) {
        return false;
    }

    if (!is_numeric($edad) || (int) $edad <= 0) {
        return "La edad debe ser un número válido y mayor que 0.";
    }

    return true;

}


function validarInPuts($datos)
{
    if (!is_array($datos)) {
        return "$datos no es un array";
    }


    foreach ($datos as $campo) {
        if (empty(trim($campo))) {
            return "el campo $campo no puede estar vacio";
        }
    }

    if (!is_numeric($datos['edad']) || (int) $datos['edad'] <= 0) {
        return "La edad debe ser un número válido y mayor que 0.";
    }


    return true;

}



