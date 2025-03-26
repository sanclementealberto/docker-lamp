<?php

require_once __DIR__ .'/modelo/entity/Criatura.php';
require_once __DIR__ .'./modelo/ModeloException.php';



function conectaPDO()
{
        $servername=$_ENV['DATABASE_HOST'];
        $username=$_ENV['DATABASE_USER'];
        $password=$_ENV['DATABASE_PASSWORD'];
        $dbname=$_ENV['DATABASE_NAME'];

        $conPDO=new PDO("mysql:host=$servername;dbname=$dbname", $username,$password);
        $conPDO->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        return $conPDO;
}

function conecta($host, $user, $pass, $db)
{
    $conexion = new mysqli($host, $user, $pass, $db);
    return $conexion;
}

function conectaTareas()
{
    $host = $_ENV['DATABASE_HOST'];
    $user = $_ENV['DATABASE_USER'];
    $pass = $_ENV['DATABASE_PASSWORD'];
    $name = $_ENV['DATABASE_NAME'];
    return conecta($host, $user, $pass, $name);
}

function cerrarConexion($conexion)
{
    if (isset($conexion) && $conexion->connect_errno === 0) {
        $conexion->close();
    }
}


function tablaCriaturas()
{
    try{
    $con=conectaTareas();
    $sql = "CREATE TABLE IF NOT EXISTS criaturas (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(100) NOT NULL,
        tipo VARCHAR(50) NOT NULL,
        nivel INT NOT NULL
    )";

    $resultado=$con->query($sql);
   
    if($con->query($sql))
    {
        return [true,'TAbla usuarios creada correctamente'];
    }
    else{
        return [false,'no puedo crear la tabla  criaturas'];
    }
    }
    catch(mysqli_sql_exception $e)
    {
        return [false,throw new ModeloException('error en la tabla criaturas' .$e->getMessage(), 0,$e,__METHOD__,$sql )];

    }
    finally
    {
        cerrarConexion($con);
    }
}

function NuevaCriatura($criatura)
{
    try{
        $conexion=conectaTareas();

        if($conexion->connect_errno)
        {
            return [false,$conexion->error];
        }
        else
        {
            $sql=$conexion->prepare("INSERT INTO criaturas(poder,tipo,nombre,fichero) VALUES (?,?,?,?)");
            $poder=$criatura->getPoder();
            $tipo=$criatura->getTipo();
            $nombre=$criatura->getNombre();
            $fichero=$criatura->getFichero()->getId();
            $sql->bind_param("ssss",$poder,$tipo,$nombre,$fichero);

            $sql->execute();

            return[true,'Criatura creada correctamente'];
        }

    }
    catch(mysqli_sql_exception $e)
    {
        return [false, throw new ModeloException('error al crear nueva criatura '.$e->getMessage(),0,$e,__METHOD__,$sql)];
    }
    finally{
        cerrarConexion($conexion);
    }
}