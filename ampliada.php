<?php

	session_start();
	require_once "funciones.php";

	$modificarNoticia = "<a href='login.php'>Inicia sesion</a> o <a href='sign-in.php'>Registrate </a> para publicar noticias";

	//http://localhost/noticias/ampliada.php?id=30
	$id = $_GET["id"];

	//Abrir archivo. 1r parametro ruta al archivo, segundo modo lectura
	$canal = fopen("files/noticias.txt", "r");
	$noticia = [];

	//la instruccion "feof" — Comprueba si el puntero a un archivo está al final del archivo
	//el bucle se repite hasta que el puntero no se encuentre al final del archivo.
	while(!feof($canal)){
		//fgets — Obtiene una línea desde el puntero a un fichero 31;65146641;Noticia 1;Noticia 1 texto
		$line = fgets($canal);
		$datos = explode(";", $line); //[31, 65146641, "Noticia 1", "Noticia 1 texto"]

		//si coincide con la variable $id que recoge la info al principio
		if($datos[0]==$id){
			$noticia = $datos;
			break;
		}
	}

	//str_replace — Reemplaza todas las apariciones del string buscado con el string de reemplazo
	// y como $noticia[3] esta codificada con JSON, se sebe decodificar.
	$new_content = str_replace("\r", "<br>", json_decode($noticia[3]));

		//Si el usuario esta logueado, asi no mostrara un error cuando no este iniciada la sesion
		if(isset($_SESSION["user_log"]))
		{
			//Si el usuario es administrador, el array "$_SESSION["user_log"][0]" en la posicion cero del
			// archivo de usuarios.txt tendrá 1 de lo contrario tendrá 0
			if($_SESSION["user_log"][0]==1){				

				//Si el usuario es administrador, va a crear un formulario donde se editará la nociticia, al dar
				// click en update, enviará los datos a "update.php" donde se realizara los cambios necesario a la noticia
				$modificarNoticia = "<form action='update.php' method='POST'>";
					$modificarNoticia .= "<input type='hidden' value='$noticia[0]' name='id'>";
					$modificarNoticia .= "<label for='titulo'>Titulo de la Noticia</label><br><input type='text' name='titulo' value='$noticia[2]' id='titulo'>";
					$modificarNoticia .= "<textarea name='contenido'>".json_decode($noticia[3])."</textarea>";
					$modificarNoticia .= "<input type='submit' value='Actualizar' name='update'>";
				$modificarNoticia .= "</form>";

				//se crea input de forma oculta para guardar informacion para despues enviarla, en el momento de 
				//dar click en borrar, se envia la info de los input a "delete.php" para realizar los cambios de borrado
				$modificarNoticia .= "<form action='delete.php?id=$noticia[0]' method='POST'>";
					$modificarNoticia .= "<input type='hidden' value='$noticia[0]' name='id'>";
					$modificarNoticia .= "<input type='submit' value='Borrar noticia' name='borrar'>";
				$modificarNoticia .= "</form>";

				
			}else{
				$modificarNoticia = "<p>Para Editar o Borrar esta noticia, debes ser administrador</p>";
			}
		}

?>
<!DOCTYPE html>
<html>
<head>
	<!-- podemos escribrir el titulo de la noticia con php-->
	<title><?= $noticia[2];?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="stylesheet" type="text/css" href="css/ampliada.css">
</head>
<body>
	<!-- es como hacer un llamado a una plantilla general del menu -->
	<?php require_once "templates/menu.php"; ?>

	<div class="wrapper">
		<!-- Escribimos utilizando las posiciones del array de $noticias =[31, 65146641(fecha), "Noticia 1(Titulo)", "Noticia 1 texto(Contenido)"] -->
		<h1><?=$noticia[2];?></h1>
		<p class="fecha"><?= format_data($noticia[1]);?></p>
		<p class="contenido"><?= $new_content;?></p>
		<div class='marco'><?= $modificarNoticia ?></div>	
	</div>	
</body>
</html>