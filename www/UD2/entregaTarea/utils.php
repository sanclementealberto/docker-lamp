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


    return $nuevaTarea;
}
