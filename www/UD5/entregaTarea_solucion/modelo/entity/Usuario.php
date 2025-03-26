<?php

require_once __DIR__ . '/Rol.php';

class Usuario 
{
    private int $id;
    private string $username;
    private string $nombre;
    private string $apellidos;
    private string $contrasena;
    private Rol $rol;

    public function __construct(string $username = '', string $nombre = '', string $apellidos = '', string $contrasena = '', Rol $rol = Rol::USER) 
    {
        $this->id = 0;
        $this->username = $username;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->contrasena = $contrasena;
        $this->rol = $rol;
    }

    public function getId(): int 
    {
        return $this->id;
    }

    public function setId(int $id): void 
    {
        $this->id = $id;
    }

    public function getUsername(): string 
    {
        return $this->username;
    }

    public function setUsername(string $username): void 
    {
        $this->username = $username;
    }

    public function getNombre(): string 
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): void 
    {
        $this->nombre = $nombre;
    }

    public function getApellidos(): string 
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): void 
    {
        $this->apellidos = $apellidos;
    }

    public function getContrasena(): string 
    {
        return $this->contrasena;
    }

    public function setContrasena(string $contrasena): void 
    {
        $this->contrasena = $contrasena;
    }

    public function getRol(): Rol 
    {
        return $this->rol;
    }

    public function setRol(Rol $rol): void 
    {
        $this->rol = $rol;
    }

    public static function validate(array $data): array 
    {
        $errors = [];

        if (empty($data['username'])) 
        {
            $errors['username'] = 'El nombre de usuario no puede estar vacío';
        } 
        elseif (strlen($data['username']) < 4) 
        {
            $errors['username'] = 'El nombre de usuario debe tener al menos 3 caracteres';
        }

        if (empty($data['nombre'])) 
        {
            $errors['nombre'] = 'El nombre no puede estar vacío';
        } 
        elseif (strlen($data['nombre']) < 4) 
        {
            $errors['nombre'] = 'El nombre debe tener al menos 2 caracteres';
        }

        if (empty($data['apellidos'])) 
        {
            $errors['apellidos'] = 'Los apellidos no pueden estar vacíos';
        } 
        elseif (strlen($data['apellidos']) < 4) 
        {
            $errors['apellidos'] = 'Los apellidos deben tener al menos 2 caracteres';
        }

        if (empty($data['contrasena'])) 
        {
            $errors['contrasena'] = 'La contraseña no puede estar vacía';
        } 
        elseif (strlen($data['contrasena']) < 6) 
        {
            $errors['contrasena'] = 'La contraseña debe tener al menos 6 caracteres';
        }   

        //array_column fnciona (array que recorremos, $columnkey 'value, index opcional);

        $valores = array_column(Rol::cases(), 'value');
        if (!isset($data['rol']) || !in_array(needle: $data['rol'], haystack: $valores))
        {
            $errors['rol'] = 'El rol no es válido';
        }

        return $errors;
    }
    
    public static function validateWithoutPassword(array $data): array 
    {
        $errors = self::validate($data);
        unset($errors['contrasena']);
        return $errors;
    }
}
?>