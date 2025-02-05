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
                    <h2>Lista Donante </h2>
                </div>
                <table class="table table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido</th>
                            <th>Edad</th>
                            <th>Grupo Sanguineo</th>
                            <th>Fecha Donacion</th>

                        </tr>

                    </thead>
                    <tbody>

                        <?php
                        include_once("../model/mysqli.php");
                        $resultado = listaDonacionesMYSQLI();

                        if ($resultado[0] == true) {
                            foreach ($resultado[1] as $donacion) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($donacion['nombre']) . '</td>';
                                echo '<td>' . htmlspecialchars($donacion['apellidos']) . '</td>';
                                echo '<td>' . htmlspecialchars($donacion['edad']) . '</td>';
                                echo '<td>' . htmlspecialchars($donacion['grupo_sanguineo']) . '</td>';
                                echo '<td>' . htmlspecialchars($donacion['fecha_donacion']) . '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr>';
                            echo '<td colspan="5" class="text-center">No se encontraron donaciones</td>';
                            echo '</tr>';
                        }

                        ?>


                    </tbody>




                </table>

            </main>

        </div>

    </div>

    <?php echo $footer; ?>
</body>

</html>