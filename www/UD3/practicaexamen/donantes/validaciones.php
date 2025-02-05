<?php


function comprobarEdad($edad)
{ 
   return $edad>=18 ? true :false ;
}

function filtrarCampo($campo){
    $campo=trim($campo);
    $campo= stripcslashes($campo);
    $campo=htmlspecialchars($campo);
    return $campo;
}

function comprobarCodigoPostal($codigo){
    return strlen($codigo)===5 ;
}

function comprobarMovil($movil){
    return  strlen($movil)===9 ;
}
/**
 * Summary of comprobarFechaDonacion
 * @param mixed $fecha
 * @return bool|string
 * el operador :: se usa para acceder a metodos estaticos en php
 * y el oeradpor -> a todos los metodos propios de la instancia
 */
function comprobarFechaDonacion($fecha){
    
    
    $hoy = new DateTime();
    
    $ultimaDonacion = DateTime::createFromFormat('Y-m-d', $fecha);
   

    if (!$ultimaDonacion) {
        return false;
    }

    $fechaProximaDonacion = clone $ultimaDonacion; // Clonamos la fecha original
    $fechaProximaDonacion->modify('+4 months');  // Sumamos 4 meses

    

    
    
        return  $fechaProximaDonacion->format('Y-m-d') ;// Fecha 4 meses después
   
}

function listaGrupoSanguineo(){
    return ['O-', 'O+', 'A-', 'A+', 'B-', 'B+', 'AB-', 'AB+'];
}