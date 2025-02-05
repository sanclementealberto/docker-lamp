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
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Edad</th>
                            <th>Grupo Sanguineo</th>
                            <th>Codigo Postal</th>
                            <th>Fecha Proxima Donacion</th>

                        </tr>


                    </thead>
                    <tbody>

                        <?php
                        include_once("../validaciones.php");
                        $grupos = listaGrupoSanguineo();
                        $gruposanguineo="";
                        $codigo_postal = $_POST['codigo_postal'];
                        if (!empty($_POST['grupo_sanguineo'])) {
                            $gruposanguineo = $_POST['grupo_sanguineo'];
                        }
                        $error = false;
                        echo $codigo_postal;
                        echo $gruposanguineo;

                        if (!comprobarCodigoPostal($codigo_postal)) {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert"> el codigo postal son 5 </div>';
                        }

                        if (!empty($gruposanguineo)) {
                            if (!in_array($gruposanguineo, $grupos)) {
                                $error = true;
                                echo '<div class="alert alert-danger" role="alert">grupo sanguineo incorrecto</div>';
                            }
                        }

                        if (!$error) {
                            include_once("../model/mysqli.php");
                            $resultado = buscarDonantesMYSQLI(filtrarCampo($codigo_postal), filtrarCampo($gruposanguineo));
                            if ($resultado[0] === true) {

                                foreach ($resultado[1] as $donante) {
                                    echo "<tr>";
                                    echo '<td>' . htmlspecialchars(isset($donante['nombre']) ? $donante['nombre'] : '') . '</td>';
                                    echo '<td>' . htmlspecialchars(isset($donante['apellidos']) ? $donante['apellidos'] : '') . '</td>';
                                    echo '<td>' . htmlspecialchars(isset($donante['edad']) ? $donante['edad'] : '') . '</td>';
                                    echo '<td>' . htmlspecialchars(isset($donante['grupo_sanguineo']) ? $donante['grupo_sanguineo'] : '') . '</td>';
                                    echo '<td>' . htmlspecialchars(isset($donante['codigo_postal']) ? $donante['codigo_postal'] : '') . '</td>';
                                    echo '<td>' . htmlspecialchars(isset($donante['fecha_proxima_donacion']) ? $donante['fecha_proxima_donacion'] : '') . '</td>';
                                    echo "</tr>";
                                }


                            } else {
                                echo '<tr>';
                                echo '<td colspan="6" class="text-center">NO HAY DONANTES DISPONIBLES</td>';
                                echo '</tr>';
                            }
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