<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>
    <h2 class="text-center">Formulario para pedir nombre y apellidos</h2>

    <div class="container-fluid">
        <form action="tarea1lista.php" method="post">
        <div class="row">
            <div class="mb-3">
                <label for="nombre" aria-details="nombre" class="form-label">nombre</label>
                <input class="form-control" placeholder="nombre" aria-describedby="nombre" name="nombre" required>
                <label for="apellido" aria-details="apellido" class="form-label">apellido </label>
                <input class="form-control" placeholder="apellido" aria-describedby="apellido" name="apellido" required>
                
            </div>
       

    </div>
    
    <button type="submit" class="btn btn-primary mt-2 ms-1"> Enviar       </button>

    </form>











</body>

</html>