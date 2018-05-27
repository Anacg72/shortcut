<?php

require_once('Companie.php');

$registerManager = new registerManager();
$usuario = new Companie();

if($usuario->correctamenteSeteado()){  
  $registerManager->GuardarUsuarioEnBD($usuario);
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="css/registerStyle.css" rel="stylesheet">
  <title>Registrarse</title>
</head>
<body>
 <form method="post" class="registerForm" enctype="multipart/form-data">
  <div class="container">
    <label for="nombre">Nombre de la Empresa</label>
    <input type="text" name="nombre_empresa" placeholder="Nombre de la empresa" required>
  </div>
  <br>
  <div class="container">
    <label for="email"> Email </label>
    <input type="email" name="email" placeholder="Ingrese Email" required>
    <br>
  </div>

  <div class="container">
    <label for='password' >Contaseña:</label>
    <input type='password' name='password' id='password' placeholder="Contraseña" maxlength="50" required />
  </div>
  <br>
  <div class="container">
    <label for="avatar">Avatar</label>
    <input type="file" class="form-control" name="avatar" required>
  </div>
</div>

<input type="hidden" name="entitie" value="companie">

<br>
<div class="botones">
  <button class="Button" type="submit" name="submitted"> Enviar </button>
</div>
<br>
<div class="botones">
  <a href="index.php" class="Button" style="text-decoration:none;" >  Volver al home </a>
</div>


</form>
</body>
</html>