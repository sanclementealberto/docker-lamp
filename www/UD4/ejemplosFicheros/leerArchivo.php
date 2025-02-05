<?php
  echo readfile("prueba.txt");
  echo file_get_contents("prueba.txt");
  echo "<br>";
  $filename = "prueba.txt";
  $file = fopen($filename, "r");

  while (($line = fgets($file)) !== false) {
    echo htmlspecialchars($line) . "<br>";
}
?>