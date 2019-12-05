
<!-- En esta pagina, se realizara la actualizacion de la noticia si el usuario tiene permisos de administrador, guardando los cambios que se realizaron desde ampliada.php -->
<?php

	// recibimos la info desde ampliada.php
	$id = $_POST["id"];
	$new_title = $_POST["titulo"];
	$new_content = $_POST["contenido"];

	$noticias = [];

	//Abrir archivo. 1r parametro ruta al archivo, segundo modo lectura
	$canal = fopen("files/noticias.txt", "r");

	//la instruccion "feof" — Comprueba si el puntero a un archivo está al final del archivo
	//el bucle se repite hasta que el puntero no se encuentre al final del archivo.
	while(!feof($canal))
	{
		//fgets — Obtiene una línea desde el puntero a un fichero 31;65146641;Noticia 1;Noticia 1 texto
		//"trim()" es para eliminar los espacios en blanco de los extremos de la linea
		$line = trim(fgets($canal));
		$datos = explode(";", $line); //convierte la linea de texto en un array con el delimitador ";"

		//si el id es diferente de $id recibido desde ampliada.php
		if($datos[0] != $id)
		{
			//añade la linea en el array de $noticias
			array_push($noticias, $line);
		}
		else
		{
			//si son iguales realiza los cambios, añadiendo la info recibida desde ampliada.php
			//Cambiamos el titulo de la noticia
			$datos[2] = $new_title;
			//Cambiamo el contenido y ademas lo convertimos a JSON			
			$datos[3] = json_encode($new_content);
			//convertimos el arrya en una cadena de texto con delimitador ";"
			$new_data = implode(";", $datos);
			//añade la linea en el array de $noticias
			array_push($noticias, $new_data);
		}
	}

	//Cierra el archivo noticias.txt
	fclose($canal);

	//Abrir archivo. 1r parametro ruta al archivo, segundo modo escritura
	$canal = fopen("files/noticias.txt", "w");
	//creamo un contador
	$first = 0;

	foreach ($noticias as $value) 
	{
		//si $first es igual a cero, escribimos la linea sin salto de linea 
		if($first==0)
		{
			fputs($canal, $value);
		}
		else
		{
			//con salto de linea "PHP_EOL" 
			fputs($canal, PHP_EOL.$value);
		}
		$first++;
	}

	//Redirecciona hacia la pagina ampliada.php?id=$id y ademas enviamo el id para volver a cargar la noticias
	// con los nuevos cambios.
	header("Location: ampliada.php?id=$id");

?>