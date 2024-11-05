<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>


    <?php
    include './utils.php';

    $mensaje = obtenerDatosForm();
    

    function obtenerDatosForm(): bool|null
    {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $descripcion = trim($_POST['descripcion']);
    $estado = trim($_POST['estado']);

    if (!empty($descripcion) && !empty($estado)) {
    $resultado = guardarTarea($descripcion, $estado);

    return $resultado ? !empty($resultado) : empty($resultado);
    }
    }
    return null;
    }

    function mostrarMensaje($mensaje)
    {
    if (!empty($mensaje)) {
    return '<div class="alert alert-success" role="alert"> La tarea se ha guardado correctamente.</div>';
    } elseif (empty($mensaje)) {
    return '<div class="alert alert-danger" role="alert"> Error al guardar la tarea. Verifique los datos.</div>';
    }
    }
  
    ?>

    <div class="container mt-4">
        <?php echo mostrarMensaje($mensaje); ?>

    </div>

</body>

</html>