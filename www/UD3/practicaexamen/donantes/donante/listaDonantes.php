<?php
include_once("../view/header.php");
$header = headerDonantes();

include_once("../view/footer.php");
$footer = footerDonantes();

include_once("../view/menu.php");
$menu = menuDonantes();



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DONACIONES</title>
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
                    <h2>Lista Donante </h2>
                </div>
                    <table class="table  table-bordered">
                     <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>nombre</th>
                            <th>apellidos</th>
                            <th>edad</th>
                            <th>grupo sanguineo</th>
                            <th>codigo postal</th>
                            <th>telefono movil</th>
                            <th>opciones</th>

                        </tr>

                     </thead>   
                     <tbody>
                        <?php
                        require_once("../model/mysqli.php");
                        $resultado=listaDonantesMYSQL();
                        if($resultado[0]===true){
                            $listadonantes=$resultado[1];
                            if($listadonantes){
                                foreach($listadonantes as $donante){
                                    //fila tr  td columna
                                    echo '<tr>';
                                    echo '<td>'. $donante['id'].'</td>';
                                    echo '<td>'. $donante['nombre'].'</td>';
                                    echo '<td>'. $donante['apellidos'].'</td>';
                                    echo '<td>'. $donante['edad'].'</td>';
                                    echo '<td>'. $donante['grupo_sanguineo'].'</td>';
                                    echo '<td>'. $donante['codigo_postal'].'</td>';
                                    echo '<td>'. $donante['telefono_movil'].'</td>';

                                    echo '<td>';
                                    //se usa get en editadonanteForm por que en el atributo href no se puede usar post
                                    //y cong $_get obtengo el id de la url | me signfiica margin end que es margen derecho
                                    echo '<a class="btn btn-success btn-sm me-2" href="editaDonanteForm.php?id='.htmlspecialchars($donante['id']).'" role="button">Editar</a>';
                                    echo '<a class="btn btn-danger btn-sm me-2" href="borraDonante.php?id='.htmlspecialchars($donante['id']).'" role="button" onclick="return confirm(\'¿Estás seguro de que deseas eliminar este donante?\')">Eliminar</a>';
                                    echo '<a class="btn btn-success btn-sm me-2" href="/UD3/practicaexamen/donantes/donacion/listaDonaciones.php?id='.htmlspecialchars($donante['id']).'" role="button">lista Donaciones</a>';
                                    echo '<a class="btn btn-success btn-sm me-2" href="/UD3/practicaexamen/donantes/donacion/nuevaDonacionForm.php?id='.htmlspecialchars($donante['id']).'" role="button">Registrar Donacion</a>';


                                    echo '</td>';
                                    echo '</tr>';
                                }

                            }else{
                                echo '<tr><td class="text-center" colspan="7">NO HAY DONANTES</td> 
                                
                                </tr>';
                            }




                        }


                        ?>

                     </tbody>




                    </table>
              
            </main>

        </div>

    </div>

    <?php echo $footer; ?>
</body>

</html>