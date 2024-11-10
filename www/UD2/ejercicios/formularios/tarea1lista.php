<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php


    function obtenerDatosForm()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $apellido = trim($_POST['apellido']);
            $nombre = trim($_POST['nombre']);

            if (!empty($apellido)  && !empty($nombre)) {
                echo "<h3> Resultados <h3/>";
                echo "Nombre: " . htmlspecialchars($nombre) . "<br/>";
                echo "Apellido: " . htmlspecialchars($apellido) . "<br/>";
                echo "Nombre y apellidos : " . htmlspecialchars($nombre) . " " . htmlspecialchars($apellido) . "<br/>";
                //strlen saca la cantidad de caracteres
                echo "Su nombre tiene caracteres :" . strlen($nombre) . "<br/>";
                //substr saca los caracteres de la 1 posicion offset y la longitud que querias sacar de la cadena
                echo "Los 3 primeros caracteres de tu nombre son :" . substr($nombre, 0, 3) . "<br/>";
                $posicionA = stripos($apellido, 'a');
                if ($posicionA !== false) {
                    echo "La letra 'A' fue encontrada en sus apellidos en la posición: " . ($posicionA + 1) . "<br>";
                } else {
                    echo "La letra 'A' no fue encontrada en sus apellidos.<br>";
                }

                $cantidadA=substr_count(strtolower($nombre),'a');
                echo " su nombre contiene $cantidadA caracteres 'A'"."<br/>";
                echo " tu nombre en mayusculas es :" . strtoupper($nombre). "<br/>";
                echo " tu nombre en minusculas es" . strtolower($nombre). "<br/>";
                echo " Su nombre y apellido en mayusculas ". strtoupper($nombre) . " " . strtoupper($apellido). "<br/>";
                echo " Su nombre al reves ". strrev($nombre). "<br/>";

            } else {
                echo "<p style='color:red;'>Por favor, complete ambos campos.</p>";
            }
        }
    }

    obtenerDatosForm();

    ?>

</body>

</html>