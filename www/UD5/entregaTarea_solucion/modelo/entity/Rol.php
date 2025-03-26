<?php

/**
 * un conjunto de valores fijos y predefinidos.
*Se usa para representar valores que no cambian, como roles de usuario, estados de una orden, 
*tipos de   pago
 * Summary of Rol
 */
enum Rol: int {
    case USER = 0;
    case ADMIN = 1;

    public function descripcion(): string {
        //match es como switch pero mas estricto
        return match($this) {
            Rol::USER => 'Usuario registrado',
            Rol::ADMIN => 'Administrador',
        };
    }
}
?>