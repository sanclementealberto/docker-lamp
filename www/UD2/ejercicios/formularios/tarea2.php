<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <form action="" method="post">
                <div class="mb-3">
                    <select name="opcion">
                        <option value="cocacola">Coca Cola</option>
                        <option value="pepsi">Pepsi Cola</option>
                        <option value="fanta">Fanta Naranja</option>
                        <option value="trina">Trina Manzana</option>
                    </select>

                    <input class="form-control mt-2" type="number" min="1" placeholder="cantidad" name="cantidad" required>


                </div>


        </div>
        <button class="mb-3" type="submit" class="btn btn-primary mt-2 ms-1">Solicitar</button>
        </form>
    </div>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $cantidad = (int)$_POST['cantidad'];
        $opcion = $_POST['opcion'];
        $precio = 0;
        $nombre_bebida = "";
        switch ($opcion) {
            case 'cocacola':
                $precio = 1.00;
                $nombre_bebida = "Coca Cola";
                break;
            case 'pepsi':
                $precio = 0.80;
                $nombre_bebida = "Pepsi Cola";
                break;
            case 'fanta':
                $precio = 0.90;
                $nombre_bebida = "Fanta Naranja";
                break;
            case 'trina':
                $precio = 1.10;
                $nombre_bebida = "Trina Manzana";
                break;
        }
        $precio_total = $cantidad * $precio;

        echo "<h3>Resultado del pedido</h3>";
        echo "<p> Pediste $cantidad botellas de $nombre_bebida. Precio total a pagar : $precio_total Euros";
    }


    ?>

</body>

</html>