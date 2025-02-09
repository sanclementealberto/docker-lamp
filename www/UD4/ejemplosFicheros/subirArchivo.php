<!DOCTYPE html>
<html>
  <body>

    <form action="" method="post" enctype="multipart/form-data">
      Selecciona fichero para subir:
      <input type="file" name="fileToUpload" id="fileToUpload">
      <input type="submit" value="Subir Imagen" name="submit">
    </form>

    <?php
 
    //IMPORTANTE DAR PERMISOS DE ESCRITURAA Y sudo chmod -R 777 ~/Desktop/repositorios/docker-lamp con -R recursivo a todos los que estan dentro de eso directorio

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Definir la carpeta de destino
        $target_dir = "uploads/";

        // Crear la carpeta si no existe
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Obtener la ruta completa del archivo
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Verificar si se ha subido un archivo
        if (!isset($_FILES["fileToUpload"]) || $_FILES["fileToUpload"]["error"] != 0) {
            echo "Error: No se ha seleccionado ningún archivo o ha ocurrido un error.";
            $uploadOk = 0;
        }

        // Verificar si el archivo ya existe
        if (file_exists($target_file)) {
            echo "Error: El fichero ya existe.";
            $uploadOk = 0;
        }

        // Verificar el tamaño del archivo (máximo 500 KB)
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Error: El archivo es demasiado grande.";
            $uploadOk = 0;
        }

        // Permitir solo ciertos formatos de imagen
        $allowed_types = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($imageFileType, $allowed_types)) {
            echo "Error: Solo los archivos JPG, JPEG, PNG y GIF están permitidos.";
            $uploadOk = 0;
        }

        // Subir el archivo si todas las validaciones son correctas
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "El fichero <strong>" . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . "</strong> ha sido subido correctamente.";
            } else {
                echo "Error: Hubo un problema al subir el archivo.";
            }
        }
    }
    ?>

  </body>
</html>
