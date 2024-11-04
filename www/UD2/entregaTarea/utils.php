<?php
session_start(); // Inicia la sesión

// Inicializa la variable de sesión si no existe
if (!isset($_SESSION['tareas'])) {
    $_SESSION['tareas'] = [];
}

 
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
