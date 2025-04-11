<?php
declare(strict_types=1);

require_once '../flight/Flight.php';

//variables de entorno para la conexion
$host = $_ENV['DATABASE_HOST'];
$dbname = $_ENV['DATABASE_NAME'];
$user = $_ENV['DATABASE_USER'];
$password = $_ENV['DATABASE_PASSWORD'];



Flight::register('db', 'PDO', array("mysql:host=$host;dbname=$dbname", $user, $password));


//-----------------------REGISTER------------------------------------

Flight::route('POST /register', function () {

    if (comprobarConexion()) {

        //obtengo los parametros del body
        $nombre = Flight::request()->data->nombre;
        $email = Flight::request()->data->email;
        $password = Flight::request()->data->password;


        if (!$nombre || !$email || !$password) {
            Flight::json(["error" => "faltan datos en el body"]);
            //!!!!
            Flight::stop();
            //si no pongo exit sin FLight::stop() no ejecuta el mensaje de json
            exit;

        }

        try {
            //preparo la consulta

            $sqlRegistrar = Flight::db()->prepare("INSERT INTO usuarios (nombre,email,password) VALUES (:nombre,:email,:password)");

            $sqlRegistrar->bindParam(":nombre", $nombre);
            $sqlRegistrar->bindParam(":email", $email);
            //hash password
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $sqlRegistrar->bindParam(":password", $passwordHash);



            $sqlRegistrar->execute();

            if ($sqlRegistrar->rowCount() > 0) {
                Flight::json(["Usuario agregado a la agenda"]);
                Flight::stop();
                //si no pongo exit sin FLight::stop() no ejecuta el mensaje de json
                exit;


            } else {

                Flight::json(["error" => "el usuario no se pudo agregar"]);
                Flight::stop();
                //si no pongo exit sin FLight::stop() no ejecuta el mensaje de json
                exit;


            }
        } catch (PDOException $e) {
            Flight::json(["error" => "error en el sql" . $e->getMessage()]);
        }

    } else {
        Flight::json(["error" => "fallo conexion bd register"]);


    }

});

//-----------------------LOGIN------------------------------------
//get envia los parametros a traves de la url, POST a traves del body es mas seguro
Flight::route("POST /login", function () {

    //compruebo la conexion a la bd
    if (comprobarConexion()) {
        //obtengo los datos del body
        $email = Flight::request()->data->email;
        $password = Flight::request()->data->password;

        if (!$email || !$password) {
            Flight::json(["error" => "faltan datos en el body"]);
            //!!!!
            Flight::stop();
            //si no pongo exit sin FLight::stop() no ejecuta el mensaje de json
            exit;

        }

        //preparo consulta por el email ya que es unico
        $sqlLogin = Flight::db()->prepare("SELECT email,password  FROM usuarios where email=:email");

        //bindeo el email
        $sqlLogin->bindParam(":email", $email);


        //ejecuto
        $sqlLogin->execute();


        $comprobarUser = $sqlLogin->fetch(PDO::FETCH_ASSOC);

        if ($comprobarUser) {
            if (password_verify($password, $comprobarUser['password'])) {


                $nuevoToken = actualizartoken($email);
                if ($nuevoToken) {
                    $comprobarUser['token'] = $nuevoToken;
                    //     Flight::set('usuario', $comprobarUser);
                    Flight::json(["login" => "ok", "token" => $comprobarUser['token']]);
                    Flight::stop();

                    exit;

                } else {
                    Flight::json(["error" => "No se pudo actualizar el token"]);
                    Flight::stop();

                    exit;
                }

            } else {
                Flight::json(["error" => "Credenciales incorrectas"]);
                Flight::stop();

                exit;
            }
        } else {

            Flight::json(["error" => "usuario no existe"]);
            
            Flight::stop();

            exit;
        }
    } else {
        Flight::json(["error" => "conexion bd ruta login fallo"]);
        Flight::stop();
        exit;

    }


});




//AGENDA GET CONTACTOS

Flight::route("GET /contactos", function () {


    if (comprobarLoginToken()) {
        Flight::json(["ok" => "el token es correcto"]);

        $usuario = obtenerIdToken();
        $id = $usuario['id'];
        $nombre = $usuario['nombre'];

        if ($id == null) {
            Flight::json(["error" => "usuario no encontrado"], 404);
            exit;

        }

        if (comprobarConexion()) {

            //la preparo
            $sqlLista = Flight::db()->prepare("SELECT c.id,c.nombre,c.telefono,c.email,c.usuario_id FROM contactos c INNER JOIN usuarios u ON c.usuario_id=u.id WHERE c.usuario_id=:id");
            $sqlContacto = Flight::db()->prepare("SELECT nombre,telefono,email FROM contactos where usuario_id=:id  ");



            //bindeo el id

            $sqlLista->bindParam(":id", $id);

            $sqlContacto->bindParam(":id", $id);




            //ejecuto
            $sqlLista->execute();
            $resultados = $sqlLista->fetchAll(PDO::FETCH_ASSOC);

            $sqlContacto->execute();
            $contacto = $sqlContacto->fetch(PDO::FETCH_ASSOC);


            if ($resultados) {
                Flight::json([
                    "usuario_id:",
                    $id,
                    "Asociados al usuario" => $nombre,
                    "contactos" => $resultados,
                    "contacto perteneciente $nombre " => $contacto
                ]);
                Flight::stop();
                exit;

            } else {
                Flight::json(["error" => "  no se pudo listar contacos no corresponde a ningun usuario"], 403);
                Flight::stop();
                exit;

            }


        } else {
            Flight::json(["error" => "fallo en en  conexion en la lista contactos"]);
            Flight::stop();
            exit;

        }


    } else {
        Flight::json(["error" => "el token es invalido"], 401);
        Flight::stop();
        exit;

    }



});






//POST CONTACTOS


Flight::route("POST /contactos", function () {


    if (comprobarConexion()) {
        if (comprobarLoginToken()) {
            Flight::json(["ok" => "el token es correcto"]);
            $usuario = obtenerIdToken();
            $id = $usuario['id'];



            if ($id == false) {
                Flight::json(["error" => "usuario no encontrado"], 404);
                Flight::stop();
                exit;

            } else {
                $nombre = Flight::request()->data->nombre;
                $telefono = Flight::request()->data->telefono;
                $email = Flight::request()->data->email;
                //preparo la consulta
                try {
                    $sqlLista = Flight::db()->prepare("INSERT INTO contactos  (nombre,telefono,email,usuario_id)VALUES (:nombre,:telefono,:email,:usuario_id) ");

                    //bindeo

                    $sqlLista->bindParam(":nombre", $nombre);
                    $sqlLista->bindParam(":telefono", $telefono);
                    $sqlLista->bindParam(":email", $email);
                    $sqlLista->bindParam(":usuario_id", $id);




                    $sqlLista->execute();


                    if ($sqlLista->rowCount() > 0) {
                        Flight::json([
                            "success" => " el contacto se agrego con exito ",
                        ]);
                        Flight::stop();
                        exit;

                    }


                } catch (PDOException $e) {
                    Flight::json(["error" => "error en post" . $e->getMessage()]);
                    Flight::stop();
                    exit;
                }

            }



        } else {
            Flight::json(["error" => "el token de session es incorrecto"], 401);
            Flight::stop();

            exit;

        }

    } else {
        Flight::json(["error" => "conexion bd ruta contactos POST FALLO"]);
        Flight::stop();

        exit;

    }

});

//EDITAR
//ya que en los contacos el nombre,email y telefono se puede repetir le paso el id por la url
Flight::route("PUT /contactos/@id", function ($idContacto) {
    if (!comprobarConexion()) {
        Flight::json(["error" => "fallo en la conexion bd en PUT contactos"]);
        exit;

    } else {
        if (!comprobarLoginToken()) {
            Flight::json(["error" => "token de login incorrecto"], 401);
            Flight::stop();

            exit;

        } else {

            $usuario = obtenerIdToken();
            $idUsuario = 15;


            if ($idUsuario == null) {
                Flight::json(["error" => "ese usuario no existe"], 404);
                Flight::stop();

                exit;

            } else {



                try {

                    if (!comprobarContacto($idContacto)) {
                        Flight::json(["error" => "ese id de contacto no existe"], 404);
                        Flight::stop();
                        exit;

                    } else {
                        //preparo la consulta
                        $sqlModificar = Flight::db()->prepare("UPDATE  contactos SET nombre=:nombre,telefono=:telefono,email=:email WHERE id=:idcontacto AND usuario_id=:idusuario ");

                        //obtengo los datos del request body

                        $nombre = Flight::request()->data->nombre;
                        $telefono = Flight::request()->data->telefono;
                        $email = Flight::request()->data->email;
                        if(!comprobarContactoUsuario($idContacto,$idUsuario)){
                            Flight::json([
                                "error" => "ese id de contacto no existe",
                                "usuario" => $idUsuario,
                                "idContacto" => $idContacto
                            ], 404);
                        }
                        else{


                        //bindeo los parametros

                        $sqlModificar->bindParam(":nombre", $nombre);
                        $sqlModificar->bindParam(":telefono", $telefono);
                        $sqlModificar->bindParam(":email", $email);
                        $sqlModificar->bindParam(":idcontacto", $idContacto);
                        $sqlModificar->bindParam(":idusuario", $idUsuario);

                        //la ejecuto
                        $sqlModificar->execute();
                     
                        if ($sqlModificar->rowCount() > 0) {
                            Flight::json(["success" => "contacto actualizado"]);
                            Flight::stop();

                            exit;

                        } else {
                            Flight::json(["error" => "error al actualizar ese contacto o no actualizaste ningun dato"]);
                            Flight::stop();

                            exit;

                        }
                    }

                    }
                } catch (PDOException $e) {
                    Flight::json(["error " => "error put" . $e->getMessage()]);
                    Flight::stop();

                    exit;

                }

            }
        }

    }

});


//ya que en los contacos el nombre,email y telefono se puede repetir le paso el id por la url
Flight::route("DELETE /contactos/@id", function ($idContacto) {

    if (!comprobarConexion()) {
        //arraya asociativo =>
        Flight::json(["error" => "error al conectarse a la bd"]);
        Flight::stop();

        exit;

    } else {
        if (!comprobarLoginToken()) {
            Flight::json(["error" => "token de login incorrecto"], 401);
            Flight::stop();

            exit;

        } else {

            $usuario = obtenerIdToken();
            $idUsuario = 5;

            if ($idUsuario == null) {
                Flight::json(["error" => "el id del usuario no existe", 404]);
                Flight::stop();

                exit;

            } else {


                
                try {

                    if(!comprobarContacto($idContacto))
                    {
                        Flight::json(["error"=> "Este contacto no existe"],404);
                        Flight::stop();
                        exit;
                    }
                    else
                    {

                //preparo la consulta
                    $sqlBorrarContacto = Flight::db()->prepare("DELETE FROM contactos  WHERE usuario_id=:usuario_id AND id=:idContacto");

                    //bindeo el parametro
                    if(!comprobarContactoUsuario($idContacto,$idUsuario)){
                        Flight::json([
                            "error" => "ese id de contacto no existe",
                            "usuario" => $idUsuario,
                            "idContacto" => $idContacto
                        ], 404);
                    }
                    else
                    {

                    $sqlBorrarContacto->bindParam(":usuario_id", $idUsuario);
                    $sqlBorrarContacto->bindParam(":idContacto", $idContacto);

                    //la ejecuto
                    $sqlBorrarContacto->execute();

                    if ($sqlBorrarContacto->rowCount() > 0) {
                        Flight::json(["success" => "Contacto eliminado"]);
                        Flight::stop();

                        exit;

                    } 
                }
                
                }
                } catch (PDOException $e) {
                    Flight::json(["error" => "error en el sql de Delete " . $e->getMessage()]);
                    Flight::stop();

                    exit;

                }

            }
        }




    }
});


function comprobarContactoUsuario($idContacto,$idUsuario){
    //prepare
    try{
    $sqlComprobarContactoUsuario=Flight::db()->prepare("SELECT c.id,u.id FROM contactos c INNER JOIN usuarios u ON c.usuario_id=u.id WHERE c.id=:idcontacto AND c.usuario_id=:idusuario ");

    //bind

    $sqlComprobarContactoUsuario->bindParam(":idcontacto",$idContacto);
    $sqlComprobarContactoUsuario->bindParam(":idusuario",$idUsuario);


    $sqlComprobarContactoUsuario->execute();

    $resultado=$sqlComprobarContactoUsuario->fetch(PDO::FETCH_ASSOC);
    
    return $resultado ? :false;
    }catch(PDOException $error){
        Flight::json(["error"=>"error en la consulta comprobarContactoUsuario".$error->getMessage()]);
    }

    

}




function comprobarContacto($id)
{

    $sqlFindContacto = Flight::db()->prepare("SELECT id FROM contactos WHERE id=:id");

    $sqlFindContacto->bindParam(":id", $id);

    $sqlFindContacto->execute();

    $resultado = $sqlFindContacto->fetch(PDO::FETCH_ASSOC);

    return $resultado ?: false;


}

/**
 * Summary of actualizartoken
 * @param mixed $email
 * @return bool|string
 */
function actualizartoken($email)
{
    //preparo la ocnsulta
    $sqlActualizarToken = Flight::db()->prepare("UPDATE  usuarios SET token=:token where email=:email");

    //genero un token aleatorio
    $token = bin2hex(random_bytes(32));

    $sqlActualizarToken->bindParam(":email", $email);
    $sqlActualizarToken->bindParam(":token", $token);
    $sqlActualizarToken->execute();

    if ($sqlActualizarToken->rowCount() > 0) {
        return $token;
    } else {
        return false;
    }

}




/**
 * 
 * 
 * @return bool
 */
function comprobarLoginToken()
{

    $tokenRequest = Flight::request()->getHeader("X-Token");
    //importante uso asi para volver a obtener el token por que Flight::set('user', $userData)
    // se vuelve null al volver a probar la api en otra ruta
    $sql = Flight::db()->prepare("SELECT * FROM usuarios WHERE token = :token");
    $sql->bindParam(":token", $tokenRequest);

    $sql->execute();

    $usuario = $sql->fetch(PDO::FETCH_ASSOC);


    if ($usuario) {
        //esta key la usare para obtener el id correspondiente al token
        Flight::set("usuario", $usuario);
        return true;
    } else {
        return false;
    }

}


/**
 * Summary of obtenerIdToken
 */
function obtenerIdToken()
{

    $usuario = Flight::get("usuario");
    $token = $usuario["token"];

    //la preparo
    $sqlid = Flight::db()->prepare("SELECT id,nombre from usuarios where token=:token");

    //bindeo
    $sqlid->bindParam(":token", $token);

    $sqlid->execute();

    $resultado = $sqlid->fetch(PDO::FETCH_ASSOC);

    return $resultado ?: false;



}



/**
 * ComprobarConexion
 */
function comprobarConexion()
{
    try {
        $conexion = Flight::db();
        if ($conexion) {
            Flight::json(["conexion" => "OK"]);
            return true;
        } else {
            Flight::json(["conexion" => "Fallo"]);
            return false;

        }
    } catch (PDOException $e) {
        Flight::json(["error" => "Error de conexión: " . $e->getMessage()]);
    }
}


Flight::start();
