<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link href="css/registerStyle.css" rel="stylesheet">
  <title>Registrarse</title>
</head>
<body>
   <form action="registerFreelancers.php" method="get" class="registerForm">
    <div class="backgroundDiffuse">
      <div class="container">
        <label for="nombre"> Nombre</label>
        <input type="text" name="nombre" placeholder="Ingrese nombre..." required= 1>
        <br>
        <label for="apellido">Apellido</label>
        <input type="text" name="apellido" placeholder="Ingrese apellido..." required = 1 >
      </div>
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
      <div class="container">
        <label for='confirmpassword' >Confirmar Contraseña:</label><br/>
        <input type='password' name='confirmpassword' id='confirmpassword' placeholder="Confirme contraseña..." maxlength="50" required = 1/>
      </div>                      
      <br>
      <div class="container">
        <label for="sexos" class="aches">Sexo</label> 
        <div class="sexos" id="sexos">
          <input id="masc" type="radio" name="sex" value= "masculino">
          <label for="masc"> Masculino </label><br>
          <input id="fem" type="radio" name="sex" value= "femenino">
          <label for="fem"> Femenino </label>
        </div> 

      </div>

      <br>
      <div class="container">                      
        <label for="fecha"> Fecha de Nacimiento </label>
        <input type="date" name="fecha" min="2018-03-25"
        max="2018-05-25" step="2">
      </div>                  
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