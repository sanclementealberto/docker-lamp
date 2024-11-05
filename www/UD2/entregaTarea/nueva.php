<?php
include './utils.php';
//me da un warning:cannot modify header information
$mensaje = obtenerDatosForm(); ?>
?>
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


    function obtenerDatosForm(): bool|null
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $descripcion = trim($_POST['descripcion']);
            $estado = trim($_POST['estado']);

            if (!empty($descripcion) && !empty($estado)) {
                $resultado = guardarTarea($descripcion, $estado);

                return $resultado ? true : false;
            }
        }
        return null;
    }

    function mostrarMensaje($mensaje)
    {
        if ($mensaje === true) {
            return '<div class="alert alert-success" role="alert"> La tarea se ha guardado correctamente.</div>';
        } elseif ($mensaje === false) {
            return '<div class="alert alert-danger" role="alert"> Error al guardar la tarea. Verifique los datos.</div>';
        }
    }

    ?>

    <?php include("./header.php");
    HeaderUD2(); ?>

    <
        <div class="container-fluid">
        <div class="row">
            <?php include './menu.php';
            menuUD2(); ?>
            <div class="col-5 mt-5">
                <?php echo mostrarMensaje($mensaje);
                echo "<script>console.log(" . json_encode($tareas) . ");</script>"; ?>
            </div>
        </div>

        </div>


        <?php include("./footer.php");
        footerUD2(); ?>
</body>

</html>