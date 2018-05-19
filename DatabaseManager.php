<?php

/**
 * Dababase Manager Class
 */
class DatabaseManager
{	
	private $host='localhost'; 

	private $root='root'; 
	private $root_password='';

	private $user='';
	private $pass='';
	private $dbname='shortcut_db';
	private $port = '3306';
	private $dbm = null;

	function __construct()
	{
		try {			
			$this->dbm = $this->AbrirConexion();
			echo 'Conectado a la base de datos sin crearla..'; 

		} catch (PDOException $e) {
			try{
				$this->CrearBaseDeDatos();				
				$this->dbm = $this->AbrirConexion();
				echo 'Creada base de datos y conectada..'; 

			}catch(PDOException $e){
				echo 'Error al conectar con base de datos.';
			}
		}

	}
	private function AbrirConexion(){
		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';port=' . $this->port; //standar port 3306
		$db_user = 'root';
		$db_pass = '';
		$opt = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ];
		$tmp = new PDO($dsn, $db_user, $db_pass, $opt);
		return $tmp;
	}


	private function CrearBaseDeDatos(){		
		$dbh = new PDO("mysql:host=$this->host", $this->root, $this->root_password);

		$dbh->exec("CREATE DATABASE `$this->dbname`;
			CREATE USER '$this->user'@'localhost' IDENTIFIED BY '$this->pass';
			GRANT ALL ON `$this->dbname`.* TO '$this->user'@'localhost';
			FLUSH PRIVILEGES;")

		or die(print_r($dbh->errorInfo(), true));
	}


	private function BorrarBaseDeDatos(){
		$query = $this->dbm->prepare("drop database $this->dbname;");
		$query->execute();
	}

	private function CrearTablas(){
		'email' => 'dato',
		'nombre' => 'dato',
		'apellido' => 'dato',
		'password' => 'dato',
		'genre' => 'dato',
		'birthdate' => 'dato',
		'avatar' => 'file'

		$query = $this->dbm->prepare("CREATE TABLE usuarios_freelancer(
			id INT UNSIGNED PRIMATY KEY AUTO_INCREMENT,
			email VARCHAR(500) NOT NULL,
			nombre VARCHAR(500) NOT NULL,
			apellido VARCHAR(500) NOT NULL,
			password VARCHAR(500) NOT NULL,
			genre VARCHAR(500) NOT NULL,
			birthdate DATE NOT NULL,
			avatar VARCHAR(500) NOT NULL);

			");
		$query->execute();
	}

}