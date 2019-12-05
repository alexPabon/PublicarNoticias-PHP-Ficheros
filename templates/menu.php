<?php
	if(isset($_SESSION["user_log"])){?>
	<nav>
		<a href="index.php">Home</a>
		<div class="user-items">
			<p>Hola <?php echo $_SESSION["user_log"][1]; ?></p>
			<a href="new.php">Insertar</a>
			<a href="close.php">Cerrar sesión</a>
		</div>
	</nav>
	<?php }else{ ?>
	<nav>
		<a href="index.php">Home</a>
		<div class="user-items">
			<a href="login.php">Log-in</a>
			<a href="sign-in.php">Sig-in</a>
		</div>
	</nav>
	<?php } ?>
