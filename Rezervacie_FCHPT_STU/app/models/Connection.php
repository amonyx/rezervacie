<?php
class Connection
{
	private $connect = null;

	public function __construct()
	{
		try
		{
			$this->connect = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD,
				array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
			$this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$aa = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD,
			array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
		}
		catch (PDOException $e)
		{
			$this->connect = null;
		}
	}

	public function __destruct(){
		if($this->connect != null){
			$this->connect = null;
		}
	}

	public function getUser($id){
		if($this->connect != null){
			$sql = 'SELECT *
					FROM uzivatel
					WHERE id=:id';
			$stmt = $this->connect->prepare($sql);
			$stmt->execute(array(':id' => $id));
			$user = $stmt->fetch();
			$stmt->closeCursor();
			return $user;
		}
		else{
			return null;
		}
	}

	public function login($login, $hashed_password){
		if($this->connect != null){
			$sql = 'SELECT *
					FROM uzivatel
					WHERE login=:login
					AND heslo=:heslo';
			$stmt = $this->connect->prepare($sql);
			$stmt->execute(array(':login' => $login, ':heslo' => $hashed_password));
			$user = $stmt->fetch();
			$stmt->closeCursor();
			return $user;
		}
		else{
			return null;
		}
	}
	
	public function createUser($meno, $priezvisko, $login, $hashed_password, $admin){
		if($this->connect != null){
			$sql = "INSERT INTO uzivatel SET Meno=:meno,
			Priezvisko=:priezvisko,
			Login=:login,			
			heslo=:heslo,
			admin=:admin";			
			$stmt = $this->connect->prepare($sql);
			$stmt->execute(array(':meno' => $meno, ':priezvisko' => $priezvisko ,':login' => $login, ':heslo' => $hashed_password, ':admin' => $admin));			
			$stmt->closeCursor();
			return true;
		}
		else{
			return null;
		}
	}
	
	public function getUserByLogin($login){
		if($this->connect != null){
			$sql = 'SELECT *
					FROM uzivatel
					WHERE login=:login';
			$stmt = $this->connect->prepare($sql);
			$stmt->execute(array(':login' => $login));
			$user = $stmt->fetch();
			$stmt->closeCursor();
			return $user;
		}
		else{
			return null;
		}
	}
	
	public function changePass($id, $hashed_password){
		if($this->connect != null){
			$sql = 'UPDATE uzivatel
					SET Heslo=:heslo
					WHERE Id=:id';
			$stmt = $this->connect->prepare($sql);
			$stmt->execute(array(':heslo' => $hashed_password, ':id' => $id));			
			$stmt->closeCursor();			
			return true;
		}
		else{
			return null;
		}
	}
	
	public function changeAdmin($login, $admin){
		if($this->connect != null){
			$sql = 'UPDATE uzivatel
					SET Admin=:admin
					WHERE Login=:login';
			$stmt = $this->connect->prepare($sql);
			$stmt->execute(array(':admin' => $admin, ':login' => $login));			
			$stmt->closeCursor();			
			return true;
		}
		else{
			return null;
		}
	}
	
	public function getUsers(){
		if($this->connect != null){
			$sql = 'SELECT *
					FROM uzivatel';
			$stmt = $this->connect->prepare($sql);
			$stmt->execute();
			
			while( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
				$users[] = $row;
			}
			
			$stmt->closeCursor();
			return $users;
		}
		else{
			return null;
		}
	}
}
?>