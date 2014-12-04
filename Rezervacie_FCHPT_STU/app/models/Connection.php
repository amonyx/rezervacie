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
}
?>