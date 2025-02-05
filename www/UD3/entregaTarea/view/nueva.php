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
                    <h2>Tarea guardada</h2>
                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $titulo = $_POST['titulo'];
                    $descripcion = $_POST['descripcion'];
                    $estado = $_POST['estado'];
                    $usuario = $_POST['usuario'];
                    require_once('validarCampos.php');
                    $error = false;
                    
                    if (!validarCampoTexto($titulo))
                    {
                        $error = true;
                        echo '<div class="alert alert-danger" role="alert">El campo titulo es obligatorio y debe contener al menos 5 caracteres.</div>';
                    }
                
                    if (!validarCampoTexto($descripcion))
                    {
                        $error = true;
                        echo '<div class="alert alert-danger" role="alert">El campo descripcion es obligatorio y debe contener al menos 5 caracteres.</div>';
                    }

                    if (!validarCampoTexto($estado))
                    {
                        $error = true;
                        echo '<div class="alert alert-danger" role="alert">El campo estado es obligatorio y debe contener al menos 5 caracteres.</div>';
                    }
                 
                   

                    if (!validarCampoTexto($usuario)) {
                        $error = true;
                        echo '<div class="alert alert-danger" role="alert">El campo usuario es obligatorio y debe contener al menos 5 caracteres.</div>';
                    }
                    if (!$error)
                    {
                        require_once('../model/mysqli.php');
                        //obtengo el id del usuario mediante el nombre
                        $resultadoUsuario = buscarIdUsuarioMYSQLI(filtraCampo($usuario));
        
                        if ($resultadoUsuario[0] === true) {
                            //usuario id
                            $idusuario = $resultadoUsuario[1];
                        //    echo "$idusuario";
                            
                            // Crear la tarea
                            $resultado = NuevaTareaMYSQLI(filtraCampo($titulo), filtraCampo($descripcion), filtraCampo($estado), $idusuario);
                
                            if ($resultado[0] === true) {
                                echo '<div class="alert alert-success" role="alert">Tarea guardada correctamente.</div>';
                            } else {
                                echo '<div class="alert alert-danger" role="alert">Ocurrió un error guardando la tarea: ' . $resultado[1] . '</div>';
                            }
                        } else {
                            // El usuario no fue encontrado
                            echo '<div class="alert alert-danger" role="alert">' . $resultadoUsuario[1] . '</div>';
                        }
                    }
                }
                    ?>

                </div>

                </div>



            </main>

        </div>

    </div>

    <?php echo $footer; ?>
</body>

</html>