<?php
	session_start();

	//si el usuario esta logueado, no puede entrar en esta pagina, sino que lo redirecciona hacia index.php
	//esto se hace para que el cliente no inicie sesion mas de una vez.
	if(isset($_SESSION["user_log"]))
	{
		header("Location: index.php");
	} 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registrate</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="stylesheet" type="text/css" href="css/sign-in.css">
	<script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
	<script type="text/javascript" src="js/sign-in.js"></script>
</head>
<body>
	<?php require_once "templates/menu.php"; ?>
	<div class="wrapper">

		<!-- Al dar click en Registrate, enviará los datos a "sign-in.php", es decir, volvera a redireccionar hacia la misma pagina y se recogera la informacion de los input y se realizará creacion del usuario y harña un inicio de sesion -->
		<form action="sign-in.php" method="POST" id="registro">
			<ul>
				<li><input type="text" name="nombre" placeholder="Nombre"></li>
				<li><input type="text" name="user" placeholder="Usuario"></li>
				<li><input type="password" name="pass" placeholder="Contraseña" id="pass"></li>
				<li><input type="password" name="repite_pass" placeholder="Repita contraseña" id="pass2"></li>
				<li><input type="submit" name="Enviar" value="Registrate"></li>
			</ul>
		</form>

	<?php

		//Si hay informaicon en $_POST
		if(isset($_POST["user"]))
		{
			//Abrir archivo. 1r parametro ruta al archivo, segundo modo añadir(add)
			$canal = fopen("files/usuarios.txt", "a");

			//si el tamaño del archivo en mayo que cero
			if(filesize("files/usuarios.txt")>0)
			{
				//La instruccion "PHP_EOL" es para introducir un salto de linea en el archivo
				$line = PHP_EOL."0|".$_POST["nombre"]."|".$_POST["user"]."|".hash('sha512', $_POST["pass"])."|";
			}
			else
			{
				$line = "0|".$_POST["nombre"]."|".$_POST["user"]."|".hash('sha512', $_POST["pass"])."|";
			}
			
			//añadimos la informacion de la variable $line en el archivo de usuarios.txt
			fputs($canal, $line);

			//iniciamos la sesion como sin permiso de administrador (0) y con el nombre de usuario.
			$_SESSION["user_log"] = [0, $_POST["user"]];

			//redireccionamos a la pagina index.php
			header("Location: index.php");
		}

	?>
	</div>
</body> 
</html>