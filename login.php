<?php
  include 'header.php';

 if (session_status() == PHP_SESSION_NONE) {
      session_start();
  }

  function verificarSiExisteSesion(){
    if(isset($_SESSION["usuario"])){
      header("Location: profile.php");
    }
  }


  function imprimir($aux){
    echo "<pre>"; var_dump($aux); echo "</pre>";
  }

  function verificarDatos(){
    if(array_key_exists("submitted", $_POST)){
      if(array_key_exists("email", $_POST) && $_POST["email"]){
        
        $user["email"] = $_POST["email"];
        $user["password"] = $_POST["password"];


        $tmp = existeUsuario($user);
        if(!$tmp["existe"]){
          echo "Usuario incorrecto";
        }else if(!password_verify($user["password"], $tmp["user"]["password"])){
          echo "Contraseña incorrecta";
        }else
        {
          //---------------INICIO DE SESION------------------//
          $_SESSION["usuario"] = $tmp["user"];
          header("Location: profile.php");
        }

      }
    }
  }
  
  function existeUsuario($usuario) {
  $usuarios = json_decode(file_get_contents('usuarios.json'),true);

  $user = null;
  $existe = false;

  if(!is_null($usuarios)) {
    foreach ($usuarios as $key => $usuarioEnArchivo) {

      if ($usuarioEnArchivo['email'] == $usuario['email']) {
        $existe = true;

        $user = $usuarioEnArchivo;
          
      }
    }

  }

  return [
    'user' => $user,
    'existe'  => $existe
  ];
}

  verificarSiExisteSesion();
  verificarDatos();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="css/registerStyle.css" rel="stylesheet">
  <title>Iniciar sesión</title>
</head>
<body>

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