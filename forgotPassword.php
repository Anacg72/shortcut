<?php

require_once('ModifierManager.php');

$modifManager = new ModifierManager();

if(isset($_POST['submitted'])){
  if(isset($_POST['email']) && $_POST['email'] && isset($_POST['password']) && $_POST['password']){ 

    try{
      if($_GET['reg'] == 'freelancer'){
        $modifManager->ActualizarContraseñaFreelancerDB($_POST["email"], $_POST["password"]);
      } else {
        $modifManager->ActualizarContraseñaCompanieDB($_POST["email"], $_POST["password"]);
      }
      NavegationManager::GoToLogin();
    }

    catch(PDOException $e){
      echo "Usuario incorrecto.";
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

     <div class="mainContainer">  
      <div class="container">
        <form method="get">
          <select name="reg">
            <option value="companie" <?php if(array_key_exists('reg', $_GET) && $_GET['reg'] == 'companie') echo "selected" ?>>Como empresa</option>
            <option value="freelancer" <?php if(array_key_exists('reg', $_GET) && $_GET['reg'] == 'freelancer') echo "selected" ?>>Como freelancer</option>
          </select>

          <button type="submit">Cambiar</button>

        </form>
      </div>


      <form method="post" action="forgotPassword.php?reg=<?=$_GET['reg']?>" class="registerForm">
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