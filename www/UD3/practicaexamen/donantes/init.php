<?php
include_once("./view/header.php");
$header = headerDonantes();

include_once("./view/footer.php");
$footer = footerDonantes();

include_once("./view/menu.php");
$menu = menuDonantes();

include_once("./model/mysqli.php");
$conexiondb=conexionDonantesMYSQL();
$tabla_donantes=crearTablaDonantesMYSQLI();
$tabla_donaciones=crearTablaDonacionesMYSQLI();
$tabla_administradores=crearTablaAdministradoresMYSQLI();


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donaciones</title>
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
                    <h2>Init Donacion</h2>
                </div>

                <div class="container justify-content-between">
                    <?php
                        if($conexiondb){
                            echo '<div class="alert alert-success" role="alert"> Conexion db realizada con exito </div>';
                        }
                        else{
                            echo '<div class="alert alert-warning" role="alert">Fallo en la conexion bd</div>';
                        }

                       


                        if($tabla_donantes[0])
                        {
                             echo '<div class="alert alert-success" role="alert">'. $tabla_donantes[1].'</div>';   
                        }
                        else{
                            echo '<div class="alert alert-warning" role="alert">'.$tabla_donantes[1].'</div>';
                        }
                        
                        if($tabla_donaciones[0]){
                            echo '<div class="alert alert-success" role="alert">'.$tabla_donaciones[1].'</div>';
                        }else{
                            echo '<div class="alert alert-warning" role="alert">'.$tabla_donaciones[1].'</div>';
                        }
                        

                        if($tabla_administradores[0]){
                            echo '<div class="alert alert-success" role="alert">'.$tabla_administradores[1].'</div>';
                        }else{
                            echo '<div class="alert alert-warning" role="alert">'.$tabla_administradores[1].'</div>';
                        }
                    ?>



            </main>

        </div>

    </div>

    <?php echo $footer; ?>
</body>

</html>