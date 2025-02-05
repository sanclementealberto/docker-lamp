<?php
$tareas = [];


function guardarTarea($descripcion, $estado)
{
    global $tareas;


    $descripcion = htmlspecialchars(trim($descripcion));
    $estado = htmlspecialchars(trim($estado));


    $nuevaTarea = [
        'id' => count($tareas) + 1, // ID
        'descripcion' => $descripcion,
        'estado' => $estado
    ];


    $tareas[] = $nuevaTarea;
    // guardo las tareas en una coockie 86400s=1 dia
    setcookie('COOKIETAREAS', json_encode($tareas), time() + (86400 * 30), "/"); 

    return true;
}


function cargarTareasDesdeCookie() {
    global $tareas;

    if (isset($_COOKIE['COOKIETAREAS']) && !empty($_COOKIE['COOKIETAREAS'])) {
        $tareas = json_decode($_COOKIE['COOKIETAREAS'], true);
    }
}
cargarTareasDesdeCookie();