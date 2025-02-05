<?php
include_once("header.php");
$header = headerTareas();

include_once("footer.php");
$footer = footerTareas();

include_once("menu.php");
$menu = menuTarea();



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TareaUD3</title>
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
                    <h2>Lista Usuarios</h2>
                    <table class="table table-hover table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Usuario</th>
                            <th>nombre</th>
                            <th>apellidos</th>
                            <th></th>


                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once("../model/pdo.php");
                        $resultado=listaUsuariosPDO();
                        if($resultado[0]===true)
                        {
                           $usuarios=$resultado[1];

                           if($usuarios)
                           {
                            foreach($usuarios as $usuario)
                            {
                                echo '<tr>';
                                echo '<td>'. $usuario['id'].'</td>';
                                echo '<td>'. $usuario['username'].'</td>';
                                echo '<td>'. $usuario['nombre'].'</td>';
                                echo '<td>'. $usuario['apellidos'].'</td>';
                                echo '<td>';
                                //se usa get en editaUsuarioForm por que en el atributo href no se puede usar post
                                //y cong $_get obtengo el id de la url
                                echo '<a class="btn btn-success btn-sm me-2" href="editaUsuarioForm.php?id='.htmlspecialchars($usuario['id']).'" role="button">Editar</a>';
                                echo '<a class="btn btn-warning btn-sm" href="borraUsuario.php?id='.htmlspecialchars($usuario['id']).'" role="button" onclick="return confirm(\'¿Estás seguro de que deseas eliminar este usuario?\')">Borrar</a>';
                                echo '</td>';
                                echo '</tr>';

                            }

                           }
                           else{
                            echo '<tr> <td colspan="5">No hay usuarios</tr>';
                           }


                        }
                        else
                        {
                            echo '<tr><td colspan="5">Error recuperando usuarios: ' . $resultado['1'] . '</td></tr>';
                        }


                        ?>
                    </tbody>
                    </table>
                </div>
            </main>
        </div>
    </div>
    <?php echo $footer; ?>
</body>

</html>