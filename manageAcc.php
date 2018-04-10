<?php
function guardarArchivoSubido($nombreDelInputFile) {
  if (array_key_exists($nombreDelInputFile, $_FILES)) {
    $file = $_FILES[$nombreDelInputFile];

    $nombre = $file['name'];
    $tmp = $file['tmp_name'];
    $ext = pathinfo($nombre, PATHINFO_EXTENSION);

    $carpetaDondeEstoy = dirname(__FILE__);
    $carpetaDondeQuieroGuardar = $carpetaDondeEstoy . "/archivos/";

    if(!file_exists($carpetaDondeQuieroGuardar)) {
      $old = umask(0);
      mkdir($carpetaDondeQuieroGuardar, 0777);
      umask($old);
    }

    $date = new DateTime();

    $urlFinalConNombreYExtension = "./archivos/imagen_".$date->getTimestamp()."." . $ext;

    move_uploaded_file($tmp, $urlFinalConNombreYExtension);

    return $urlFinalConNombreYExtension;
  }
}

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if(!isset($_SESSION["usuario"])){
  header("Location: login.php");
}

if(isset($_POST["submitted"])){

  if($_SESSION["usuario"]["entidad"] == "freelancer"){
    $fileName = 'usuarios.json';
    $usuarios = json_decode(file_get_contents($fileName),true);


    if(!is_null($usuarios)) {
      foreach ($usuarios as $key => $usuarioEnArchivo) {
        if ($usuarioEnArchivo['email'] == $_SESSION["usuario"]['email']) {



          if(isset($_POST["password"]) && $_POST["password"]){
            $usuarios[$key]["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);
            echo "password cambiada<br>";
          }

          if(isset($_POST["nombre"]) && $_POST["nombre"]){
            $usuarios[$key]["nombre"] = $_POST["nombre"];
            echo "nombre cambiado<br>";
          }

          if(isset($_POST["apellido"]) && $_POST["apellido"]){
            $usuarios[$key]["apellido"] = $_POST["apellido"];
            echo "apellido cambado<br>";
          }

          if(isset($_POST["birthdate"]) && $_POST["birthdate"]){
            $usuarios[$key]["birthdate"] = $_POST["birthdate"];
            echo "cumple cambiado <br>";
          }

          if(isset($_POST["genre"]) && $_POST["genre"]){
            $usuarios[$key]["genre"] = $_POST["genre"];
            echo "genre cambiado <br>";
          }

          if(array_key_exists("avatar", $_FILES) && $_FILES["avatar"]['error'] === UPLOAD_ERR_OK){
            $usuarios[$key]["avatar"] = guardarArchivoSubido("avatar");
            echo "avatar cambiado <br>";
          }



          file_put_contents($fileName, json_encode($usuarios, JSON_PRETTY_PRINT));
          $_SESSION["usuario"] = $usuarios[$key];
          header("Location: profile.php");

        }
      }
    }
  }

  else{

    $fileName = 'usuarios.json';
    $usuarios = json_decode(file_get_contents($fileName),true);

    if(!is_null($usuarios)) {
      foreach ($usuarios as $key => $usuarioEnArchivo) {
        if ($usuarioEnArchivo['email'] == $_SESSION["usuario"]['email']) {

          if(isset($_POST["password"]) && $_POST["password"]){
            $usuarios[$key]["password"] = password_hash($_POST["password"], PASSWORD_DEFAULT);
            echo "password cambiada<br>";
          }

          if(isset($_POST["nombre_empresa"]) && $_POST["nombre_empresa"]){
            $usuarios[$key]["nombre_empresa"] = $_POST["nombre_empresa"];
            echo "nombre_empresa cambiado<br>";
          }

          if(array_key_exists("avatar", $_FILES) && $_FILES["avatar"]['error'] === UPLOAD_ERR_OK){
            $usuarios[$key]["avatar"] = guardarArchivoSubido("avatar");
            echo "avatar cambiado <br>";
          }

          file_put_contents($fileName, json_encode($usuarios, JSON_PRETTY_PRINT));
          $_SESSION["usuario"] = $usuarios[$key];
          header("Location: profile.php");

        }
      }
    }
  }
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
  <?php include 'header.php' ?>

  <br>
  <div class=mainContainer>  
    <div class="container">
      <div class="container">
        <div class="profile">
          <?php if($_SESSION["usuario"]["entidad"] == "freelancer") : ?>

            <h2 class="contact">EDITAR PERFIL</h1>

              <form method="post" class="registerForm" enctype="multipart/form-data">
              </div class="container">
              <label for="email"> Email </label>
              <input type="email" placeholder="Ingrese Email..." value= <?php if(array_key_exists("usuario", $_SESSION)) echo $_SESSION["usuario"]["email"]; ?> disabled>
            </div>

            <br>

            <div class="container">
              <label for="nombre"> Nombre</label>
              <input type="text" name="nombre" placeholder="Ingrese nombre..." value= <?php if(array_key_exists("nombre", $_POST)) echo $_POST["nombre"]; ?> >
            </div>

            <br>

            <div class="container">
              <label for="apellido">Apellido</label>
              <input type="text" name="apellido" placeholder="Ingrese apellido..." value= <?php if(array_key_exists("apellido", $_POST)) echo $_POST["apellido"]; ?> >
            </div>

            <br>

            <div class="container">

              <label for='password'>Contaseña:</label>
              <input type='password' name='password' id='password' placeholder="Ingrese contraseña..." maxlength="50" />
            </div>
            <br>

            <div class="container">
              <label for="sexos" class="aches">Género</label> 
              <div class="sexos" id="sexos">
                <input id="masc" type="radio" name="genre" value= "masculino">
                <label for="masc"> Masculino </label><br>
                <input id="fem" type="radio" name="genre" value= "femenino">
                <label for="fem"> Femenino </label>
              </div>
            </div>


            <br>       

            <div class="container">
              <label for="fecha"> Fecha de Nacimiento </label>
              <input type="date" name="birthdate" min="1900-03-25" max="2018-05-25" step="1" value= <?php if(array_key_exists("birthdate", $_POST)) echo $_POST["birthdate"]; ?>>
            </div>              


            <br>

            <div class="container">
              <label for="avatar">Avatar</label>
              <input type="file" class="form-control" name="avatar">
            </div>

            <div class="container">

              <button type="submit" name="submitted" class="Button">Cambiar perfil</button>
            </div>

            <div class="botones">
              <a href="profile.php" class="Button" style="text-decoration:none; margin-top: 25px;" >  Volver al perfil </a>
            </div>
          </form>

        <?php else : ?>


            <h2 class="contact">EDITAR PERFIL</h2>
         <form method="post" class="registerForm" enctype="multipart/form-data">
<div class="container">
            <label for="email"> Email </label>
            <input type="email" placeholder="Ingrese Email..." value= <?php if(array_key_exists("usuario", $_SESSION)) echo $_SESSION["usuario"]["email"]; ?> disabled>
          </div>
          <br>
          <div class="container">
            <label for="nombre">Nombre empresa</label>
            <input type="text" name="nombre_empresa" placeholder="Nombre de la empresa" >
          </div>
          
            <br>

          <div class="container">
            <label for='password' >Contaseña:</label>
            <input type='password' name='password' id='password' placeholder="Contraseña" maxlength="50" />
          </div>
          <br>
          <div class="container">
            <label for="avatar">Avatar</label>
            <input type="file" class="form-control" name="avatar">
          </div>
        </div>

        <div class="container">
            <button type="submit" name="submitted" class="Button">Cambiar perfil</button>
            </div>

            <div class="botones">
              <a href="profile.php" class="Button" style="text-decoration:none; margin-top: 25px;" >  Volver al perfil </a>
        </div>
      </form>


    <?php endif; ?>
  </div>
</div>
<form autocomplete="off" method="post" enctype="multipart/form-data" style="margin-top: 25px;"">


</form>
</div>

</body>
</html>