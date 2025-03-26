<?php

require_once __DIR__ .'/mysqli.php';
require_once __DIR__ .'/pdo.php';
require_once __DIR__ .'/entity/Criatura.php';
require_once __DIR__ .'/ModeloException.php';




class Enciclopeida implements EnciclopediaInterface{

    public function buscarCriatura($nombre){
      
    }

    public function listaCriaturas()
    {

        try
        {
        $con=conectaPDO();
        $sql='SELECT * FROM ficheros WHERE id=:id';
        $stmt=$con->prepare($sql);
        $stmt->bindParam(':id_tarea',$id_tarea,PDO::PARAM_INT);
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $criaturas=array();
        while($row=$stmt->fetch())
        {
            $criatura=new Criatura($row['poder'],$row('tipo'),$row['nombre'],$row['imagen']);
            array_push($criaturas,$criatura);

        }
        return $criaturas;
    }
    catch(PDOException $e)
    {
        throw new ModeloException('error al listar criaturas'. $e->getMessage(),0,$e,__METHOD__,$sql);
    }
    finally
    {

    }
    }

    public function borraCriatura(int $id)
    {
        try
        {
            $con=conectaPDO();
            $sql='DELETE FROM criaturas WHERE id =' .$id;
            $stmt=$con->prepare($sql);
            $stmt->execute();
            return true;

        }
        catch(PDOException $e)
        {
            throw new ModeloException('Error al borrar la criatura:'. $e->getMessage(),0,$e,__METHOD__,$sql);
        }
        finally
        {
            $con=null;
        }

    }
    public function nuevaCriatura(Criatura $criatura)
    {
        try
        {
            $con=conectaPDO();
            $stmt=$con->prepare("INSERT INTO criaturas (poder,tipo,nombre,fichero) VALUES(:poder,:tipo,:desripcion:fichero)");
            $poder=$criatura->getPoder();
            $tipo=$criatura->getTipo();
            $nombre=$criatura->getNombre();
            $fichero=$criatura->getImage()->getId();
            $stmt->bindParam(':poder',$poder);
            $stmt->bindParam(':tipo',$tipo);
            $stmt->bindParam(':nombre',$nombre);
            $stmt->bindParam(':fichero',$fichero);

            $stmt->execute();
            $stmt->closeCursor();
            
        }
        catch(PDOException $e)
        {
            throw new ModeloException('Error al borrar la Criatura'. $e->getMessage(),0,$e,__METHOD__,$stmt->queryString);
        }
    }

}