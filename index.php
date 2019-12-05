<?php
	session_start();
	require_once "funciones.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<title>Home</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/common.css">
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>
<body>	
	<?php require_once "templates/menu.php"; ?>
	<h1>Últimas Noticias</h1>
	<div class="wrapper">		
	<?php
		//Abrir archivo. 1r parametro ruta al archivo, segundo modo lectura
		$canal = fopen("files/noticias.txt", "r");
		$noticias = [];
		
		//la instruccion "feof" — Comprueba si el puntero a un archivo está al final del archivo
		//el bucle se repite hasta que el puntero no se encuentre al final del archivo.
		while(!feof($canal))
		{
			$line = fgets($canal);//31;65146641;Noticia 1;Noticia 1 texto
			$datos = explode(";", $line);//[31, 65146641, "Noticia 1", "Noticia 1 texto"]
			array_push($noticias, $datos); //se introduce $datos en el array $noticias que se ha creado anteriormente
		}

		//Esta variable hace que el array $noticias se ordene en modo inverso.
		$new_noticias = array_reverse($noticias);

		//for($i=0; $i<count($new_noticias); $i++)

		//recorremos el array $new_noticias y lo vamos pintado dentro de una etiqueta <a> para despues
		//redireccionarlo a "href=ampliada.php?id=$value[0]" enviando el id que se encuentra en $value[0]
		foreach($new_noticias as $value) 
		{
			echo "<a href=ampliada.php?id=$value[0]>";
				echo "<div class='noticia'>";
					echo "<p class='fecha'>".format_data($value[1])."</p>";
					echo "<p class='titulo'>".$value[2]."</p>";
				echo "</div>";
			echo "</a>";			
		}		

	?>
	</div>
</body>
</html>