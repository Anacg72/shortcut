<?php
include 'header.php';

function verificarDatos(){
  if(array_key_exists("submitted", $_POST)){
    if(array_key_exists("email", $_POST) && $_POST["email"]){

      $user["email"] = $_POST["email"];
      $user["password"] = $_POST["password"];

      $tmp = existeUsuarioSiExisteCambiarPassword($user, $user["password"]);
      
      if(!$tmp){
        echo "Usuario incorrecto";
      }
      else{
        header("Location: login.php");
      }


    }
  }
}

function existeUsuarioSiExisteCambiarPassword($usuario, $nuevaPwd) {
  $fileName = 'usuarios.json';
  $usuarios = json_decode(file_get_contents($fileName),true);

  if(!is_null($usuarios)) {
    foreach ($usuarios as $key => $usuarioEnArchivo) {
      if ($usuarioEnArchivo['email'] == $usuario['email']) {
        $usuarios[$key]["password"] = password_hash($nuevaPwd, PASSWORD_DEFAULT);
        file_put_contents($fileName, json_encode($usuarios, JSON_PRETTY_PRINT));
        return true;
      }
    }
  }

  return false;
}

verificarDatos();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="css/registerStyle.css" rel="stylesheet">
  <title>Olvide mi contraseña</title>
</head>
<body>

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