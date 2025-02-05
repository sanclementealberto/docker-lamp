<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UD2. Tarea</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
      <!-- Header -->
<?php include './header.php'; 
 headerUD2();?>
    <div class="container-fluid">
        <div class="row">
              <!-- Menu -->
            <?php include './menu.php'; 
            menuUD2();?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Título del contenido</h2>
                </div>
                <div class="container">
                    <p>Aquí va el contenido </p>
                </div>
            </main>
        </div>
    </div>
      <!-- footer-->
    <!--asi incluyo el contenido de archivo php a otro -->
    <?php include './footer.php';
    footerUD2(); ?>
</body>
</html>