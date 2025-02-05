

<?php
//session_start() debe ser lo primero en el html antes de cualquier etiqueta html

session_start();
if(!isset($_SESSION['count'])){
    $_SESSION['count']=0;

}else{
    $_SESSION['count']++;
}
?>