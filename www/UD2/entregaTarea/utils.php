<?php

$tareas=[];
 
function guardarTarea($descripcion, $estado) {
    global $tareas;
    $descripcion = htmlspecialchars(trim($descripcion));
    $estado = htmlspecialchars(trim($estado));

    
    
    $tareas[] = [
        'id' => count($tareas) + 1,
        'descripcion' => $descripcion,
        'estado' => $estado
    ];

    
    return true;
}
