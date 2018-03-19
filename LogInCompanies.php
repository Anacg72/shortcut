<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="css/registerStyle.css" rel="stylesheet">
  <title>Registrarse</title>
</head>
<body>
   <form action="registerCompanies.php" method="get" class="registerForm">
    <div class="container">
      <label for="nombre">Nombre de la Empresa</label>
      <input type="text" name="nombre_empresa" placeholder="Nombre de la empresa" required= 1>
    </div>
    <br>
    <div class="container">
      <label for="email"> Email </label>
      <input type="email" name="mail" placeholder="Ingrese Email" required = 1>
      <br>
    </div>

    <div class="container">
      <label for='password' >Contaseña:</label>
      <input type='password' name='password' id='password' placeholder="Contraseña" maxlength="50" required = 1 />
    </div>
    <br>
    <div class="container">
      <label for='confirmpassword' >Confirmar Contraseña:</label>
      <div class='pwdwidgetdiv' id='thepwddiv' ></div>
      <input type='password' name='confirmpassword' id='confirmpassword' placeholder="Confirme contraseña" maxlength="50" required = 1/>
    </div>
  </div>


  <br>
  <div class="botones">
    <button class="Button" type="submit"> Enviar </button>
  </div>
  <br>
  <div class="botones">
    <a href="index.php" class="Button" style="text-decoration:none;" >  Volver al home </a>
  </div>


</form>
</body>
</html>