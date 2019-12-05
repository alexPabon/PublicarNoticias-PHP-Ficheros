
<!-- En esta pagina, se realiza el proceso de cerra la sesion -->
<?php
	
	session_start();
	unset($_SESSION["user_log"]);
	session_destroy();
	header("Location: index.php");

?>