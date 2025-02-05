<?php
  // Start the session
  /**
   * Las variables de sesión no se pasan individualmente a cada nueva página,
   *  sino que se recuperan de la sesión que abrimos al principio de cada página (session_start()).
   */
  session_start();
?>
<!DOCTYPE html>
<html>
  <body>

  <?php
  // Establecer variables de sesión 
  $_SESSION["favcolor"] = "verde";
  $_SESSION["favanimal"] = "gato";
  echo "Variables de sesión establecidas.";
  ?>

  </body>
</html>