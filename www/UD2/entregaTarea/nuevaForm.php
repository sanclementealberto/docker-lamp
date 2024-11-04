<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD2. nuev</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
</head>

<body>
    <!-- Header -->
    <?php include './header.php';
    HeaderUD2(); ?>

    <div class="container-fluid">
        <div class="row">
            <?php include './menu.php';
            menuUD2(); ?>
            <div class="col-10 ">
                <h2 class="text-center "> Nueva Tarea </h2>
                <?php
                include './nueva.php';
                $mensaje = obtenerDatosForm();
                if ($mensaje) {
                    echo $mensaje;
                }
                ?>
                <form action="nueva.php" class="mb-5" method="POST">

                    <div class="mb-3">

                        <label for="descripcion" class="form-label">descripcion</label>
                        <input class="form-control" placeholder="descripcion" aria-describedby="campo descripcion" name="descripcion" required>
                    </div>
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado de la tarea</label>
                        <select class="form-select" aria-describedby="estado de la tarea" name="estado" required>

                            <option value="" disabled selected>Elige una estado</option>
                            <option value="0" aria-describedby="pendiente"> pendiente </option>
                            <option value="1" aria-describedby="proceso"> proceso </option>
                            <option value="2" aria-describedby="completada"> completada </option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Enviar</button>


                </form>
            </div>
        </div>
    </div>
    <!-- footer -->

    <?php include './footer.php';
    footerUD2(); ?>
</body>

</html>