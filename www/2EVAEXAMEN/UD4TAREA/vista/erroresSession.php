<?php

if(isset($_SESSION) && isset($_SESSION['status']))
{
    $status=$_SESSION['status'];
    $messages=$_SESSION['messages'];
    $type=$status=='success' ? 'success' : 'danger';

    foreach($messages as $message)
    {
        echo "<div class='alert alert-$type' role='alert'>$message</div>";
    }
    //borro  las variables de esta sesiones
    unset($_SESSION['status']);
    unset($_SESSION['messages']);
}