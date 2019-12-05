<?php
	session_start();
	$mensaje ="";

	//si el usuario esta logueado, no puede entrar en esta pagina, sino que lo redirecciona hacia index.php
	//esto se hace para que el cliente no inicie sesion mas de una vez.
	if(isset($_SESSION["user_log"]))
		header("Location: index.php");
	
	//Si hay informaicon en $_POST
		if($_POST)
		{	
			//Abrir archivo. 1r parametro ruta al archivo, segundo modo lectura
			$canal = fopen("files/usuarios.txt", "r");

			//recogemos la informacion del input con name "user"
			$user = $_POST["user"];

			//recogemos la informacion del input con name "pass" y la encriptamos para despues compararla
			$pass = hash("sha512", $_POST["pass"]);

			//la instruccion "feof" — Comprueba si el puntero a un archivo está al final del archivo
			//el bucle se repite hasta que el puntero no se encuentre al final del archivo.
			while(!feof($canal))
			{
				//fgets — Obtiene una línea desde el puntero a un fichero 1;nombre;usuario;pass(encriptada)
				$line = fgets($canal);
				$datos = explode("|", $line); //convierte la linea de texto en un array con el delimitador "|"

				//Comparamos la informacion recibida con la del archivo usuarios.txt
				if($user==$datos[2] && $pass==$datos[3])
				{
					//iniciamos la sesion con un array donde ponemos el permiso de admin y el nombre de usuario.
					$_SESSION["user_log"] = [$datos[0], $datos[2]];

					//redireccionamos hacia index.php
					header("Location: index.php");
				}
			}

			$mensaje = "No existe ningun usuario con estos datos";
		}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<script type="text/javascript" src="js/jquery-3.4.0.min.js"></script>
	<script type="text/javascript" src="js/login.js"></script>
</head>
<body>

	<!-- es como hacer un llamado a una plantilla general del menu -->
	<?php require_once "templates/menu.php"; ?>

	<!-- Al dar click en entra, enviará los datos a "login.php", es decir, volvera a redireccionar hacia la misma pagina y se recogera la informacion de los input y se realizará la comprobacion necesaria para permitir el inicio de sesion -->
	<form action="login.php" method="POST" id="login">
		<ul>
			<li><input type="text" name="user" id="user" placeholder="Usuario"></li>
			<li><input type="password" name="pass" id="pass" placeholder="Contraseña"></li>
			<li><input type="submit" name="login" value="Entra"></li>
		</ul>
	</form>
	<p><?= $mensaje ?></p>
</body>
</html>