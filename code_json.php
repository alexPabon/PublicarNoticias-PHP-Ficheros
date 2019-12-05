
<!-- se realiza la codificacion a JSON el archivo de noticias.txt porque al no estar codificado
puede generar errores cuando se pide que transforme un archivo de JSON a texto normal -->
<?php
	
	//Abrir archivo. 1r parametro ruta al archivo, segundo modo lectura
	$canal = fopen("files/noticias.txt", "r");
	$noticias = [];

	while(!feof($canal))
	{
		$line = fgets($canal);
		$datos = explode(";", $line);
		$datos[3] = json_encode($datos[3]);
		$new_data = implode(";", $datos);
		array_push($noticias, $new_data);
	}

	//cierra el archivo
	fclose($canal);

	//Abrir archivo. 1r parametro ruta al archivo, segundo modo escritura
	$canal = fopen("files/noticias.txt", "w");
	//creamos un contador
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

?>