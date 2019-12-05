<?php
	
	//isset — Determina si una variable está definida y no es NULL
	if(isset($_POST["contenido"])){
		//Abrir archivo. 1r parametro ruta al archivo, segundo modo lectura
		$canal = fopen("files/noticias.txt", "r");
		$contador = 1;

		//la instruccion "feof" — Comprueba si el puntero a un archivo está al final del archivo
		//el bucle se repite hasta que el puntero no se encuentre al final del archivo.
		while(!feof($canal)){
			//fgets — Obtiene una línea desde el puntero a un fichero
			$line = fgets($canal);
			$contador++;
		}

		//cierra el archivo
		fclose($canal);

		//Abrir archivo. 1r parametro ruta al archivo, segundo modo añadir(add)
		$canal = fopen("files/noticias.txt", "a");
		if(filesize("files/noticias.txt")>0){
			//La instruccion "PHP_EOL" es para introducir un salto de linea en el archivo
			//la instruccion "json_encode()" es para convertir en JSON (formato de texto sencillo para el intercambio de datos)
			$line = PHP_EOL.$contador.";".time().";".$_POST["titulo"].";".json_encode($_POST["contenido"]);
		}else{
			$line = $contador.";".time().";".$_POST["titulo"].";".json_encode($_POST["contenido"]);
		}

		//Añade la variab $line en la variable $canal (archivo noticias)
		fputs($canal, $line);
		//cierra el archivo
		fclose($canal);
		//Redirecciona hacia la pagina index.php
		header("Location: index.php");
	}
	else{
		header("Location:index.php");
	}

?>