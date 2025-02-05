<?php
include_once("../view/header.php");
$header = headerDonantes();

include_once("../view/footer.php");
$footer = footerDonantes();

include_once("../view/menu.php");
$menu = menuDonantes();



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DONACIONES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php echo $header; ?>

    <div class="container-fluid vh-100">
        <div class="row ">
            <?php echo $menu; ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Nuevo Donante </h2>
                </div>
                <?php
                require_once("../validaciones.php");
                $id_donante = $_POST['id_donante'];
                $nombre = $_POST['nombre_donante'];
                $fecha_donacion = $_POST['fecha_donacion'];
                $fecha_proxima_donacion = comprobarFechaDonacion($fecha_donacion);
                $error = false;// si cambia a true no se añade por las validaciones
                echo $id_donante;
                echo $fecha_donacion;
               
                echo $fecha_proxima_donacion;

                if ($fecha_proxima_donacion === "no pasaron 4 meses") {
                    // Si no han pasado los 4 meses, manejar el error
                    echo '<div class="alert alert-danger" role="alert">No han pasado 4 meses desde la última donación.</div>';
                    $error = true;

                }

                if (!$error) {
                    require_once("../model/mysqli.php");
                    // Registrar la donación, pasando las fechas correctamente
                    $resultado = registrarDonacion($id_donante, $fecha_donacion, $fecha_proxima_donacion);

                    // Verificamos si $resultado es un array
                    if (is_array($resultado)) {
                        // Comprobamos si la inserción fue exitosa
                        if ($resultado[0] === true) {
                            echo '<div class="alert alert-success" role="alert">' . $resultado[1] . '</div>';
                        } else {
                            echo '<div class="alert alert-danger" role="alert">' . $resultado[1] . '</div>';
                        }
                    } else {
                        echo '<div class="alert alert-danger" role="alert">' . $resultado[1] . '</div>';
                    }

                } else {
                    echo '<div class="alert alert-danger" role="alert">error al añadir el donacion</div>';
                }

                ?>



            </main>

        </div>

    </div>

    <?php echo $footer; ?>
</body>

</html>