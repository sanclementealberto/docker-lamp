<?php
include_once("../view/header.php");
$header = headerDonantes();

include_once("../view/footer.php");
$footer = footerDonantes();

include_once("../view/menu.php");
$menu = menuDonantes();



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DONACIONES</title>
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
                    <h2>Nuevo Donante </h2>
                </div>
                <?php
                    require_once("../validaciones.php");
                    $grupos=listaGrupoSanguineo();
                    $nombre=$_POST['nombre'];
                    $apellidos=$_POST['apellidos'];
                    $edad=$_POST['edad'];
                    $grupo_sanguineo=$_POST['grupo_sanguineo'];
                    $codigo_postal=$_POST['codigo_postal'];
                    $telefono_movil=$_POST['telefono_movil'];
                    $error=false;// si cambia a true no se añade por las validaciones

                    if(!comprobarEdad($edad)){
                        $error=true;
                        echo '<div class="alert alert-danger role="alert">no es mayor de 18</div>';
                    }
                    //compruebo el array con el metodo listagruposanguineo
                    if(!in_array($grupo_sanguineo,$grupos)){
                        $error=true;
                        echo '<div class="alert alert-danger" role="alert">grupo sanguineo incorrecto</div>';
                    }
                    if(!comprobarCodigoPostal($codigo_postal)){
                        $error=true;
                        echo '<div class="alert alert-danger" role="alert">codigo postal son 5 numeros</div>';
                    }
                    if(!comprobarMovil($telefono_movil)){
                        $error=true;
                        echo '<div class="alert alert-danger" role="alert">el movil debe tener 9 digitos</div>';
                    }
                    
                    if(!$error){
                        require_once("../model/mysqli.php");
                        $resultado=registarDonanteMYSQLI(filtrarCampo($nombre),filtrarCampo($apellidos),filtrarCampo($edad),filtrarCampo($grupo_sanguineo),filtrarCampo($codigo_postal),filtrarCampo($telefono_movil));
                       if($resultado[0]===true){
                        echo '<div class="alert alert-danger" role="alert">'.$resultado[1].'</div>';
                    }else{
                        echo '<div class="alert alert-danger" role="alert">'.$resultado[1].'</div>';
                    }
                        
                    }else{
                        echo '<div class="alert alert-danger" role="alert">error al añadir el donante</div>';
                    }

                ?>



            </main>

        </div>

    </div>

    <?php echo $footer; ?>
</body>

</html>