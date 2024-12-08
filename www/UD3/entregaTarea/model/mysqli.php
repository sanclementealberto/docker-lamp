<?php
// BD tareasud3


function conexionMYSQLI()
{

    try {
        $conexion = new mysqli("db", "root", "test");

        if ($conexion->connect_error) {
            throw new Exception("Conexión fallida: " . $conexion->connect_error);
        }
        //creo la db
        $sqldatabase = "CREATE DATABASE IF NOT EXISTS tareas";
        if ($conexion->query($sqldatabase)) {
            return $conexion;
        } else {
            throw new Exception("error al crear la bd");
        }


    } catch (mysqli_sql_exception $e) {
        throw new Exception($e->getMessage());

    }
}

function crearTablaTareas()
{

    try {
        //tabla tareas
        $tablaTareas = 'CREATE TABLE IF NOT EXISTS tareas(
        id INT AUTO_INCREMENT PRIMARY KEY,
        titulo VARCHAR(30) NOT NULL,
        descripcion VARCHAR(250) NOT NULL,
        estado VARCHAR(250) NOT NULL,
        id_usuario INT,
        FOREIGN KEY (id_usuario) REFERENCES usuarios(id)
        )';

        $conexion = conexionMYSQLI();

     
        $conexion = new mysqli("db", "root", "test", "tareas");

        if ($conexion->query($tablaTareas)) {
            return [true, "tabla tareas mysqli creada correctamente "];
        } else {
            return [false, "Error al crear la tabla tareas: " . $conexion->error];
        }


    } catch (mysqli_sql_exception $e) {
        return [false, $e->getMessage()];

    } finally {
        cerrarConexionMYSQLI($conexion);
    }

}




function NuevaTareaMYSQLI($titulo, $descripcion, $estado, $idusuario)
{

    try {
        $conexion = conexionMYSQLI();
        //seleciono bd
        $conexion = new mysqli("db", "root", "test", "tareas");

        $sqlNuevaTarea = $conexion->prepare("INSERT INTO tareas (titulo,descripcion,estado,id_usuario)
        VALUEs(?,?,?,?)");

        if (!$sqlNuevaTarea) {
            throw new mysqli_sql_exception("Error en la  consulta: " . $conexion->error);
        }


        if (!is_numeric($idusuario) || $idusuario <= 0) {
            return [false, "ID de usuario no válido"];
        }






        $sqlNuevaTarea->bind_param('sssi', $titulo, $descripcion, $estado, $idusuario);
        $sqlNuevaTarea->execute();


        if ($sqlNuevaTarea->affected_rows > 0) {
            return [true, "Tarea creada "];
        } else {
            return [false, "error al crear la tarea "];
        }

    } catch (mysqli_sql_exception $e) {
        return [false, $e->getMessage()];
    } finally {
        cerrarConexionMYSQLI($conexion);
    }



}
function buscarTareaPorId($id) {
    try {
        $conexion = conexionMYSQLI();
        $conexion->select_db('tareas');
        $sql = $conexion->prepare("SELECT t.id, t.titulo, t.descripcion, t.estado, t.id_usuario, u.username
                                   FROM tareas t
                                   JOIN usuarios u ON t.id_usuario = u.id
                                   WHERE t.id = ?");
        $sql->bind_param('i', $id);
        $sql->execute();
        $resultado = $sql->get_result();
        $tarea = $resultado->fetch_assoc();

        if ($tarea) {
            return [true, $tarea];
        } else {
            return [false, "Tarea no encontrada"];
        }
    } catch (mysqli_sql_exception $e) {
        return [false, "Error de MySQL: " . $e->getMessage()];
    } finally {
        cerrarConexionMYSQLI($conexion);
    }
}
function buscarIdUsuarioMYSQLI($username)
{
    try {

        $conexion = conexionMYSQLI();
        // Selecciono la base de datos
        $conexion->select_db('tareas');


        $sqlObtenerUsuario = $conexion->prepare("SELECT id FROM usuarios WHERE username = ?");
        if (!$sqlObtenerUsuario) {
            throw new mysqli_sql_exception("Error en la preparación de la consulta: " . $conexion->error);
        }

        // Asigna el parámetro y ejecuta la consulta
        $sqlObtenerUsuario->bind_param('s', $username);
        $sqlObtenerUsuario->execute();

        // Obtiene el resultado de la consulta
        $resultado = $sqlObtenerUsuario->get_result();
        
        $usuario = $resultado->fetch_assoc();
       
       


        if ($usuario) {
            return [true, $usuario['id']];
        } else {
            return [false, "Usuario no encontrado: $username"];
        }
    } catch (mysqli_sql_exception $e) {
        return [false, "Error de MySQL: "];
    } finally {
        cerrarConexionMYSQLI($conexion);
    }
}


function listarTareasMYSQLI()
{

    try {
        $conexion = conexionMYSQLI();
        $conexion->select_db("tareas");

        $sqlListaTareas = "SELECT t.id,t.titulo,t.descripcion,t.estado,u.username 
        FROM tareas t
        INNER JOIN usuarios u ON t.id_usuario=u.id";

        $listaTareas = $conexion->query($sqlListaTareas);

        //compruuebo si me devuelve 1 linea o mas
        if ($listaTareas->num_rows > 0) {

            return [true, $listaTareas->fetch_all(MYSQLI_ASSOC)];
        } else {
            return [false, "No hay tareas disponibles."];
        }


    } catch (mysqli_sql_exception $e) {
        return [false, "error lista tareas conexion "];

    } finally {
        cerrarConexionMYSQLI($conexion);
    }


}

function listarTareasMYSQLIId($id)
{

    try {
        $conexion = conexionMYSQLI();
        $conexion->select_db("tareas");

        $sqlListaTareas = "SELECT t.id,t.titulo,t.descripcion,t.estado,u.username 
        FROM tareas t
        INNER JOIN usuarios u ON t.id_usuario=u.id";

        $listaTareas = $conexion->query($sqlListaTareas);

        //compruuebo si me devuelve 1 linea o mas
        if ($listaTareas->num_rows > 0) {

            return [true, $listaTareas->fetch_all(MYSQLI_ASSOC)];
        } else {
            return [false, "No hay tareas disponibles."];
        }


    } catch (mysqli_sql_exception $e) {
        return [false, "error lista tareas conexion "];

    } finally {
        cerrarConexionMYSQLI($conexion);
    }


}



function editarTareaMYSQLI($id, $titulo, $descripcion, $estado, $id_usuario)
{
    try {
        $conexion = conexionMYSQLI();
        $conexion->select_db("tareas");
        if (!$conexion) {
            return [false, "fallo en la conexion bd"];

        }
        //consulta con valores set ?
        $sqlEditaTarea = $conexion->prepare("UPDATE tareas t SET
        titulo=?,
        descripcion=?,
        estado=?,
        id_usuario=?
        WHERE id=?

        ");

        if (!$sqlEditaTarea) {
            return [false, "Error al preparar la consulta: " . $conexion->error];
        }
        $sqlEditaTarea->bind_param("sssii",$titulo,$descripcion,$estado,$id_usuario,$id);

        if ($sqlEditaTarea->execute()) {
            return [true, "Tarea actualizada correctamente"];
        } else {
            return [false, "Error al actualizar la tarea"];
        }

    } catch (mysqli_sql_exception $e) {
        return [false, $e->getMessage()];

    } finally {
        cerrarConexionMYSQLI($conexion);
    }
}


//
function buscarTareaMYSQL($id)
{
    try {
        $conexion = conexionMYSQLI();
        $conexion->select_db("tareas");
        if(!$conexion){
            return [false,"fallo al conectar a la bd"];
        }
        $sqlBuscaUsuario=$conexion->prepare("SELECT t.id,t.titulo,t.descripcion,t.id_usuario,u.username
        FROM tareas t
        INNER JOIN usuarios u ON t.id_usuario=u.id 
        where t.id=? ");
        
        $sqlBuscaUsuario->bind_param("i",$id);

        $sqlBuscaUsuario->execute();


        $resultado=$sqlBuscaUsuario->get_result();
        $tarea=$resultado->fetch_assoc();

        if ($tarea) {
            return [true, $tarea];
        } else {
            return [false, "Tarea no encontrada"];
        }




    } catch (mysqli_sql_exception $e) {
        return [false, $e->getMessage()];
    } finally {
        cerrarConexionMYSQLI($conexion);
    }
}


function borrarTareaMYSQLI($id)
{
    try {
        $conexion = conexionMYSQLI();
        if (!$conexion) {
            return [false, "fallo al conectar a la bd"];

        }

        $conexion->select_db("tareas");
        $sqlBorrarTarea = $conexion->prepare("DELETE FROM tareas where id= ?");
        $sqlBorrarTarea->bind_param("i", $id);

        if ($sqlBorrarTarea->execute()) {
            return [true, " tarea borrado"];

        } else {
            return [false, "error al eliminar tarea"];
        }


    } catch (mysqli_sql_exception $e) {

        return [false, $e->getMessage()];
    } finally {
        cerrarConexionMYSQLI($conexion);

    }
}




function cerrarConexionMYSQLI($conexion)
{

    if ($conexion instanceof mysqli && $conexion->connect_errno === 0) {
        $conexion->close();
        return [true, "conexion cerrada"];
    }
    return [false, "no se pudo cerrar la conexion"];
}