<?php
if(isset($_POST['tema'])){
    $tema=$_POST['tema'];
    // se aplique a todo "/"
    setcookie('tema',$tema, time() +(30*24*60*60), "/");
    $cambiarcolor=cambiarColor();

    
// Redirigir de vuelta a la página principal
$url = $_SERVER['HTTP_REFERER'] ?? 'index.php';
header("Location: $url");
//evito que el script se siga ejecutando
exit();

}

function cambiarColor(){
    return isset($_COOKIE['tema']) && $_COOKIE['tema'] === 'dark' ? 'dark' : 'light';
}

?>