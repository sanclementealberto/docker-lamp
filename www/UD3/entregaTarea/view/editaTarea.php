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

                    <?php
                    require_once("../model/mysqli.php");
                    //compruebo si no estan vacios los datos del post
                    if (!empty($_POST)) {
                        $id = $_POST['id'];
                        $titulo = $_POST['titulo'];
                        $descripcion = $_POST['descripcion'];
                        $estado = $_POST['estado'];
                        $id_usuario = $_POST['id_usuario'];
                     //   echo "$id_usuario";
                        require_once("./validarCampos.php");
                        $error = false;
                        if (!validarCampoTexto($titulo)) {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">El campo titulo es obligatorio y debe contener al menos 5 caracteres.</div>';
                        }
                        if (!validarCampoTexto($descripcion)) {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">El campo descripcion es obligatorio y debe contener al menos 5 caracteres.</div>';
                        }
                        if (!validarCampoTexto($estado)) {
                            $error = true;
                            echo '<div class="alert alert-danger" role="alert">El campo estado es obligatorio y debe contener al menos 5 caracteres.</div>';
                        }


                        if (!$error) {
                            require_once("../model/mysqli.php");
                            $resultado = editarTareaMYSQLI($id, $titulo, $descripcion, $estado, $id_usuario);
        
                            if ($resultado[0]) {
                                echo '<div class="alert alert-success" role="alert">tarea actualizado correctamente.</div>';
                            } else {
                                echo '<div class="alert alert-danger" role="alert">error actualizando la tarea: ' . $resultado[1] . '</div>';
                            }




                        } else {


                            echo '<div class="alert alert-danger" role="alert">fallo al actualiza el   tarea.</div>';

                        }


                    }


                    ?>
                </div>
            </main>

        </div>

    </div>

    <?php echo $footer; ?>
</body>

</html>