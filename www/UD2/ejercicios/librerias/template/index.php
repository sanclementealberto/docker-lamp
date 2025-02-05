<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Web Portal - Includes and requires</title>
	<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
</head>
<body>

<div id="header" class="container">
	<p>hola</p>

<?php include("./logo.php");
logo() ;?>
	
	<?php include("./menu.php");
 echo menu() ;?>

	
</div>

<?php include("./pictures.php");
echo pictures() ;?>

<div id="page">
	<div id="bg1">
		<div id="bg2">
			<div id="bg3">
			
				<?php include("./content.php");
				echo content() ;?>
				
				<?php include("./sidebar.php");
				echo sideBar();?>
				
			</div>
		</div>
	</div>
</div>

<?php include("./footer.php") ;
echo footer() ;?>
</body>
</html>
