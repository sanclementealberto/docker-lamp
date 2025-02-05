<?php
include_once("../view/header.php");
$header = headerTareas();

include_once("../view/footer.php");
$footer = footerTareas();

include_once("../view/menu.php");
$menu = menuTarea();

include("../model/mysqli.php");

$tablaTareas = crearTablaTareas();

include("../model/pdo.php");
$tablaUsuarios = crearTablaUsuario();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TareaUD3</title>
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
                    <div class="alert">
                        <?php
                        try {
                            $conexion = conexionMYSQLI();
                            
                            
                            echo "<div class='alert alert-success'>Conexión realizada y base de datos creada correctamente.</div>";
                        } catch (mysqli_sql_exception $e) {
                            // Error en la conexión o creación de la base de datos
                            echo "<div class='alert alert-danger'>Error: " . $e->getMessage() . "</div>";
                        }
                        ?>


                        <?php
                        if ($tablaUsuarios[0] === true) {
                            echo "<div class='alert alert-danger'>" . $tablaUsuarios[1] . "</div>";
                        } else {
                            // Conexión exitosa y/o base de datos creada
                            echo "<div class='alert alert-success'>" . $tablaUsuarios[1] . "</div>";
                        }

                        ?>
                        <?php
                        if ($tablaTareas[0] === true) {
                            echo "<div class='alert alert-success'> $tablaTareas[1]</div>";
                        } else {
                            // Conexión exitosa y/o base de datos creada
                            echo "<div class='alert alert-danger'>" . $tablaTareas[1] . "</div>";
                        }

                        ?>

                    </div>


                </div>



            </main>

        </div>

    </div>

    <?php echo $footer; ?>
</body>

</html>