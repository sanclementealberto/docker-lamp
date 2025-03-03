<?php
    require_once('../login/sesiones.php');
    
    // Función para determinar el tipo de archivo y devolver el icono correspondiente
    function getFileIcon($filename) {
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    
        // Mapear extensiones a tipos de archivos
        $fileTypeIcons = [
            'pdf' => 'bi-file-earmark-pdf text-danger', // Icono para PDF
            'jpg' => 'bi-file-earmark-image text-primary', // Icono para imágenes
            'jpeg' => 'bi-file-earmark-image text-primary',
            'png' => 'bi-file-earmark-image text-primary',
        ];
    
        // Devolver el icono correspondiente o un icono genérico
        return $fileTypeIcons[$extension] ?? 'bi-file-earmark text-secondary';
    }
    

?>
    <?php include_once('../vista/header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            
            <?php include_once('../vista/menu.php'); ?>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Tarea</h2>
                    <?php include_once ('../vista/erroresSession.php'); ?>
                </div>

                <div class="container justify-content-between">
                <?php
                require_once('../modelo/mysqli.php');
                if (!empty($_GET))
                {
                    $id = $_GET['id'];
                    if (!empty($id)) {
                        if (checkAdmin() || esPropietarioTarea($_SESSION['usuario']['id'], $id))
                        {
                            $tarea = buscaTarea($id);
                            $usuario = buscaUsuarioMysqli($tarea['id_usuario']);
                            if ($tarea)
                            {
                                $titulo = $tarea['titulo'];
                                $descripcion = $tarea['descripcion'];
                                $estado = $tarea['estado'];
                                $id_usuario = $tarea['id_usuario'];

                                require_once('../modelo/pdo.php');
                                $ficheros = listaFicheros($id);
                            ?>

                            <div class="container my-4">
                                <!-- Información principal -->
                                <div class="card">
                                    <div class="card-header bg-primary text-white">
                                        <h5 class="mb-0">Detalles</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-3">
                                                <strong>Titulo:</strong>
                                            </div>
                                            <div class="col-md-9">
                                                <p class="mb-0"><?php echo $tarea['titulo']; ?></p>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3">
                                                <strong>Descripción:</strong>
                                            </div>
                                            <div class="col-md-9">
                                                <p class="mb-0"><?php echo $tarea['descripcion']; ?></p>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3">
                                                <strong>Estado:</strong>
                                            </div>
                                            <div class="col-md-9">
                                                <p class="mb-0"><?php echo $tarea['estado']; ?></p>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-3">
                                                <strong>Usuario:</strong>
                                            </div>
                                            <div class="col-md-9">
                                                <p class="mb-0"><?php echo $usuario['username']; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Listado de archivos adjuntos -->
                                <div class="card mt-4">
                                    <div class="card-header bg-secondary text-white">
                                        <h5 class="mb-0">Archivos Adjuntos</h5>
                                    </div>
                                    <div class="container my-4">
                                        <div class="row g-3">
                                            <!-- Tarjeta de archivo -->
                                            <?php
                                            foreach ($ficheros as $fichero)
                                            {
                                            ?>
                                                <div class="col-md-4">
                                                    <div class="card">
                                                        <div class="card-body">
                                                            <h5 class="card-title"><i class="<?= getFileIcon($fichero['file']); ?> me-3 fs-4"></i><?php echo $fichero['nombre']; ?> </h5>
                                                            <p class="card-text text-muted text-truncate"><?php echo $fichero['descripcion']; ?></p>
                                                            <div class="d-flex gap-2">
                                                                <a href="../<?php echo $fichero['file']; ?>" class="btn btn-sm btn-outline-primary" download>Descargar</a>
                                                                <a href="../ficheros/borrar.php?id=<?php echo $fichero['id']; ?>" class="btn btn-sm btn-outline-danger">Eliminar</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                            
                                            <!-- Tarjeta de subir nuevo -->
                                            <div class="col-md-4">
                                                <a href="../ficheros/subidaFichForm.php?id=<?php echo $id; ?>" class="text-decoration-none">
                                                    <div class="card text-center border-dashed h-100">
                                                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                                            <h5 class="card-title text-primary">
                                                                <i class="bi bi-plus-circle" style="font-size: 2rem;"></i>
                                                            </h5>
                                                            <p class="card-text text-muted">Añadir nuevo archivo</p>
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>

                                        </div>
                                    </div>

                                </div>
                            </div>


                            <?php
                            }
                            else
                            {
                                echo '<div class="alert alert-danger" role="alert">No se pudo recuperar la información de la tarea.</div>';
                            }
                        }
                        else
                        {
                            echo '<div class="alert alert-danger" role="alert">No tienes permisos sobre esta tarea.</div>';
                        }
                    }
                    else
                    {
                        echo '<div class="alert alert-danger" role="alert">No se pudo recuperar la información de la tarea.</div>';
                    }
                }
                else
                {
                    echo '<div class="alert alert-danger" role="alert">Debes acceder a través del listado de tareas.</div>';
                }
                ?>

            </div>
            </main>
        </div>
    </div>

    <?php include_once('../vista/footer.php'); ?>
    
</body>
</html>
