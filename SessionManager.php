<?php 

require_once('NavegationManager.php');

/**
 * Session Manager Class
 */
class SessionManager
{
	public static function AbrirSession()
	{
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
	}

	public static function CerrarSession()
	{
		session_destroy();		
	}
	
	public static function VerificarSessionYReedirigirAlPerfil()
	{
		if(isset($_SESSION["usuario"])){
			NavegationManager::GoToProfile();
		}
	}

	public static function VerificarUsuarioLogueadoYReedirigirAlLogin()
	{
		if(!isset($_SESSION["usuario"])){
			NavegationManager::GoToLogin();
		} else
		{
			return $_SESSION["usuario"];
		}
	}

	public static function VerificarCerrarSession()
	{
		if(isset($_GET["cerrarSesion"]) || array_key_exists("cerrarSesion", $_POST)){
			SessionManager::CerrarSession();
			NavegationManager::GoToLogin();
		}
	}

	public static function getUsuarioLogueado(){
		return isset($_SESSION['usuario']) ? $_SESSION['usuario'] : null;
	}

	public static function actualizarUsuarioEnSession($user){
		$_SESSION["usuario"] = $user;
	}


}