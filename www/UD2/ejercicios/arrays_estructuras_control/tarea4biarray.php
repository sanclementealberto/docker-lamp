<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $informacion = "Tokyo,Japan,Asia;Mexico City,Mexico,North America;New York City,USA,North America;
Mumbai,India,Asia;Seoul,Korea,Asia;Shanghai,China,Asia;Lagos,Nigeria,Africa;Buenos Aires,Argentina,South America;Cairo,Egypt,Africa;London,UK,Europe";

    $ciudad = [
        "tokyo" => [
            "continente" => "Asia",
            "pais" => "Japan",
        ],
        "mexico City" => [
            "continente" => "North America",
            "pais" => "Mexico",
        ],
        "New York City" => [
            "continente" => "North America",
            "pais" => "USA",

        ],
        "Mumbai" => [
            "continente" => "Asia",
            "pais" => "India"
        ],
        "Seoul" => [
            "continente" => "Asia",
            "pais" => "Korea",
        ],
        "Shanghai" => [
            "continente" => "Asia",
            "pais" => "China",
        ],
        "Lagos" => [
            "continente" => "Africa",
            "pais" => "Nigeria",
        ],
        "Buenos Aires" => [
            "continente" => "South America",
            "pais" => "Argentina",
        ],
        "Cairo" => [
            "continente" => "Africa",
            "pais" => "egypt",
        ],
        "London" => [
            "continente" => "Europe",
            "pais" => "UK",
        ]
    ];


    ?>

    <table border="1">
        <thead>
            <tr>
            <th>Ciudad</th>
            <th>Pais</th>
            <th>COntinente</th>
            </tr>
        </thead>
        <?php if (!empty($ciudad)): ?>
            <?php foreach ($ciudad as $key => $value): ?>

                <tr>
                    <td><?php echo htmlspecialchars($key); ?></td>
                    <td><?php echo htmlspecialchars($value["pais"]); ?></td>
                    <td><?php echo htmlspecialchars($value["continente"]); ?></td>

                </tr>
            <?php endforeach; ?>
        <?php endif; ?>

    </table>
</body>

</html>