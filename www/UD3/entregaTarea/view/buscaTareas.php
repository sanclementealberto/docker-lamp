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
                    <h2>Buscar Tareas</h2>


                    <form action="tareas.php" method="post">

                        <?php
                        require_once("../model/mysqli.php");
                        $resultado = listarTareasMYSQLI();
                        //verifico si el 1 parametro devuelve true
                        if ($resultado[0] === true) {
                            //guardo la lista que es el 2 parametro
                            $usuarios = $resultado[1];
                            //la recorro co nel foreach
                            foreach ($usuarios as $usuario) {
                                //tengo que poner en el value el id para pasarlo para poder actualizar en la tabla
                                echo '<option value="' . htmlspecialchars($usuario['id']) . '">' . htmlspecialchars($usuario['username']) . '</option>';
                            }
                        } else {
                            echo '<option value="" disabled>No hay usuarios disponibles</option>';
                        }

                        ?>
                       
                        <?php
                        include_once("../model/pdo.php");
                        $resultado = listaUsuariosPDO();
                        //verifico si el 1 parametro devuelve true
                        if ($resultado[0] === true) {
                            //guardo la lista que es el 2 parametro
                            $usuarios = $resultado[1];
                            //la recorro co nel foreach
                            foreach ($usuarios as $usuario) {
                                //tengo que poner en el value el id para pasarlo para poder actualizar en la tabla
                                echo '<option value="' . htmlspecialchars($usuario['id']) . '">' . htmlspecialchars($usuario['username']) . '</option>';
                            }
                        } else {
                            echo '<option value="" disabled>No hay usuarios disponibles</option>';
                        }

                        ?>
                        </select>

                        <button class="btn btn-primary mb-3" type="submit" name="editar_tarea">Guardar cambios</button>
                    </form>







                </div>



            </main>

        </div>

    </div>

    <?php echo $footer; ?>
</body>

</html>