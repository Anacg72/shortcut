<?php

require_once('ModifierManager.php');

$modifManager = new ModifierManager();

if(isset($_POST['submitted'])){
  var_dump($_POST);
  if(isset($_POST['email']) && $_POST['email'] && isset($_POST['password']) && $_POST['password']){
    echo "ECHO";
    if($modifManager->cambiarContraseñaUsuarioPorEmail($_POST['email'], $_POST['password'])){
      NavegationManager::GoToLogin();
    } else {
      echo 'Usuario incorrecto';
    }
  }
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="css/registerStyle.css" rel="stylesheet">
  <title>Olvide mi contraseña</title>
</head>
<body>

  <?php include 'header.php'; ?>

  <br>
  <div class=mainContainer>  
    <div class="container">  
     <h2 class="contact""> OLVIDE MI CONTRASEÑA </h2>


     <form method="post" class="registerForm">
      <div class="backgroundDiffuse">
        <div class="container">
          <br>
          <label for="email"> Email </label>
          <input type="email" name="email" placeholder="Ingrese Email..." required = 1 value=<?php if(array_key_exists("email", $_POST)) echo $_POST["email"]; ?> >  
        </div>
        <br>

        <div class="container">
          <label for='password' >Nueva contaseña:</label><br/>
          <input type='password' name='password' id='password' placeholder="Ingrese contraseña..." maxlength="50" required = 1 />
        </div>
      </div>
    </div>

  </div>

  <br>
  <div class="botones">
    <button class="Button" type="submit" name="submitted"> Cambiar contraseña </button>
  </div>
  <br>
  <div class="botones">
    <a href="index.php" class="Button" style="text-decoration:none;" >  Volver al home </a>
  </div>

</form>


</body>
</html>