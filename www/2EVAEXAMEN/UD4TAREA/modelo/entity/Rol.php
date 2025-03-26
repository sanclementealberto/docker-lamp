<?php


enum Rol:int {
    case USER=0;
    case ADMIN=1;

    public function descripcion ()
    {
        return match($this){
            Rol::USER=>'Usuario registrado',
            Rol::ADMIN=>'Administrador',
        };
    }
}

?>