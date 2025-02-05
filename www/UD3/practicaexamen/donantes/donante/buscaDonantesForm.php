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
                    <h2>Busca Donante </h2>
                </div>
                <form action="buscaDonantes.php" method="post">
                  
                    <div class="mb-3">
                        <label for="codigo_postal"> Codigo Postal</label>
                        <input type="text" class="form-control" name="codigo_postal" id="codigo_postal" required>
                    </div>
                    <div class="mb-3">
                        <label for="grupo_sanguino" class="form-label"> Grupo sanguineo</label>
                        <select name="grupo_sanguineo" class="form-select" id="grupo_sanguineo" >
                                <option selected disabled  value=""> Selecciona un grupo sanguineo</option>
                                         <?php
                                         require_once("../validaciones.php");
                                         $grupos=listaGrupoSanguineo();
                                         foreach($grupos as $grupo)
                                         {
                                            echo '<option value="'.$grupo.'">'.$grupo.'</option>';
                                         }
                                         
                                         ?>

                        </select>
                    </div>


                    <button type="submit" class="btn btn-primary">Buscar Donante</button>
                </form>
            </main>

        </div>

    </div>

    <?php echo $footer; ?>
</body>

</html>