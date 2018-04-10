<?php
  if (session_status() == PHP_SESSION_NONE) {
      session_start();
  }
  
  function verificarCierreSesion(){
    if(array_key_exists("cerrarSesion", $_POST)){
      session_destroy();
      header("Location: login.php");
      exit;
    }
  }

  function verificarUsuarioLogueado(){
    if(!isset($_SESSION["usuario"])){
      header("Location: login.php");
    } else
    {
      return $_SESSION["usuario"];
    }

  }

  verificarCierreSesion();
  $message =  verificarUsuarioLogueado();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="css/registerStyle.css" rel="stylesheet">
  <title>Registrarse</title>
</head>
<body>
  <?php include 'header.php' ?>

  <br>
  <div class=mainContainer>  
    <div class="container">
      <div class="container">
        <div class="profile">
          <?php if($message["entidad"] == "freelancer") : ?>

            <h2 class="contact">PERFIL DE FREELANCER</h1>  
            <img src= <?=$message["avatar"] ?> height="170" width="296">             
            <h3>Nombre: <?=$message["nombre"] ?></h3>
            <h3>Apellido: <?=$message["apellido"] ?></h3>
            <h3>Género: <?=$message["genre"] ?></h3>
            <h3>Fecha de nacimiento: <?=$message["birthdate"] ?></h3>

          <?php else : ?>

            <h2 class="contact">PERFIL DE COMPANIE</h1>  
            <img src= <?=$message["avatar"] ?> height="170" width="296">             
            <h3>Nombre: <?=$message["nombre_empresa"] ?></h3>

          <?php endif; ?>
        </div>
      </div>
      <form autocomplete="off" method="post" enctype="multipart/form-data" style="margin-top: 25px;"">
        <div class="botones">
            <a href="manageAcc.php" class="Button" style="text-decoration:none; margin-bottom: 40px;" > Editar perfil </a>
        </div>
        <button type="submit" name="cerrarSesion" class="Button">Cerrar sesión</button>
      </form>

    </div>

</body>
</html>