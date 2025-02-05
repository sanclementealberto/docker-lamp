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
              <?php
              require_once("../model/mysqli.php");
              if(!empty($_GET)){
                $id=$_GET['id'];
                $resultado=borrarTareaMYSQLI($id);


                if(!empty($id) && $resultado[0]){
                    echo '<div class="alert alert-success" role="alert">tarea borrado con exito.</div>';

                }
                else{
                    echo   '<div class="alert alert-danger" role="alert">fallo al borrar tarea</div>';
                }

              }else{
            
              echo '<div class="alert alert-danger" role="alert">No se paso un id de ese tarea</div>';

            }

                ?>


            </main>
        </div>
    </div>
    <?php echo $footer; ?>
</body>

</html>