<h1>Aplicacion web para publicar noticias</h1>
<p>
	<b>PHP</b> dispone de una gran cantidad de funciones para realizar todo tipo de operaciones con ficheros y carpetas, desde las más básicas como crear ficheros y carpetas, modificar, eliminar, hasta otras más avanzadas para obtener y asignar permisos, crear enlaces simbólicos, etc.<br><br>
	Aquí veremos cómo realizar algunas de las tareas que más usualmente se realizan sobre ficheros y carpetas en PHP.<br><br>
	Al realizar operaciones con las funciones de ficheros y directorios es recomendable comprobar que se ha realizado de forma correcta. Por ejemplo, si necesitamos averiguar si existe un fichero o carpeta se puede utilizar la función file_exists(), que nos devolverá true si existe y false de lo contrario.
</p>

<h2> Abrir y cerrar ficheros</h2>
<p>
	<b>FOPEN</b><br>
	La función fopen(path, mode) permite abrir un fichero local o mediante un URL. 	
</p>
<ul>
	<li>El path del fichero debe incluir la ruta completa al mismo. </li>
	<li>El mode puede ser r - lectura, w - escritura, a - agregar, o x - escritura exclusiva.</li>
	<li>Se puede agregar un + al modo y si el fichero no existe, se intentará crear.</li>
</ul>
<p>
	<b>FCLOSE</b><br>
	La función fclose(file) cierra un puntero a un fichero abierto. Esto es, Una vez hayamos terminado de realizar las operaciones deseadas con el archivo es necesario cerrarlo usando la función fclose(), que escribirá en él los cambios pendientes en el buffer (memoria en la que se guardan los datos antes de ir escribiéndolos).<br><br>
	<b>Nota:</b><br>los sistemas Windows usan \r\n como caracteres de final de línea, los basados en UNIX usan \n y los sistemas basados en sistemas MACintosh usan \r <br><br>
	<b>FEOF</b><br>
	La función feof(file) comprueba si el puntero a un fichero se encuentra al final del fichero.<br><br>
	<b>FGETS</b><br>
	La función fgets(file) obtiene una línea desde el puntero a un fichero.<br><br>
	<b>FILE_EXISTS</b><br>
	La función file_exists(file) comprueba si existe un fichero o directorio.<br><br>
	<b>FSCANF</b><br>
	La función fscanf analiza la entrada desde un fichero de acuerdo a un formato. Los tipos más importantes son:
</p>
<ul>
	<li>%d - entero</li>
	<li>%f - flotante</li>
	<li>%s - string</li>
</ul>
<p>
	Un detalle importante es que %s no reconoce filas de texto con espacios en blanco, únicamente palabras completas.<br>
	Algunas funciones para obtener información de un fichero 
	Algunas funciones que nos brindan información sobre un fichero son:
</p>
<ul>
	<li><b>filesize</b> - devuelve el tamaño de un fichero en bytes. </li>
	<li><b>filetype</b> - devuelve el tipo de fichero de que se trata: file, dir, block, char, fifo, link o unknown.</li>
	<li><b>filemtime</b> - devuelve la fecha y hora de la última modificación del fichero, en formato UNIX Timestamp. </li>
	<li><b>fileperms</b> - devuelve la máscara de permisos (en sistemas UNIX).</li>
	<li><b>stat y fstat</b> - devuelven información sobre un fichero abierto con fopen.</li>
</ul>
<p>
	La diferencia entre ellas es que a stat se le pasa como parámetro el nombre del fichero, y a fstat el recurso obtenido con fopen.<br><br>
	<b>Leyendo ficheros</b><br>
	Las funciones fread y fwrite leen y escriben, respectivamente, en un archivo en modo binario. 
	La función fseek posiciona el puntero del archivo.<br><br>
	<b>FILE</b><br>
	Otra forma de leer archivos de texto es utilizar la función file. Esta función transfiere un fichero completo a un array.<br>
	Note que no es necesario abrir el archivo (fopen) para utilizar este función.
</p>
<h2>Como funciona esta web</h2>
<p>
	Esta aplicación web se crea con la intensión de mostrar las ultimas noticias escritas por los usuarios, aquí se mostrará de forma descendente, es decir, que la última noticia publicada, se podrá ver en la parte superior de la pagina y la noticia más antigua, en la parte inferior de la pantalla. En cada noticia se podrá ver:
</p>
<ul>
	<li>Titulo de la noticia</li>
	<li>Fecha de publicación</li>
	<li>Breve contenido de la noticia</li>
</ul>
<p>
	Cuando damos click en la noticia, se abrirá la notica ampliada, mostrando todo el contenido, si el usuario es administrador, también podrá ver un formulario para editar y borrar dicha noticia.<br><br>
	En la parte superior se encuentra un menú general que puede llevarnos a la página principal, iniciar sesión y registrarse. Una vez iniciada la sesión, en el menú se encontrara un breve saludo al usuario, una opción para insertar una nueva noticia y la opción de cerrar sesión.
</p>