<?php

abstract class Personaabs
{
    private $idabs;          // Propiedad privada
    protected $nombreabs;    // Propiedad protegida
    protected $apellidosabs; // Propiedad protegida

    // Constructor que asigna los valores a las propiedades
    public function __construct(int $id, string $nombre, string $apellidos)
    {
        $this->idabs = $id;             // Usamos $idabs en lugar de $this->id
        $this->nombreabs = $nombre;     // Usamos $nombreabs en lugar de $this->nombre
        $this->apellidosabs = $apellidos; // Usamos $apellidosabs en lugar de $this->apellidos
    }
    
    // Métodos getters y setters para acceder a las propiedades privadas y protegidas

    public function getIdabs(){
        return $this->idabs;  // Accedemos a la propiedad privada $idabs
    }

    public function setIdabs($idabs){
        $this->idabs = $idabs;  // Establecemos el valor de $idabs
    }

    public function getNombreabs(){
        return $this->nombreabs;  // Accedemos a la propiedad protegida $nombreabs
    }

    public function setNombreabs($nombreabs){
        $this->nombreabs = $nombreabs;  // Establecemos el valor de $nombreabs
    }

    public function setApellidosabs($apellidosabs){
        $this->apellidosabs = $apellidosabs;  // Establecemos el valor de $apellidosabs
    }

    public function getApellidosabs(){
        return $this->apellidosabs;  // Accedemos a la propiedad protegida $apellidosabs
    }

    // Método abstracto que las subclases deben implementar
    abstract function accionabs();
}

class Usuarios extends Personaabs
{
    public function accionabs(){
        return $this->nombreabs . " tiene como rol el usuario"; 
}

}
class Administradores extends Personaabs
{
    public function accionabs(){
        return $this->nombreabs . " tiene como rol el administrador"; 
    }
}


$usuario= new Usuarios(5,"pepe","manolo");
$admin=new AdministradoreS(6,"jesus","garcia");

echo $usuario->accionabs(). "<br>";
echo $admin->accionabs(). "<br>";

?>
