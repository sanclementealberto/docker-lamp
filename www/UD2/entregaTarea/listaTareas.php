<?php include './utils.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD2. Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php include './header.php';
    headerUD2(); ?>
    <div class="container-fluid">
        <div class="row">
            <!-- Menu -->
            <?php include './menu.php';
            menuUD2(); ?>

            <div class="table">
                <table class="table table-striped table-hover">
                    <thead class="thead">
                        <tr>
                            <th>Identificador</th>
                            <th>Descriptción</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($tareas)): ?>
                            <?php foreach ($tareas as $tarea): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($tarea['id']); ?></td>
                                    <td><?php echo htmlspecialchars($tarea['descripcion']); ?></td>
                                    <td><?php echo htmlspecialchars($tarea['estado']); ?></td>

                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="3" class="text-center">No hay tareas disponibles.</td>
                            </tr>
                        <?php endif; ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- footer-->
    <!--asi incluyo el contenido de archivo php a otro -->
    <?php include './footer.php';
    footerUD2(); ?>

</body>

</html>