<?php 

require_once('NavegationManager.php');
require_once('DatabaseManager.php');

/**
 * Login Manager Class
 */
class LoginManager
{
	public function verificarDatosJSON(){
		if(array_key_exists("email", $_POST) && $_POST["email"]){

			$user["email"] = $_POST["email"];
			$user["password"] = $_POST["password"];

			$tmp = $this->existeUsuarioEnJSON($user);
			if(!$tmp["existe"]){
				return "Usuario incorrecto";
			}else if(!password_verify($user["password"], $tmp["user"]["password"])){
				return "Contraseña incorrecta";
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

	public function verificarDatosDB(){
		if(array_key_exists("email", $_POST) && $_POST["email"]){

			$user["email"] = $_POST["email"];
			$user["password"] = $_POST["password"];

			$dbm = new DatabaseManager();

			if(array_key_exists('reg', $_GET) && $_GET['reg'] == 'freelancer'){
				$tmp = $dbm->ExisteFreelancerEnBD($user['email']);
			}
			else {
				$tmp = $dbm->ExisteCompanyEnBD($user['email']);
			}
			
			if(!$tmp){
				return "Usuario incorrecto";
			}else if(!password_verify($user["password"], $tmp["password"])){
				return "Contraseña incorrecta";
			}else
			{
          		//---------------INICIO DE SESION------------------//
				$tmp['entidad'] = $_GET['reg'];
				$_SESSION["usuario"] = $tmp;
				NavegationManager::GoToProfile();	
			}

		}
	}
}