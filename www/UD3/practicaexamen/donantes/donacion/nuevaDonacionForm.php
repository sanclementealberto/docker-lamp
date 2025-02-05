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
                    <h2>Formulario Donacion </h2>
                </div>

                <form action="nuevaDonacion.php" method="post">
                    <?php
                    include_once("../model/mysqli.php");
                    $id_donante = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
                    
                    $nombre = obtenerNombreDonante($id_donante);
                    echo $nombre[1];

                   

                    ?>

                    <input type="hidden" name="id_donante" value="<?php echo htmlspecialchars($id_donante) ?>">
                    <div class="mb-3">
                        <label for="nombre_donante"> Donante</label>
                        <input type="text" class="form-control" name="nombre_donante" id="nombre_donante"
                            value="<?php echo isset($nombre[1]) ? htmlspecialchars($nombre[1]) : ''; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="fecha_donacion"> Fecha Donacion</label>
                        <input type="date" class="form-control" name="fecha_donacion" id="fecha_donacion" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar Donacion</button>
                </form>
        </div>



        </form>
        </main>

    </div>

    </div>

    <?php echo $footer; ?>
</body>

</html>