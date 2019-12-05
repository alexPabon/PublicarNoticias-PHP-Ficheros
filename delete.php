
<!-- En esta pagina se realiza el borrado de la noticia. Al recibir la informacion por medio
de "$_POST["id"]", procedera a buscar el id en el archivo para borrarlo -->
<?php
	
	$id = $_POST["id"];
	$noticias = [];
	//este contador es para despues reescribir la id del archivo de noticias.txt
	$contador = 1;

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

		//si el id es diferente al $id recibido
		if($datos[0]!=$id)
		{
			//reescribimos $datos[0] con el contador
			$datos[0] = $contador;
			$new_data = implode(";", $datos);
			//añadimos la nueva informacion al array de $noticias
			array_push($noticias, $new_data);
			$contador++;
		}
	}

	//cerramos archivo
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

	//Redirecciona hacia la pagina index.php
	header("Location: index.php");

?>