<html>
  <body>

  <?php
  //compruebo si el array $_COOKIE tiene mas de un valor
  if(count($_COOKIE) > 0) {
    echo "Las cookies están habilitadas.";
  } else {
    echo "Las cookies no están habilitadas.";
  }
  ?>

  </body>
</html>