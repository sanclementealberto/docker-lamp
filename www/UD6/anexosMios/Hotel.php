<?php
declare(strict_types=1);

require_once '../flight/Flight.php';




$db=$_ENV['DATABASE_HOST'];
$host=$_ENV['DATABASE_HOST'];
$dbnames=$_ENV['DATABASE_NAME'];
$user=$_ENV['DATABASE_USER'];
$password=$_ENV['DATABASE_PASSWORD'];

Flight::register('db','PDO',array("mysql:host=$host;dbname=pruebas",$user,$password));

Flight::route('GET /clientes', function(){
    $sentencia = Flight::db()->prepare("SELECT * FROM clientes");
    $sentencia->execute();
    $datos=$sentencia->fetchAll();
    Flight::json($datos);
});


Flight::start();