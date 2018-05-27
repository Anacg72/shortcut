<?php 

/**
 * Modifier Manager Class
 */

require_once('SessionManager.php');
require_once('RegisterManager.php');
require_once('NavegationManager.php');
require_once('DatabaseManager.php');

class ModifierManager
{	
	public function ActualizarUsuario()
	{		
		switch (SessionManager::getUsuarioLogueado()['entidad']) {
			case 'freelancer':
			$this->ActualizarFreelancer();
			break;

			case 'companie':
			$this->ActualizarCompanie();
			break;
		}

	}

	private function ActualizarFreelancer()
	{		
		$usuarios = RegisterManager::getListaUsuariosJSON();		
		$key = $this->getKeyUserFromEmail(SessionManager::getUsuarioLogueado()['email']);

		if(isset($_POST["password"]) && $_POST["password"]){
			$usuarios[$key]['password'] = password_hash($_POST["password"], PASSWORD_DEFAULT);
		}

		if(isset($_POST["nombre"]) && $_POST["nombre"]){
			$usuarios[$key]["nombre"] = $_POST["nombre"];
		}

		if(isset($_POST["apellido"]) && $_POST["apellido"]){
			$usuarios[$key]["apellido"] = $_POST["apellido"];
		}

		if(isset($_POST["birthdate"]) && $_POST["birthdate"]){
			$usuarios[$key]["birthdate"] = $_POST["birthdate"];
		}

		if(isset($_POST["genre"]) && $_POST["genre"]){
			$usuarios[$key]["genre"] = $_POST["genre"];
		}

		if(array_key_exists("avatar", $_FILES) && $_FILES["avatar"]['error'] === UPLOAD_ERR_OK){
			$usuarios[$key]["avatar"] = RegisterManager::guardarArchivoSubido("avatar");
		}

		RegisterManager::setListaUsuariosJSON($usuarios);
		SessionManager::actualizarUsuarioEnSession($usuarios[$key]);
		NavegationManager::GoToProfile();
	}

	private function ActualizarCompanie(){	
		$usuarios = RegisterManager::getListaUsuariosJSON();		
		$key = $this->getKeyUserFromEmail(SessionManager::getUsuarioLogueado()['email']);

		if(isset($_POST["password"]) && $_POST["password"]){
			$usuarios[$key]['password'] = password_hash($_POST["password"], PASSWORD_DEFAULT);
		}

		if(isset($_POST["nombre_empresa"]) && $_POST["nombre_empresa"]){
			$usuarios[$key]["nombre_empresa"] = $_POST["nombre_empresa"];
		}

		if(array_key_exists("avatar", $_FILES) && $_FILES["avatar"]['error'] === UPLOAD_ERR_OK){
			$usuarios[$key]["avatar"] = RegisterManager::guardarArchivoSubido("avatar");
		}

		RegisterManager::setListaUsuariosJSON($usuarios);
		SessionManager::actualizarUsuarioEnSession($usuarios[$key])
;		NavegationManager::GoToProfile();
	}

	private function getKeyUserFromEmail($email){
		$usuarios = RegisterManager::getListaUsuariosJSON();

		if(!is_null($usuarios)) {
			foreach ($usuarios as $key => $usuarioEnArchivo) {
				if ($usuarioEnArchivo['email'] == $email) return $key;
			}
		}

		return null;
	}

	public function cambiarContraseñaUsuarioPorEmail($email, $nuevaPassword){
		$usuarios = RegisterManager::getListaUsuariosJSON();

		$key = $this->getKeyUserFromEmail($email);

		if($key){
			$usuarios[$key]['password'] = password_hash($nuevaPassword, PASSWORD_DEFAULT);
			RegisterManager::setListaUsuariosJSON($usuarios);
			$usuarios = null;
			return true;
		}

		return false;
	}


	public function ActualizarCompanieDB(){

		$dbm = new DatabaseManager();

		if(isset($_POST["password"]) && $_POST["password"]){
			$dbm->ActualizarCompanie($_SESSION["usuario"]["email"], 'password', password_hash($_POST["password"], PASSWORD_DEFAULT));
		}

		if(isset($_POST["nombre_empresa"]) && $_POST["nombre_empresa"]){
			$dbm->ActualizarCompanie($_SESSION["usuario"]["email"], 'nombre_empresa', $_POST['nombre_empresa']);
		}


		if(array_key_exists("avatar", $_FILES) && $_FILES["avatar"]['error'] === UPLOAD_ERR_OK){
			$dbm->ActualizarCompanie($_SESSION["usuario"]["email"], 'avatar', RegisterManager::guardarArchivoSubido("avatar"));
		}

		$tmp = $dbm->ExisteCompanyEnBD($_SESSION["usuario"]['email']);
		$tmp['entidad'] = $_SESSION["usuario"]['entidad'];
		$_SESSION["usuario"] = $tmp;
		NavegationManager::GoToProfile();
	}

	public function ActualizarFreelancerDB(){
		$dbm = new DatabaseManager();

		if(isset($_POST["password"]) && $_POST["password"]){
			$dbm->ActualizarFreelancer($_SESSION["usuario"]["email"], 'password', password_hash($_POST["password"], PASSWORD_DEFAULT));
		}

		if(isset($_POST["nombre"]) && $_POST["nombre"]){
			$dbm->ActualizarFreelancer($_SESSION["usuario"]["email"], 'nombre', $_POST['nombre']);
		}

		if(isset($_POST["apellido"]) && $_POST["apellido"]){
			$dbm->ActualizarFreelancer($_SESSION["usuario"]["email"], 'apellido', $_POST['apellido']);
		}

		if(isset($_POST["birthdate"]) && $_POST["birthdate"]){
			$dbm->ActualizarFreelancer($_SESSION["usuario"]["email"], 'birthdate', $_POST['birthdate']);
			
		}

		if(isset($_POST["genre"]) && $_POST["genre"]){
			$dbm->ActualizarFreelancer($_SESSION["usuario"]["email"], 'genre', $_POST['genre']);
			
		}

		if(array_key_exists("avatar", $_FILES) && $_FILES["avatar"]['error'] === UPLOAD_ERR_OK){
			$dbm->ActualizarFreelancer($_SESSION["usuario"]["email"], 'avatar', RegisterManager::guardarArchivoSubido("avatar"));
		}

		$tmp = $dbm->ExisteFreelancerEnBD($_SESSION["usuario"]['email']);
		$tmp['entidad'] = $_SESSION["usuario"]['entidad'];
		$_SESSION["usuario"] = $tmp;
		NavegationManager::GoToProfile();
	}

	public function ActualizarContraseñaCompanieDB($email, $newPassword){
		$dbm = new DatabaseManager();

		$dbm->ActualizarCompanie($email, 'password', password_hash($_POST["password"], PASSWORD_DEFAULT));
	}

	public function ActualizarContraseñaFreelancerDB($email, $newPassword){
		$dbm = new DatabaseManager();
		
		$dbm->ActualizarFreelancer($email, 'password', password_hash($_POST["password"], PASSWORD_DEFAULT));
	}
}


