<?php
require_once('NavegationManager.php');
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
			////echo 'Conectado a la base de datos sin crearla..'; 

		} catch (PDOException $e) {
			try{
				$this->CrearBaseDeDatos();				
				$this->dbm = $this->AbrirConexion();
				$this->CrearTablas();				
				////echo 'Creada base de datos, tablas y conectada..'; 

			}catch(PDOException $e){
				//echo $e;
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


	public function BorrarBaseDeDatos(){
		$query = $this->dbm->prepare("drop database $this->dbname;");
		$query->execute();
	}

	private function CrearTablaFreelancer(){

		$query = $this->dbm->prepare("
			CREATE TABLE usuarios_freelancer(
			id INT NOT NULL AUTO_INCREMENT,
			email VARCHAR(500),
			nombre VARCHAR(500),
			apellido VARCHAR(500),
			password VARCHAR(500),
			genre VARCHAR(500),
			birthdate DATE,
			avatar VARCHAR(500),
			PRIMARY KEY (id));
			");
		$query->execute();
		
	}

	private function CrearTablaCompany(){
		$query2 = $this->dbm->prepare("CREATE TABLE usuarios_company(
			id int NOT NULL AUTO_INCREMENT,
			email VARCHAR(500),
			nombre_empresa VARCHAR(500),
			password VARCHAR(500),
			avatar VARCHAR(500),
			PRIMARY KEY (id));
			");

		$query2->execute();
	}

	private function CrearTablas(){
		$this->CrearTablaFreelancer();
		$this->CrearTablaCompany();
	}

	public function GuardarUsuarioFreelancer($freelancer){
		try{

			$query = $this->dbm->prepare("
				insert into usuarios_freelancer (email, password, nombre, apellido, genre, birthdate, avatar)  values ('$freelancer->email', '$freelancer->password', '$freelancer->nombre', '$freelancer->apellido', '$freelancer->genre', '$freelancer->birthdate', '$freelancer->avatar');
				");

			$query->execute();

			NavegationManager::GoToLogin();

		}catch(PDOException $e){
			//echo $e;
		}
		
		/*
		INSERT INTO table_name (column1, column2, column3, ...)
		VALUES (value1, value2, value3, ...);
		*/
	}

	public function GuardarUsuarioCompany($freelancer){
		try{

			$query = $this->dbm->prepare("
				insert into usuarios_company (email, password, nombre_empresa, avatar)  values ('$freelancer->email', '$freelancer->password', '$freelancer->nombre_empresa', '$freelancer->avatar');
				");

			$query->execute();

			NavegationManager::GoToLogin();

		}catch(PDOException $e){
			//echo $e;
		}
		
		/*
		INSERT INTO table_name (column1, column2, column3, ...)
		VALUES (value1, value2, value3, ...);
		*/
	}

	public function ExisteFreelancerEnBD($email){
		$query = $this->dbm->prepare("select * from usuarios_freelancer where email = '$email';");

		$query->execute();
		$result = $query->fetch(PDO::FETCH_ASSOC);

		return $result;
	}

	public function ExisteCompanyEnBD($email){
		$query = $this->dbm->prepare("select * from usuarios_company where email = '$email';");

		$query->execute();		
		$result = $query->fetch(PDO::FETCH_ASSOC);

		return $result;
	}

	public function ActualizarFreelancer($email, $column, $value){
		$query = $this->dbm->prepare("UPDATE usuarios_freelancer
			SET $column = '$value'
			WHERE email = '$email';");

		$query->execute();
	}

	public function ActualizarCompanie($email, $column, $value){

		$query = $this->dbm->prepare("UPDATE usuarios_company
			SET $column = '$value'
			WHERE email = '$email';");

		$query->execute();
	}

}