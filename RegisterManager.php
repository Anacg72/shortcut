<?php

require_once('DatabaseManager.php');

class RegisterManager
{
	private $JSON_PATH = 'usuarios.json';

	public static function guardarArchivoSubido($nombreDelInputFile) {
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


	public static function existeUsuarioJSON($usuario) {
		$usuarios = json_decode(file_get_contents('usuarios.json'),true);

		$last_id = 0;
		$existe = false;

		if(!is_null($usuarios)) {

			foreach ($usuarios as $key => $usuarioEnArchivo) {
				$last_id = $last_id > $usuarioEnArchivo['id'] ? $last_id : $usuarioEnArchivo['id'];
				if ($usuarioEnArchivo['email'] == $usuario->email) {
					$existe = true;
				}
			}
		}

		return [
			'last_id' => $last_id,
			'existe'  => $existe
		];
	}

	private function guardarUsuarioCompanieEnJSON($usuario, $last_id) {

		if (!file_exists($this->JSON_PATH)) {
			file_put_contents($this->JSON_PATH, "{}");
		}

		$usuarios = json_decode(file_get_contents($this->JSON_PATH),true);

		if (is_null($usuarios)) {
			$usuarios = [];
		}

		$usuarios[] = array_merge($usuario->getData(),['entidad' => 'companie', 'id'=>$last_id+1]);

		file_put_contents($this->JSON_PATH, json_encode($usuarios, JSON_PRETTY_PRINT));
	}

	private function guardarUsuarioFreelancerEnJSON($usuario, $last_id) {

		if (!file_exists($this->JSON_PATH)) {
			file_put_contents($this->JSON_PATH, "{}");
		}

		$usuarios = json_decode(file_get_contents($this->JSON_PATH),true);

		if (is_null($usuarios)) {
			$usuarios = [];
		}

		$usuarios[] = array_merge($usuario->getData(),['entidad' => 'freelancer', 'id'=>$last_id+1]);
		file_put_contents($this->JSON_PATH, json_encode($usuarios, JSON_PRETTY_PRINT));
	}

	public function GuardarUsuarioSiNoExisteJSON(Usuario $usuario)
	{
		if (array_key_exists('submitted', $_POST)) {

			$existeArray = $this->existeUsuarioJSON($usuario);

			if(!$existeArray['existe']) {

				if(array_key_exists('entitie', $_POST)){

					if($_POST['entitie'] == 'freelancer')
						$this->guardarUsuarioFreelancerEnJSON($usuario, $existeArray['last_id']);
					


					elseif($_POST['entitie'] == 'companie')
						$this->guardarUsuarioCompanieEnJSON($usuario, $existeArray['last_id']);
				}

				NavegationManager::GoToLogin();				
				exit;

			} else {
				echo "El usuario ya existe!";
			}

		}
	}

	public static function getListaUsuariosJSON(){
		return json_decode(file_get_contents('usuarios.json'),true);
	}

	public static function setListaUsuariosJSON($usuarios){
		file_put_contents('usuarios.json', json_encode($usuarios, JSON_PRETTY_PRINT));
	}

	public function GuardarUsuarioEnBD(Usuario $usuario){
		if(!$this->ExisteUsuarioBD($usuario)){
			$dbm = new DatabaseManager();

			if($_POST['entitie'] == 'freelancer')
				$dbm->GuardarUsuarioFreelancer($usuario);		


			elseif($_POST['entitie'] == 'companie')
				$dbm->GuardarUsuarioCompany($usuario);
		}
	}

	public function ExisteUsuarioBD($usuario){
		$dbm = new DatabaseManager();

		if($_POST['entitie'] == 'freelancer')
			return $dbm->ExisteFreelancerEnBD($usuario->email);		


		elseif($_POST['entitie'] == 'companie')
			return $dbm->ExisteCompanyEnBD($usuario->email);

	}


}