<?php

include_once("../vista/tema.php");
$clase_tema = isset($_COOKIE['tema']) && $_COOKIE['tema'] === 'dark' ? 'dark' : 'light';

?>




<!DOCTYPE html>
<html lang="es" data-bs-theme="<?php echo $clase_tema; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD4. Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">



</head>

<body>

    <?php include_once('../vista/header.php'); ?>

    <div class="container-fluid">
        <div class="row">

            <?php include_once('../vista/menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Tarea</h2>
                </div>

                <div class="container justify-content-between mb-5">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Detalles
                        </div>
                        <div class="card-body">
                            <?php
                            require_once('../modelo/mysqli.php');
                            require_once("../modelo/pdo.php");
                            if (!empty($_GET)) {
                                $id = $_GET['id'];
                                $tarea = buscaTarea($id);

                                if (!empty($id) && $tarea) {
                                    $titulo = $tarea['titulo'];
                                    $descripcion = $tarea['descripcion'];
                                    $estado = $tarea['estado'];
                                    $id_usuario = $tarea['id_usuario'];

                                    $usuario = buscaUsuario($id_usuario);
                                    $nombreusuario = $usuario['nombre'];
                                }


                            }
                            ?>

                            
                            <p><strong>Título:</strong><?php echo htmlspecialchars($titulo) ?></p>
                            <p><strong>Descripción:</strong> <?php echo htmlspecialchars($descripcion) ?></p>
                            <p><strong>Estado:</strong> <?php echo htmlspecialchars($estado) ?></p>
                            <p><strong>Usuario:</strong> <?php echo htmlspecialchars($nombreusuario) ?></p>
                        </div>
                    </div>
                    <div class="card mt-3">
                        <div class="card-header bg-secondary text-white">
                            Archivos Adjuntos
                        </div>
                        <div class="card-body text-center">
                            <a href="subidaFichForm.php?id=<?php echo htmlspecialchars($id); ?>" class="btn btn-outline-secondary btn-lg d-flex flex-column align-items-center p-4"
                                style="width: 250px; height: 120px; border-radius: 10px;">
                                <i class="bi bi-cloud-plus fs-2"></i>
                                <span class="mt-2">Añadir nuevo archivo</span>
                            </a>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <?php include_once('../vista/footer.php'); ?>

</body>

</html>