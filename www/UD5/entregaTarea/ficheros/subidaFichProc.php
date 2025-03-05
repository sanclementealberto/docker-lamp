<?php

require_once('../login/sesiones.php');
require_once("../modelo/Fichero.php");
require_once("../modelo/Tarea.php");
$directorioDestino = "files/"; // Carpeta donde se guardarán los archivos --> revisar permisos si da error
$maxFileSize = 20 * 1024 * 1024; // Tamaño máximo del archivo en bytes (20 MB)
$tipoPermitido = ['image/jpeg', 'image/png', 'application/pdf']; //Tipos de ficheros permitidos

$location = '../tareas.php';
$response = 'error';
$messages = array();

$error = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{

    $nombreArchivo = $_POST['nombre'] ?? '';
    $descripcion = $_POST['descripcion'] ?? '';
    $archivo = $_FILES['archivo'] ?? null;
    $id_tarea = $_POST['id_tarea'] ?? '';
    $location = 'subidaFichForm.php?id=' . $id_tarea;

  

    // Validar archivo subido
    if ($archivo['error'] !== UPLOAD_ERR_OK)
    {
        array_push($messages, "Error al subir el archivo.");
        $error = true;
    }

    $errores = Fichero::validarFichero($nombreArchivo, $archivo['type'], $descripcion, $archivo['size']);
   
    if (!empty($errores)) {
        foreach ($errores as $campo => $mensaje) {
            array_push($messages, $mensaje); // Agregar mensaje de error
        }
        $error = true; 
    }
  

   

    $codigoAleatorio = bin2hex(random_bytes(8)); // 16 caracteres alfanuméricos

    $extension = pathinfo($archivo['name'], PATHINFO_EXTENSION);

    $nombreFinal = $codigoAleatorio . '.' . $extension;

    $rutaDestino = $directorioDestino . $nombreFinal;

    if (!is_writable('../' . $directorioDestino))
    {
        array_push($messages, "No hay permisos de escritura en la carpeta destino.");
        $error = true;
    }
    
    // Mover el archivo al directorio de destino
    if (!$error)
    {
        if (move_uploaded_file($archivo['tmp_name'], '../' . $rutaDestino))
        {
            require_once('../modelo/pdo.php');
            $tareaid=new Tarea(null,$id_tarea);
           
            $fichero=new Fichero($tareaid,null,$nombreArchivo,$archivo['type'],$descripcion);
            $resultado = nuevoFichero($fichero);

            if ($resultado[0])
            {
                $response = 'success';
                array_push($messages, 'Archivo subido correctamente.');
                $location = '../tareas/tarea.php?id=' . $id_tarea;
            }
            else
            {
                array_push($messages, 'Ocurrió un error guardando la tarea: ' . $resultado[1] . '.');
            }
        }
        else
        {
            array_push($messages, 'Error al guardar el archivo.');
        }
    }

}
else
{
    array_push($messages, 'Método de solicitud no válido.');
}

$_SESSION['status'] = $response;
$_SESSION['messages'] = $messages;
header("Location: " . $location);