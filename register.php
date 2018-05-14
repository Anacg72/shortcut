<?php 

require_once('SessionManager.php');

SessionManager::AbrirSession();
SessionManager::VerificarSessionYReedirigirAlPerfil();

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="..css/registerStyle.css" rel="stylesheet">

  <title>Registrarse</title>
</head>
<body>
  <?php include 'header.php'; ?>

  <br>
  <div class="mainContainer">  
    <div class="container">  
      <h2 class="contact"> REGISTRARSE </h2>

      <form method="get">
        <select name="reg">
          <option value="companie">Como empresa</option>
          <option value="freelancer">Como freelancer</option>
        </select>

        <button type="submit">Cambiar</button>

      </form>
    </div>

    <?php 
    if(isset($_GET["reg"]) && $_GET["reg"] == "freelancer"){
      include "registerFreelancers.php";
    }
    else{
      include "registerCompanies.php";
    }
    ?>
  </body>
  </html>