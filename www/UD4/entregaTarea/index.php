<?php
session_start();
include_once("./vista/tema.php");
$clase_tema = cambiarColor();

?>
<!DOCTYPE html>
<!-- bootstrap usa data-bs-theme= dark o light para cambiar el tema-->
<html lang="es" data-bs-theme="<?php echo $clase_tema; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD4. Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

<body>

    <?php include_once('vista/header.php'); ?>

    <div class="container-fluid">
        <div class="row">

            <?php include_once('vista/menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Inicio</h2>
                </div>

                <div class="container justify-content-between">

                    <?php
                    if (isset($_SESSION['usuario'])) {
                        if ($_SESSION['rol'] == 1) {
                            echo "<p>Bienvenido, Administrador, puedes gestionar las tareas y usuarios.</p>";
                        } else {

                            echo "<p>Bienvenido, " . $_SESSION['usuario'] . ". Aquí están tus tareas.</p>";
                        }
                    }



                    ?>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('vista/footer.php'); ?>

</body>

</html>