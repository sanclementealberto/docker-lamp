<!DOCTYPE html>
<html>
  <body>

    <form action="upload.php" method="post" enctype="multipart/form-data">
      Selecciona fichero para subir:
      <input type="file" name="fichero" id="fichero">
      <input type="submit" value="Upload Image" name="submit">
    </form>




  </body>

</html>
<?php
  $target_dir = "uploads/";
  $target_file = $target_dir . basename($_FILES["fichero"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

  if (!file_exists($target_file))
  {
      if ($_FILES["fichero"]["size"] > 500000)
      {
          if (
            $imageFileType != "jpg"
            && $imageFileType != "png"
            && $imageFileType != "jpeg"
            && $imageFileType != "gif" )
          {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file))
            {
                echo "El fichero ". htmlspecialchars( basename( $_FILES["fichero"]["name"])). "ha sido subido.";
            }
            else
            {
                echo "Hubo un error subiendo el fichero";
            }
          }
          else
          {
              echo "Solo los ficheros JPG, JPEG, PNG & GIF están permitidos.";
          }
      }
      else
      { 
          echo "El archivo es demasiado grande.";
      }
  }
  else
  { 
      echo "El fichero ya existe";
  }
?>