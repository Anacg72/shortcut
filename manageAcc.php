<?php
require_once('SessionManager.php');
require_once('ModifierManager.php');

SessionManager::AbrirSession();
SessionManager::VerificarUsuarioLogueadoYReedirigirAlLogin();
$modifManager = new ModifierManager();

if(isset($_POST["submitted"])){
  $modifManager->ActualizarUsuario();
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
  <?php include 'header.php'; ?>

  <br>
  <div class=mainContainer>  
    <div class="container">
      <div class="container">
        <div class="profile">

          <?php if(SessionManager::getUsuarioLogueado()['entidad'] == "freelancer") : ?>

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
                <label for="nombre">Nombre empresa:</label>
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