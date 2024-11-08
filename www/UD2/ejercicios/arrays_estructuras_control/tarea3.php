<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php

    for ($i = 0; $i <= 30; $i++) {
        echo rand(0, 20) . "<br/>";
    }

    $personajes = ["batman", "superman", "kryst", "bob", "mel", "barney"];

    function eliminarUltimaposicion($matriz)
    {
        for ($i = 0; $i < count($matriz) - 1; $i++) {
            echo $matriz[$i] . "<br/>";
            //con array_pop tambien se puede
            // echo array_pop($matriz);
        }
    }
    eliminarUltimaposicion($personajes);



    function imprimirPosSuperman($matriz)
    {
        $i = 0;
        while ($i < count($matriz)) {
            if ($matriz[$i] === "superman") {
                echo "$i en esta posicion esta superman | $matriz[$i]";
                return;
            }

            $i++;
        }
    }

    imprimirPosSuperman($personajes);


    $arrayNuevo = ["Carl", "lenny", "Burns", "Lisa"];

    echo "<br/>";
    function agregarFinalArray($matrizInicial, $arrayAñadido)
    {

        foreach ($arrayAñadido as $valor) {
            //array_push agrega los elementos al fina ldel array
            array_push($matrizInicial, $valor);
        }

        echo implode(",", $matrizInicial);
    }



    agregarFinalArray($personajes, $arrayNuevo);
    $matrizFruta=['APple','Melon','Watermelon'];

    function agregarInicioArray($matrizInicial, $arrayAñadido)
    {


        foreach ($arrayAñadido as $valor) {
            //agrega nuevos elementos al final del array
            array_unshift($matrizInicial, $valor);
        }
        //separa cada elemento del array mediante una coma y lo copia
    echo implode(", ",$matrizInicial);
    echo "<br/>";
    }
    

    agregarInicioArray($personajes,$matrizFruta);

    //crea una copia del array desde el indice 3 y toma los elementos
    $copia =array_slice($personajes,3,3);

    ?>
</body>

</html>