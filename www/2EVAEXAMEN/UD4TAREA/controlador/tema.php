<?php

function temaValido($tema)
{
    return ($tema=='dark' || $tema=='light' || $tema =='auto');
}

//Devuelve la pagina anterior a onde iba redirijido
$origen =$_SERVER['HTTP_REFERER'];

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $tema=$_POST["tema"];

    if(empty($tema) || !temaValido($tema))
    {
        header('Location' .$origen .'?error=true&message=Debes indicar un tema valido.');
    }

    setcookie("tema",$tema, time()+(8600*30), "/");
    header("Location:". $origen);
}else{
    header("Location". $origen. " ?error=true&message=Debes indicar un tema valido." );
}


