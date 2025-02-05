<?php include_once('head.php'); ?>
<body>

    <?php include_once('header.php'); ?>

    <div class="container-fluid">
        <div class="row">
            <main class="col">
                
                <div class="container justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h2>Nuevo productos</h2>
                </div>

                <div class="container justify-content-between">
                    <form action="productoNuevoProcesa.php" method="POST" enctype="multipart/form-data" class="mb-2 w-50">
                        <?php include_once('productoForm.php'); ?>
                        <button type="submit" class="btn btn-success btn-sm">Guardar</button>
                    </form>
                </div>

                <?php include_once('back.php'); ?>

            </main>
        </div>
    </div>
    
    <?php include_once('footer.php'); ?>
    
</body>
</html>
