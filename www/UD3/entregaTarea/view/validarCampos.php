<?php


function filtraCampo($campo)
{
    $campo = trim($campo);
    $campo = stripslashes($campo);
    $campo = htmlspecialchars($campo);
    return $campo;
}

function validarCampoTexto($campo)
{
    return (!empty(filtraCampo($campo) && validarLargoCampo($campo, 4)));
}

function validarLargoCampo($campo, $longitud)
{
    return (strlen(trim($campo)) > $longitud);
}

