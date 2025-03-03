<?php
class Data
{
    public static function setTimeZone()
    {
        date_default_timezone_set('Europe/Madrid');
    }
    private static $calendario = "Calendario gregoriano ";
    private static $dias = ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'];
    private static $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];


    public static function getCalendar(){
        return self::$calendario;
    }

    private static function getData()
    {
        $ano = date('Y'); //Nos da el año actual 
        $mes = date('n')-1;
        $dia = date('j');
        $diaSemana =date ('w');
        
        return self::$dias[$diaSemana]." $dia de ". self::$meses[$mes]." del $ano";
        }

    public static function getHora(){
        self::setTimeZone();
        return date('H:i:s');
    }

    public static function getDataHora()
    {
        return " hoy es " . self::getData(). " y son las " . self::getHora();
    }

}

// Mostrar el calendario
echo "Usamos el calendario: " . Data::getCalendar() . "<br>";

// Mostrar la fecha y la hora
echo Data::getDataHora();

?>