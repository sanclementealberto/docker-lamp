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
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $usuario = $_POST['usuario'];
                    $nombre = $_POST['nombre'];
                    $apellidos = $_POST['apellidos'];
                    $contrasena = $_POST['contrasena'];
                    require_once('validarCampos.php');
                    $error = false;
                    
                    if (!validarCampoTexto($usuario))
                    {
                        $error = true;
                        echo '<div class="alert alert-danger" role="alert">El campo usuario es obligatorio y debe contener al menos 5 caracteres.</div>';
                    }
                
                    if (!validarCampoTexto($nombre))
                    {
                        $error = true;
                        echo '<div class="alert alert-danger" role="alert">El campo nombre es obligatorio y debe contener al menos 5 caracteres.</div>';
                    }

                    if (!validarCampoTexto($apellidos))
                    {
                        $error = true;
                        echo '<div class="alert alert-danger" role="alert">El campo apellidos es obligatorio y debe contener al menos 5 caracteres.</div>';
                    }
                 
                
                    if (!validarCampoTexto($contrasena))
                    {
                        $error = true;
                        echo '<div class="alert alert-danger" role="alert">El campo contraseña es obligatorio y debe contener al menos 3 caracteres</div>';
                    }

                    if (!$error)
                    {
                        require_once('../model/pdo.php');
                        $resultado = nuevoUsuarioPDO(filtraCampo($usuario), filtraCampo($nombre), filtraCampo($apellidos), filtraCampo($contrasena));
                        if ($resultado[0]===true)
                        {
                            echo '<div class="alert alert-success" role="alert">Usuario guardado correctamente.</div>';
                        }
                        else
                        {
                            echo '<div class="alert alert-danger" role="alert">Ocurrió un error guardando el usuario: ' . $resultado[1] . '</div>';
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