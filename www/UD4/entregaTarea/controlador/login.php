<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD4. Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styles/style.css">
</head>

<body>
    <div class="transparente">
        <?php include_once('../vista/header.php'); ?>
    </div>
    <div class=" container-fluid">
        <img class="img-background transparente " width="100%" height="550" src="../img/tareas.webp" alt="imagenlogin">


        <div
            class="form-container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <?php if (isset($error) && $error): ?>
                <div class="alert alert-danger" role="alert">
                    Usuario o contraseña incorrectos.
                </div>
            <?php endif; ?>
            <?php include_once('../vista/loginview.php'); ?>

        </div>
        <div class="transparente">
            <?php include_once('../vista/footer.php'); ?>
        </div>


</body>

</html>