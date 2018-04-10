<?php

	if (session_status() == PHP_SESSION_NONE) {
    	session_start();
	}

	if(isset($_GET["cerrarSesion"])){
		session_destroy();
		header("Location: login.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="./css/simpleResetCode.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="./css/headerStyle.css">
</head>
<body>
	<div class="headerContainer">
	<div class="header">
		<div class="topleft">
			<h1 class="tittle">
				<a href="./index.php" class="tittleLink">SHORTCUT</a>
			</h1>
			<nav class="nav">
				<ul class="nav_list">
					<li><a href="#" class="nav_a">Buscar proyecto</a></li>
					<li><a href="#" class="nav_a">Encontrar freelancers</a></li>
					<li><a href="./faq2.php" class="nav_a">Como funciona</a></li>					
				</ul>
			</nav>
		</div>

		<div class="useroptions">
			<nav class="nav">				
				<ul class="registro">
					<?php if(!isset($_SESSION["usuario"])) : ?>
					<li><a href="./login.php" class="nav_a">Iniciar sesión</a></li>
					<li><a href="./register.php" class="nav_a">Registrarse</a></li>
				<?php else : ?>
					<li><a href="./profile.php" class="nav_a">Perfil</a></li>
					<li><a href="./header.php?cerrarSesion" class="nav_a">Cerrar Sesión</a></li>
				<?php endif; ?>
				</ul>
			</nav>
		</div> 	
	</div> 
	</div> 
</body>
</html>