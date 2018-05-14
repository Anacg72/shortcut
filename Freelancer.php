<?php 

/**
 * Freelancer User Class
 */

require_once('Usuario.php');
require_once('RegisterManager.php');

class Freelancer extends Usuario
{
	private $camposDeUsuario = [
		'email' => 'dato',
		'nombre' => 'dato',
		'apellido' => 'dato',
		'password' => 'dato',
		'genre' => 'dato',
		'birthdate' => 'dato',
		'avatar' => 'file'
	];

	function __construct()
	{
		if(array_key_exists('submitted', $_POST))
		foreach ($this->camposDeUsuario as $nombreCampo => $tipoDato) {

			switch ($tipoDato) {
				case 'dato':
				if(array_key_exists($nombreCampo, $_POST) && $_POST[$nombreCampo]) {

					if ($nombreCampo == 'password') {
						$this->data[$nombreCampo] = password_hash($_POST[$nombreCampo], PASSWORD_DEFAULT);
					} else {
						$this->data[$nombreCampo] = $_POST[$nombreCampo];
					}       
				}
				break;
				case 'file':
				if(array_key_exists($nombreCampo, $_FILES) && $_FILES[$nombreCampo]['error'] === UPLOAD_ERR_OK) {
					$this->data[$nombreCampo] = RegisterManager::guardarArchivoSubido($nombreCampo);
				}
				break;
				default:
				break;
			}
		}
	}

	public function correctamenteSeteado()
	{
		return count($this->data) == count($this->camposDeUsuario);
	}
}




