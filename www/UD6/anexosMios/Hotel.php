<?php
declare(strict_types=1);

require_once '../flight/Flight.php';




$db = $_ENV['DATABASE_HOST'];
$host = $_ENV['DATABASE_HOST'];
$dbnames = $_ENV['DATABASE_NAME'];
$user = $_ENV['DATABASE_USER'];
$password = $_ENV['DATABASE_PASSWORD'];

Flight::register('db', 'PDO', array("mysql:host=$host;dbname=$dbnames", $user, $password));

Flight::route('GET /clientes', function () {
    $sentencia = Flight::db()->prepare("SELECT * FROM clientes");
    $sentencia->execute();
    $datos = $sentencia->fetchAll();
    if ($datos) {
        Flight::json($datos);
    } else {
        Flight::json(['no hay clientes']);
    }

});

//@id captura el valor del parámetro id en la URL.
Flight::route('GET /clientes/@id', function ($id) {
    $sentencia = Flight::db()->prepare("SELECT * FROM clientes WHERE id=:id");
    $sentencia->bindParam(":id", $id);
    $sentencia->execute();

    $datos = $sentencia->fetch();

    if ($datos) {
        Flight::json($datos);
    } else {
        Flight::json(['error ' => 'Cliente no encontrado'], 404);
    }

});

Flight::route('POST /clientes', function () {
    $id = Flight::request()->data->id;
    $nombre = Flight::request()->data->nombre;
    $apellidos = Flight::request()->data->apellidos;
    $edad = Flight::request()->data->edad;
    $email = Flight::request()->data->email;
    $telefono = Flight::request()->data->telefono;


    $sqlpreparada = FLight::db()->prepare("INSERT INTO clientes (id,nombre,apellidos,edad,email,telefono) VALUES (:id,:nombre,:apellidos,:edad,:email,:telefono)");

    //bindeo parametros

    $sqlpreparada->bindParam(":id", $id);
    $sqlpreparada->bindParam(":nombre", $nombre);
    $sqlpreparada->bindParam(":apellidos", $apellidos);
    $sqlpreparada->bindParam(":edad", $edad);
    $sqlpreparada->bindParam(":email", $email);
    $sqlpreparada->bindParam(":telefono", $telefono);
    $sqlpreparada->execute();

    if ($sqlpreparada->rowCount() > 0) {
        Flight::json(["Usuario de hotel añadido"]);

    } else {
        Flight::json(["no se pudo añadir el usuario"]);

    }




});

Flight::route("DELETE /clientes/@id", function ($id) {

    $sqlBorrar = "DELETE FROM clientes where id=:id";
    $sentencia = Flight::db()->prepare($sqlBorrar);

    $sentencia->bindParam(":id", $id);

    $sentencia->execute();

    Flight::json(["usuario borrado correctamente"]);
});


Flight::route("PUT /clientes/@id", function ($id) {
    $apellidos = Flight::request()->data->apellidos;
    $edad = Flight::request()->data->edad;
    $email = Flight::request()->data->email;
    $telefono = Flight::request()->data->telefono;



    $sqlpreparada = Flight::db()->prepare("UPDATE clientes set apellidos=:apellidos,edad=:edad, email=:email,telefono=:telefono  WHERE id=:id");

    $sqlpreparada->bindParam(":id", $id);
    $sqlpreparada->bindParam(":apellidos", $apellidos);
    $sqlpreparada->bindParam(":edad", $edad);
    $sqlpreparada->bindParam(":email", $email);
    $sqlpreparada->bindParam(":telefono", $telefono);


    $sqlpreparada->execute();

    if ($sqlpreparada->rowCount() > 0) {
        Flight::json(["cliente actualizado"]);
    } else {
        Flight::json(["el cliente no se pudo actualizar"]);
    }



});


//-----------------HOTELES-----------------------//


Flight::route('GET /hoteles', function () {
    try {
        $sentencia = Flight::db()->prepare('SELECT * FROM hoteles');
        $sentencia->execute();
        $datos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

        if ($datos) {
            Flight::json($datos);
        }

    } catch (PDOException $e) {
        Flight::json(['error en la consulta']);
    }

});

//Flight::request()->data->id se usa en solicitudes POST/PUT, no en GET.
//Flight::request()->data->id, ya que eso lo obtienes del body de la solicitud no del URL (solo relevante en POST/PUT).

Flight::route('GET /hoteles/@id', function ($id) {

    try {


        $sql = Flight::db()->prepare('SELECT * FROM hoteles where id=:id');
        $sql->bindParam(":id", $id);
        $sql->execute();
        $datos = $sql->fetch(PDO::FETCH_ASSOC);
        if ($datos) {
            Flight::json($datos);
        } else {
            Flight::json(["ese hotel no existe"]);
        }

    } catch (PDOException $e) {
        Flight::json(["error" => $e->getMessage()]);


    }
});


//POST HOTEL

Flight::route('POST /hoteles', function () {

    $hotel = Flight::request()->data->hotel;
    $direccion = Flight::request()->data->direccion;
    $telefono = Flight::request()->data->telefono;
    $email = Flight::request()->data->email;

    //la preparo
    $sqlinsertar = Flight::db()->prepare("INSERT INTO hoteles(hotel,direccion,telefono,email) VALUES(:hotel,:direccion,:telefono,:email)");
    $sqlinsertar->bindParam(":hotel", $hotel);
    $sqlinsertar->bindParam(":direccion", $direccion);
    $sqlinsertar->bindParam(":telefono", $telefono);
    $sqlinsertar->bindParam(":email", $email);

    //la ejecuto
    $sqlinsertar->execute();

    FLight::json(["hotel actualizado con exito"]);


});

//DELETE HOTEL

Flight::route("DELETE /hoteles/@id", function($id){

    $sqlborrar="DELETE FROM hoteles where id=:id";
    
    $sentencia=Flight::db()->prepare($sqlborrar);

    $sentencia->bindParam(":id",$id);


    $sentencia->execute();

    Flight::json(["hotel borrado"]);

});

//PUT HOTEL

Flight::route("PUT /hoteles/@id",function($id)
{
    $hotel=Flight::request()->data->hotel;
    $direccion=Flight::request()->data->direccion;
    $telefono=Flight::request()->data->telefono;
    $email=Flight::request()->data->email;

    $sentencia=Flight::db()->prepare("UPDATE hoteles set  hotel=:hotel,direccion=:direccion,telefono=:telefono,email=:email");

    $sentencia->bindParam(":hotel",$hotel);
    $sentencia->bindParam(":direccion",$direccion);
    $sentencia->bindParam(":telefono",$telefono);
    $sentencia->bindParam(":email",$email);


    $sentencia->execute();

    Flight::json(["hotel actualizado"]);

});



//-----------------------RESERVA---------------
/**
 * Cuando usas fetch() o fetchAll() sin un modo específico, PDO devuelve los datos en un array mixto:
*Índices numéricos (0, 1, 2...)
*Claves asociativas con los nombres de las columnas
 * EJEMPLO
 * 
 *   "0": "Ruthie Nik",
 **   "1": "Renner",
 *   "2": "marjolaine63@example.net",
 *   "3": "1-500-553-4301x",
  *  "4": "Hotel MAruja",
 **   "5": "1996-09-24",
  *  "6": "2000-03-27",
 *   "nombre": "Ruthie Nik",
  *  "apellidos": "Renner",
  *  "email": "marjolaine63@example.net",
  *  "telefono": "1-500-553-4301x",
  *  "hotel": "Hotel MAruja",
 *   "fecha_entrada": "1996-09-24",
 *   "fecha_salida": "2000-03-27"
*
 * 
 */
Flight::route("GET /reserva",function()
{
    $sentencia=Flight::db()->prepare("SELECT c.nombre,c.apellidos,c.email,c.telefono,h.hotel,r.fecha_entrada,r.fecha_salida FROM reservas r INNER JOIN   clientes c ON c.id=r.id_cliente INNER JOIN  hoteles h ON  h.id=r.id_hotel");

    $sentencia->execute();

    $datos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
    if($datos)
    {
        Flight::json(($datos));
    }
    else
    {
        Flight::json(["no hay reservas"]);
    }
});

//obter a reserva mediante su id
Flight::route("GET /reserva/@id", function($id){

    $sentencia=Flight::db()->prepare("SELECT c.nombre,c.apellidos,c.email,c.telefono,h.hotel,r.fecha_entrada,r.fecha_salida FROM reservas r INNER JOIN   clientes c ON c.id=r.id_cliente INNER JOIN  hoteles h ON  h.id=r.id_hotel WHERE r.id=:id");

    $sentencia->bindParam(":id",$id);
    $sentencia->execute();
    
    $datos=$sentencia->fetch(PDO::FETCH_ASSOC);

    if($datos)
    {
        Flight::json($datos);
    }
    else 
    {
        Flight::json(["no existe esa reserva"]);
    }


});


//post reserva

Flight::route("POST /reserva ",function(){

    //obtengo los datos del cuerpo(body) de la  request data
    $id_cliente=Flight::request()->data->id_cliente;
    $id_hotel=FLight::request()->data->id_hotel;
    $fecha_reserva=Flight::request()->data->fecha_reserva;
    $fecha_entrada=Flight::request()->data->fecha_entrada;
    $fecha_salida=Flight::request()->data->fecha_salida;

    //preparo la consullta
    $sentencia = Flight::db()->prepare("
            INSERT INTO reservas (id_cliente, id_hotel, fecha_reserva,fecha_entrada, fecha_salida) 
            VALUES (:id_cliente, :id_hotel,:fecha_reserva, :fecha_entrada, :fecha_salida)
        ");

        //bindeo parametros
        $sentencia->bindParam(":id_cliente",$id_cliente);
        $sentencia->bindParam(":id_hotel",$id_hotel);
        $sentencia->bindParam(":fecha_reserva",$fecha_reserva);
        $sentencia->bindParam(":fecha_entrada",$fecha_entrada);
        $sentencia->bindParam(":fecha_salida",$fecha_salida);

        $sentencia->execute();

        if($sentencia->rowCount()>0){
            Flight::json(["mensaje" => "Reserva creada correctamente"]);
        }else{
            Flight::json(["mensaje" => "No se pudo crear la reserva"]);
        }





});

Flight::route("DELETE /reserva/@id",function($id){

    $sqlborrar="DELETE FROM reservas where id=:id";
    $sqlborrar=Flight::db()->prepare($sqlborrar);
    //bidneo    
    $sqlborrar->bindParam(":id",$id);

    $sqlborrar->execute();

    Flight::json(["reserva borrada"]);


});

Flight::route("PUT /reserva/@id",function($id){

    //obtengo la request() del body
    $fecha_entrada=Flight::request()->data->fecha_entrada;
    $fecha_salida=Flight::request()->data->fecha_salida;

    //preparo la consulta
    $sqlput=Flight::db()->prepare("UPDATE reservas set fecha_entrada=:fecha_entrada ,fecha_salida=:fecha_salida where id=:id");

    $sqlput->bindParam(":id",$id);
    $sqlput->bindParam(":fecha_entrada",$fecha_entrada);
    $sqlput->bindParam(":fecha_salida",$fecha_salida);



    $sqlput->execute();

    if($sqlput->rowCount()>0)
    {
        Flight::json(["reserva actualizado"]);

    }
    else
    {
        Flight::json(["lareserva no se pudo actualizar"]);

    }

});



Flight::start();