<?php
	
	session_start();

	//Si el usario No tiene una sesion iniciada, lo redireccionará a index.php
	if(!isset($_SESSION["user_log"]))
		header("Location: login.php");
	

?>
<!DOCTYPE html>
<html>
<head>
	<title>Insertar</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="stylesheet" type="text/css" href="css/new.css">
	<script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
	<script type="text/javascript" src="js/new.js"></script>
</head>
<body>
	<?php require_once "templates/menu.php"; ?>

	<!-- Cuando le damos click en Insertar, enviamos al informacion de los input a add_new.php donde se insertara la noticia en el archivo de noticias.txt -->
	<form action="add_new.php" method="POST" id="insertar">
		<ul>
			<li><input type="text" name="titulo" id="titulo" placeholder="Título"></li>
			<li><textarea rows=15 cols=30 name="contenido" id="contenido" placeholder="Contenido"></textarea></li>
			<li><input type="submit" name="insertar" value="Insertar"></li>
		</ul>
	</form>
</body>
</html>