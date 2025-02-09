<?php

include_once("../vista/tema.php");
$clase_tema = isset($_COOKIE['tema']) && $_COOKIE['tema'] === 'dark' ? 'dark' : 'light';

?>




<!DOCTYPE html>
<html lang="es" data-bs-theme="<?php echo $clase_tema; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD4. Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">



</head>

<body>

    <?php include_once('../vista/header.php'); ?>

    <div class="container-fluid">
        <div class="row">

            <?php include_once('../vista/menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Adjuntar Archivo</h2>
                    <hr class="text-muted">
<!-- enctype="multipart/form-data" es obligatorio para subir archivos  -->
                    <form action="subidaFichProc.php" method="POST" enctype="multipart/form-data" class="mb-5 w-50">

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="nombre" name="nombre"
                                placeholder="Introduce un nombre" required>
                        </div>
                        <?php
                        if(isset($_GET['id'])){
                            $id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
                        }

                        ?>
                        <!-- paso el id de la tarea por campo oculto  --> 
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                       
                        <div class="mb-3">
                            <label for="descripcion" class="form-label">Descripción</label>
                            <textarea type="textarea" class="form-control" id="descripcion"
                                placeholder="Introduce una descripción" name="descripcion" required></textarea>
                        </div>


                        <div class="mb-3">
                            <label for="formFile" class="form-label">Seleccionar archivo</label>
                            <input class="form-control" type="file" id="formFile" name="fichero">
                        </div>
                        <button type="submit" class="btn btn-primary">Subir Archivo</button>
                    </form>

                </div>


            </main>
        </div>
    </div>

    <?php include_once('../vista/footer.php'); ?>

</body>

</html>