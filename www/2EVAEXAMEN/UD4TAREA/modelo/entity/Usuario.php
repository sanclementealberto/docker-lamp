<?php

//__DIR_ DEVUELVE LA RUTA ABSOLUTA donde esta el directorio actual

require_once __DIR__ .'/Rol.php';


class Usuario
{
    private int $id;

    private string $username;

    private string $nombre;
    private string $apellidos;

    private string $contrasena;

    private Rol $rol;


    public function __construct(string $username='', string $nombre ='', string $apellidos ='',string $contrasena  ='', Rol $rol=Rol::USER)
    {
        //despues cambia el valor al guardarlo en la bd
        $this->id=0;
        $this->username=$username;
        $this->apellidos=$apellidos;
        $this->contrasena=$contrasena;
        $this->rol=$rol;
    }

    public function getId()
     {
        return $this->id;
     }

     public function setId(int $id){
        $this->id=$id;
     }

     public function getUsername(){
        $this->username;
     }

     public function setUsername(string $username){
        $this->username=$username;
     }

     public function getNombre()
     {
        return $this->nombre;
     }

     public function setNombre(string $nombre){
        $this->nombre=$nombre;
     }

     public function getApellidos()
     {
        return $this->apellidos;
     }

     public function setApellidos(string $apellidos)
     {
        $this->apellidos=$apellidos;
     }

     public function getContrasena()
     {
        return  $this->contrasena;
     }

     public function setContrasena(string $contrasena)
     {
        $this->contrasena=$contrasena;
     }

     public function getRol()
        {
            return $this->rol;
        }
     
        public function setRol(Rol $rol)
        {
            $this->rol=$rol;
        }

        public static function validate (array $data){
            $errors=[];

            if(empty($data['username'])){
                $errors['username']='El nombre de usuari no puede estar vacio';
            }
            elseif (strlen($data['username'])<4)
            {
                $errors['username']='El nombre de usuario debe tener al menos 3 caracteres';
            }

            if(empty($data['nombre']))
            {
                $errors['nombre']='El nombre no puede estar vacio';
            }
            elseif(strlen($data['nombre'])<4)
            {   
                $errors['nombre']=' el nombre debe tener al menos 3 caraceteres';
            }

            if(empty($data['apellidos']))
            {
                $errors['apellidos']='los apellidos no puede estar vacios';
            }
            elseif(strlen($data['apellidos'])<4)
            {
                $erros['apellidos']=' los apellidos deben tener al  menos 3 caracteres';
            }

            if(empty($data['contrasena']))
            {
                $errors['contrasena']='la contraseña no puede estar vacia';
            }
            elseif(strlen($data['contrasena'])<6)
            {
                $errors['contrasena']='la contrasena debe tener al menos 6 caracteres';
            }

            $valores = array_column(Rol::cases(),'value');
            if (!isset($data['rol']) || !in_array($data['rol'], $valores))
            {
                $errors['rol'] = 'El rol no es válido';
            }

            return $errors;


        }

        public static function validateWithoutPassword(array $data)
        {
            $errors=self::validate($data);
            unset($errors['contrasena']);
            return $errors;
        }

}

