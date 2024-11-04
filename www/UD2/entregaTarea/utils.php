<?php
 $tareas=[];
function guardarTarea($descripcion, $estado) {
   
    $descripcion = htmlspecialchars(trim($descripcion));
    $estado = htmlspecialchars(trim($estado));

    global $tareas;
    
    $tareas[] = [
        'id' => count($tareas) + 1,
        'descripcion' => $descripcion,
        'estado' => $estado
    ];

    
    return true;
}
