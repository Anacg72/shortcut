<?php

require_once('Freelancer.php');

$registerManager = new registerManager();
$usuario = new Freelancer();

if($usuario->correctamenteSeteado()){
  $registerManager->VerificarFormularioYGuardarUsuario($usuario);
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
  <div class="backgroundDiffuse">
    <div class="container">
      <label for="nombre"> Nombre</label>
      <input type="text" name="nombre" placeholder="Ingrese nombre..." required 
      value= <?php if(array_key_exists("nombre", $_POST)) echo $_POST["nombre"]; ?> >
      <br>
      <label for="apellido">Apellido</label>
      <input type="text" name="apellido" placeholder="Ingrese apellido..." required value= <?php if(array_key_exists("apellido", $_POST)) echo $_POST["apellido"]; ?> >
    </div>
    <div class="container">
      <br>
      <label for="email"> Email </label>
      <input type="email" name="email" placeholder="Ingrese Email..." required value= <?php if(array_key_exists("email", $_POST)) echo $_POST["email"]; ?>>	
    </div>
    <br>

    <div class="container">
      <label for='password' >Contaseña:</label>
      <input type='password' name='password' id='password' placeholder="Ingrese contraseña..." maxlength="50" required />
    </div>                      
    <br>
    <div class="container">
      <label for="sexos" class="aches">Género</label>
      <div class="sexos" id="sexos">
        <input id="masc" type="radio" name="genre" value= "masculino" checked>
        <label for="masc"> Masculino </label><br>
        <input id="fem" type="radio" name="genre" value= "femenino">
        <label for="fem"> Femenino </label>
      </div> 

    </div>

    <br>
    <div class="container">                      
      <label for="fecha"> Fecha de Nacimiento </label>
      <input type="date" name="birthdate" min="1900-03-25"
      max="2018-05-25" step="1" value= <?php if(array_key_exists("birthdate", $_POST)) echo $_POST["birthdate"]; ?> required>
    </div> 

    <br>
    <div class="container">
      <label for="avatar">Avatar</label>
      <input type="file" class="form-control" name="avatar" required>
    </div>

  </div>
  <input type="hidden" name="entitie" value="freelancer">

</div>

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