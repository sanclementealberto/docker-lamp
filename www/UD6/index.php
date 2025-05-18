<?php

declare(strict_types=1);

require_once 'flight/Flight.php';
// require 'flight/autoload.php';

Flight::route('/', function () {
    echo 'hello world!';
});


//EL Primer db vviene de docker-compose.yml y hay varios servicios.
//db,www,phpmyadmin

Flight::register('db','PDO',array('mysql:host=db;dbname=myDBPDO','root','test'));




Flight::route('/saludar',function()
{
    echo 'hola, bienvenido al modulo de DWS!';
});

Flight::route('GET /clientes', function(){

    $sentencia= Flight::db()->prepare("SELECT * FROM clientes");
    $sentencia->execute();
    
    $datos= $sentencia->fetchAll();
    Flight::json($datos);
});


Flight::route('POST /clientes', function(){

    $id=Flight::request()->data->id;
    $nombre= Flight::request()->data->nombre;
    $apellido=Flight::request()->data->apellido;
    $email=Flight::request()->data->email;
    $sqlinsert="INSERT INTO clientes(id,nombre,apellido,email) VALUES(:id,:nombre,:apellido,:email)";

    //prepare
    $sentencia =Flight::db()->prepare($sqlinsert);

    //bindeo los parametros
    $sentencia->bindParam(":id",$id);
    $sentencia->bindParam(":nombre",$nombre);
    $sentencia->bindParam(":apellido",$apellido);
    $sentencia->bindParam(":email",$email);
    //ejecutamos el insert
    $sentencia->execute();

    //devolvemos un json para confirmar
    $mensaje="MODULO AGREGALO correctamente";
   // Flight::json(["MODULO AGREGALO correctamente"]);
    Flight::json($mensaje);


});

Flight::route("DELETE /clientes/delete", function()
{
    $id=Flight::request()->data->id;
    $sqlborrar="DELETE FROM clientes where id=?";
    //la preparo
    $sentencia=Flight::db()->prepare($sqlborrar);

    //asigno el parametro
    $sentencia->bindParam(1,$id);

    //ejecuto la sentencia
    $sentencia->execute();
    
    $mensaje="borrado usuario correctamente".$id;
    Flight::json($mensaje);
});


FLight::route("PUT /clientes", function(){
    $id=Flight::request()->data->id;
    $nombre=Flight::request()->data->nombre;
    $apellido=Flight::request()->data->apellido;
    $email=FLight::request()->data->email;

    $consulta="UPDATE clientes set nombre=:nombre, apellido=:apellido, email=:email WHERE id=:id";

    //preparo la consulta
    $sentencia=Flight::db()->prepare($consulta);

    //bindeo los parametros

    $sentencia->bindParam(":id",$id);
    $sentencia->bindParam(":nombre",$nombre);
    $sentencia->bindParam(":apellido",$apellido);
    $sentencia->bindParam(":email",$email);

    //ejecuto la consulta

    $sentencia->execute();

    $mensaje="usuario actualizado correctamente".$id;

    Flight::json($mensaje);

});










//poner la rutas antes de start por que es cuando inicia el framework
Flight::start();

