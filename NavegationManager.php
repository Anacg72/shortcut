<?php

/**
 * Navegation Manager Class
 */
class NavegationManager
{
	public static function GoToProfile(){
		header('Location: profile.php');
	}
	public static function GoToLogin(){
		header('Location: login.php');
	}
	public static function GoToIndex(){
		header('Location: index.php');
	}
	public static function GoToRegister(){
		header('Location: register.php');
	}
}