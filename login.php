<?php

require_once('SessionManager.php');
require_once('LoginManager.php');

SessionManager::AbrirSession();
SessionManager::VerificarSessionYReedirigirAlPerfil();

if(array_key_exists('submitted', $_POST)){
    $loginManager = new LoginManager();
    $loginManager->verificarDatos();
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="css/registerStyle.css" rel="stylesheet">
  <title>Iniciar sesión</title>
</head>
<body>

  <?php include 'header.php'; ?>

  <br>
  <div class=mainContainer>  
    <div class="container">  
     <h2 class="contact""> INICIAR SESIÓN </h2>


     <form method="post" class="registerForm">
      <div class="backgroundDiffuse">
        <div class="container">
          <br>
          <label for="email"> Email </label>
          <input type="email" name="email" placeholder="Ingrese Email..." required = 1 value=<?php if(array_key_exists("email", $_POST)) echo $_POST["email"]; ?> >  
        </div>
        <br>

        <div class="container">
          <label for='password' >Contaseña:</label><br/>
          <input type='password' name='password' id='password' placeholder="Ingrese contraseña..." maxlength="50" required = 1 />
        </div>

        <br>
        <div class="rememberCheckbox">
          <input type="checkbox" name="remember" value="1" class="" disabled=""><b>Recuérdame...</b>
        </div>


        <div class="container">
          <a href="./forgotPassword.php" style="text-decoration: none;">Olvidé mi contraseña.</a>
        </div>
      </div>
    </div>

  </div>

  <br>
  <div class="botones">
    <button class="Button" type="submit" name="submitted"> Iniciar sesión </button>
  </div>
  <br>
  <div class="botones">
    <a href="index.php" class="Button" style="text-decoration:none;" >  Volver al home </a>
  </div>

</form>


</body>
</html>