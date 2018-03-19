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
     <h2 class="contact""> INICIAR SESIÓN </h2>


    <form action="" method="post" class="registerForm">
    <div class="backgroundDiffuse">
      <div class="container">
        <br>
        <label for="email"> Email </label>
        <input type="email" name="mail" placeholder="Ingrese Email..." required = 1>  
      </div>
      <br>

      <div class="container">
        <label for='password' >Contaseña:</label><br/>
        <input type='password' name='password' id='password' placeholder="Ingrese contraseña..." maxlength="50" required = 1 />
      </div>

      <br>
      <div class="rememberCheckbox">
        <input type="checkbox" name="remember" value="1" class=""><b>Recuérdame...</b>
      </div>


      <div class="container">
        <a href="#" style="text-decoration: none;">Olvidé mi contraseña.</a>
      </div>
    </div>
  </div>

  </div>

  <br>
  <div class="botones">
    <button class="Button" type="submit"> Iniciar sesión </button>
  </div>
  <br>
  <div class="botones">
    <a href="index.php" class="Button" style="text-decoration:none;" >  Volver al home </a>
  </div>

</form>


</body>
</html>