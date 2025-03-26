<?php
/**
 * un conjunto de valores fijos y predefinidos.
*Se usa para representar valores que no cambian, como roles de usuario, estados de una orden, tipos de àgo
 * Summary of Estado
 */
enum Estado: string
{
    case PENDIENTE = 'pendiente';
    case EN_PROCESO = 'en_proceso';
    case COMPLETADA = 'completada';

    public function descripcion(): string
    {
        return match($this) {
            self::PENDIENTE => 'Pendiente',
            self::EN_PROCESO => 'En proceso',
            self::COMPLETADA => 'Completada',
        };
    }
}
?>