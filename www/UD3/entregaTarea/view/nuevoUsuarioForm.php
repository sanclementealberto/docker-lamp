<?php
include_once("header.php");
$header = headerTareas();

include_once("footer.php");
$footer = footerTareas();

include_once("menu.php");
$menu = menuTarea();



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
                    <h2>Nuevo Usuario</h2>
                    <form action="nuevoUsuario.php" method="post">
                        <div class="mb-3">
                            <label for="usuario"> Usuario</label>
                            <input type="text" class="form-control" name="usuario"" id=" usuario" required>
                        </div>

                        <div class="mb-3">
                            <label for="nombre"> Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" required>
                        </div>

                        <div class="mb-3">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" class="form-control" name="apellidos" id="apellidos" required>
                        </div>
                        <div class="mb-3">
                            <label for="contraseña"> Contraseña</label>
                            <input type="password" class="form-control" name="contrasena" id="contrasena">
                        </div>


                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>

                </div>

            </main>

        </div>

    </div>

    <?php echo $footer; ?>
</body>

</html>