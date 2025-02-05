<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
$a = "true"; // imprime el valor devuelto por is_bool($a)...
 echo is_bool($a) ;
$b = 0; // imprime el valor devuelto por is_bool($b)...; y se entra dentro de if($b) {...}
 echo is_bool($b) ? "{....}": "...";

$c = "false";
    echo gettype($c); // imprime el valor devuelto por gettype($c);
$d = ""; // el valor devuelto por empty($d);
    echo empty($d);
$e = 0.0; // el valor devuelto por empty($e);
    echo empty($e) ;
$f = 0; // el valor devuelto por empty($f);
    echo empty($f);
$g = false; // el valor devuelto por empty($g);
    echo empty($g) ;
$h; // el valor devuelto por empty($h);
    echo empty($h) ;
$i = "0"; // el valor devuelto por empty($i);
    echo empty($i) ;
$j = "0.0"; // el valor devuelto por empty($j);
    echo empty($j);
$k = true; // el valor devuelto por isset($k);
    echo isset($k);
$l = false; // el valor devuelto por isset($l);
    echo isset($l);
$m = true; // el valor devuelto por is_numeric($m);
    echo is_numeric($m);
$n = ""; // el valor devuelto por is_numeric($n);
    echo is_numeric($n);

    phpinfo();
    ?>
    
</body>
</html>