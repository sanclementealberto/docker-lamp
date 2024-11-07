<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    $users=[
        "John"=>[
            "email"=> "john@demo.com",
            "website"=>"www.john.com",
            "age"=>"22",
            "password"=>"pass",

        ],
        "Anna"=> [
            "email"=> "anna@demo.com",
            "website"=> "www.anna.com",
            "age" =>"24",
            "password"=>"pass",
        ],
        "Peter"=>[
            "email" => "peter@mail.com",
            "webiste" =>"www.peter.com",
            "age"=>"42",
            "password" =>"pass",
        ],
        "Max"=>[
            "email"=>"max@mail.com",
            "webiste"=>"www.max.com",
            "age"=>"33",
            "password"=>"pass"
        ]
        ];

            //array multidimensional
    foreach( $users as $name => $info )
    {
        echo "Name $name <br/>";
        foreach($info as $key =>$value)
        {
            echo ucfirst($key). ": $value <br/>";
        }
        echo "<br/>";

    }


?>
</body>
</html>