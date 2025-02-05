<?php
include_once("../model/ModeloUsuarios.php");

function nuevoUsuarioView()
{


  
 
    //<form action="./listaUsuarios.php" method="post"></form> el navegador vera este codigo
    $actionUrl = htmlspecialchars($_SERVER['PHP_SELF']);
    return <<<HTML
    <div class="container-fluid col-3 mt-5 vh-100 d-flex justify-content-center ">
    <div class="container"> 
            <form action="$actionUrl" method="post">
                <label for="nombre">Nombre</label>
                <input class="form-control mb-3" type="text" name="nombre">
                <label for="apellidos">Apellidos</label>
                <input class="form-control mb-3" type="text" name="apellidos">
                <label for="edad">Edad</label>
                <input class="form-control mb-3" type="number" name="edad">
                <label for="provincia">Provincia</label>
                <input class="form-control mb-3" type="text" name="provincia">
                <button class="btn btn-primary mt-3" type="submit">Enviar</button>
            </form>
        </div>  
    </div>
HTML;
}







//El operador ?? devuelve el primer operando si este existe  o es null en este caso un string vacio. 
//Si el primer operando no está definido o es null, devuelve el segundo operando.

function guardarUsuarioBD(){
    if($_SERVER['REQUEST_METHOD']==='POST'){
        $datos = [
            'nombre' => $_POST['nombre'] ?? '',
            'apellidos' => $_POST['apellidos'] ?? '',
            'edad' => $_POST['edad'] ?? '',
            'provincia' => $_POST['provincia'] ?? ''
        ];
        $validacion = validarInPuts($datos);
        
        if($validacion===true){
            if (nuevoUsuario($datos['nombre'], $datos['apellidos'], $datos['edad'], $datos['provincia'])) {
                
                return  "Usuario guardado con exito";
            } else {
               
                return  "Hubo un problema al guardar el usuario.";;
            }
        }else{
            
            return [false ."error validacion".$validacion];
        }

    }
}

