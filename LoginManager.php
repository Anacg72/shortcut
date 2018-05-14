<?php 

require_once('NavegationManager.php');

/**
 * Login Manager Class
 */
class LoginManager
{
	public function verificarDatos(){
		if(array_key_exists("email", $_POST) && $_POST["email"]){

			$user["email"] = $_POST["email"];
			$user["password"] = $_POST["password"];

			$tmp = $this->existeUsuarioEnJSON($user);
			if(!$tmp["existe"]){
				echo "Usuario incorrecto";
			}else if(!password_verify($user["password"], $tmp["user"]["password"])){
				echo "Contraseña incorrecta";
			}else
			{
          		//---------------INICIO DE SESION------------------//
				$_SESSION["usuario"] = $tmp["user"];
				NavegationManager::GoToProfile();				
			}

		}
	}

	private function existeUsuarioEnJSON($usuario) {
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
}