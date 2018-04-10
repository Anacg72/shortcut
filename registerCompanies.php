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

function existeUsuario($usuario) {
  $usuarios = json_decode(file_get_contents('usuarios.json'),true);

  $last_id = 0;
  $existe = false;

  if(!is_null($usuarios)) {

    foreach ($usuarios as $key => $usuarioEnArchivo) {
      $last_id = $last_id > $usuarioEnArchivo['id'] ? $last_id: $usuarioEnArchivo['id'];
      if ($usuarioEnArchivo['email'] == $usuario['email']) {
        $existe = true;
      }
    }

  }

  return [
    'last_id' => $last_id,
    'existe'  => $existe
  ];
}

function guardarUsuario($usuario, $last_id) {

  $fileName = 'usuarios.json';

  if (!file_exists($fileName)) {
    file_put_contents($fileName, "{}");
  }

  $usuarios = json_decode(file_get_contents($fileName),true);
  
  if (is_null($usuarios)) {
    $usuarios = [];
  }

  $usuarios[] = array_merge($usuario,['entidad' => 'companie', 'id'=>$last_id+1]);

  file_put_contents($fileName, json_encode($usuarios, JSON_PRETTY_PRINT));
}

$camposDeUsuario = [
  'email' => 'dato',
  'nombre_empresa' => 'dato',
  'password' => 'dato',
  'avatar' => 'file'

];

$usuario = [];

foreach ($camposDeUsuario as $nombreCampo => $tipoDato) {

  switch ($tipoDato) {
    case 'dato':
    if(array_key_exists($nombreCampo, $_POST) && $_POST[$nombreCampo]) {

      if ($nombreCampo == 'password') {
        $usuario[$nombreCampo] = password_hash($_POST[$nombreCampo], PASSWORD_DEFAULT);
      } else {
        $usuario[$nombreCampo] = $_POST[$nombreCampo];
      }       
    }
    break;
    case 'file':
    if(array_key_exists($nombreCampo, $_FILES) && $_FILES[$nombreCampo]['error'] === UPLOAD_ERR_OK) {
      $usuario[$nombreCampo] = guardarArchivoSubido($nombreCampo);
    }
    break;
    default:
    break;
  }
}

if (array_key_exists('submitted', $_POST) && count($camposDeUsuario) == count($usuario)) {

  $existeArray = existeUsuario($usuario);

  if(!$existeArray['existe']) {
    guardarUsuario($usuario, $existeArray['last_id']);
    
    header("Location: login.php");
    exit;
    
  } else {
    echo "El usuario ya existe!";
  }

} elseif(array_key_exists('submitted', $_POST)) {
  echo "Complete correctamente los datos";
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
   <form method="post" class="registerForm" enctype="multipart/form-data">
    <div class="container">
      <label for="nombre">Nombre de la Empresa</label>
      <input type="text" name="nombre_empresa" placeholder="Nombre de la empresa" required= 1>
    </div>
    <br>
    <div class="container">
      <label for="email"> Email </label>
      <input type="email" name="email" placeholder="Ingrese Email" required = 1>
      <br>
    </div>

    <div class="container">
      <label for='password' >Contaseña:</label>
      <input type='password' name='password' id='password' placeholder="Contraseña" maxlength="50" required = 1 />
    </div>
    <br>
    <div class="container">
      <label for="avatar">Avatar</label>
      <input type="file" class="form-control" name="avatar">
    </div>
  </div>


  <br>
  <div class="botones">
    <button class="Button" type="submit" name="submitted"> Enviar </button>
  </div>
  <br>
  <div class="botones">
    <a href="index.php" class="Button" style="text-decoration:none;" >  Volver al home </a>
  </div>


</form>
</body>
</html>