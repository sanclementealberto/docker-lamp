<?php
declare(strict_types=1);
require_once '../flight/Flight.php'; 

Flight::route('/route', function () {
    echo 'hola';
   
});

Flight::route('/caza',function()
{
    echo 'hola, bienvenido al modulo de DWS!';
});



Flight::start();