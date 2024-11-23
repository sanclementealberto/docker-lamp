<?php
include_once("./header.php");
$header = headerTienda();
include_once("./footer.php");
$footer = footerTienda();

include_once("../model/ModeloUsuarios.php");
crearTablaUsuarios();

include_once("../view/menu.php");
$menu = menuTienda();

include_once("../view/nuevoUsuarioView.php");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $guardarUsuario = guardarUsuarioBD();
}

include_once("../view/listaUsuariosView.php");
$listaUsuario=listaUsuariosView();

$nuevoUsuario = nuevoUsuarioView();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda De Recambios</title>

    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./style.css">
</head>

<div class=" ">

    <?php echo $header; ?>


    <?php echo $menu; ?>

    <h1 class="container text-center">Bienvenido a la Tienda</h1>

    <div class="container col-4">
        <?php
        // Aquí estamos procesando la respuesta de la función guardarUsuarioBD
        if (isset($guardarUsuario)) {
            // Mostrar el mensaje de éxito o error después del encabezado y menú
            echo $guardarUsuario ? 
                "<div class='alert alert-success'>Usuario guardado con éxito.</div>" : 
                "<div class='alert alert-danger'>Hubo un problema al guardar el usuario.</div>";
        }
        ?>
   
    </div>
    <?php
    // Determinar qué contenido cargar según el parámetro "page"
    $page = $_GET['page'] ?? 'home'; // Si no hay "page", cargar "index.php" por defecto
    
    switch ($page) {
        case 'inicio':
            include_once("./index.php");
            break;
        case 'listaUsuariosView':
            echo $listaUsuario;
            break;
        case 'nuevoUsuarioView':
            echo $nuevoUsuario;
            break;
    
    }
    ?>



    <?php echo $footer; ?>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>