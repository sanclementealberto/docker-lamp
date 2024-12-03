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
                    <h2>Edita Tarea</h2>


                    <form action="editaTarea.php" method="post">

                        <?php
                        require_once("../model/mysqli.php");
                        //obtengo el id que le mando a traves del button de editar
                        if (!empty($_GET)) {
                            $id = $_GET['id'];
                            $resultado = buscarTareaPorId($id);
                            //devuelve true resultado [0]
                            if (!empty($id) && $resultado[0]) {
                                $tarea = $resultado[1];
                                $titulo = $tarea['titulo'];
                                $descripcion = $tarea['descripcion'];
                                $estado = $tarea['estado'];
                                $id_usuario = $tarea['id_usuario'];




                            }
                        }


                        ?>
                        <!--el id lo envio en oculto para poder hacer la consutlas -->
                        <input type="hidden" name="id" value="<?php echo htmlspecialchars($tarea['id']); ?>" />
                        <div class="mb-3">
                            <label for="titulo">Título</label>
                            <input class="form-control" type="text" name="titulo" id="titulo"
                                value="<?php echo htmlspecialchars($titulo); ?>" required />
                        </div>
                        <div class="mb-3">

                            <label for="descripcion">Descripción</label>
                            <input class="form-control" name="descripcion" value="<?php echo htmlspecialchars($tarea['descripcion']); ?>"id="descripcion" required>
                        </div>
                        <div class="mb-3">

                            <label for="estado">Estado</label>
                            <input class="form-control" type="text" name="estado" id="estado"
                                value="<?php echo htmlspecialchars($estado); ?>" required />
                        </div>
                        <div class="mb-3">

                            <label for="id_usuario">Usuario</label>
                            <select class="form-control mb-3" name="id_usuario" id="id_usuario" required>
                        </div>

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