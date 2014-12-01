<?php
class Connection
{
	public $connect = false;

	public function __construct()
	{	
		if (!$this->connect)
		{	
			try
			{
				$this->connect = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME, DB_USER, DB_PASSWORD,
					array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
				$this->connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$this->connect->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET CHARACTER SET utf8");
		
				return $this->connect;
		    	}
		    	catch (PDOException $e)
		    	{
				echo $e->getMessage();
				exit();
		    	}
		}
		else
		{
			return $this->connect;
		}
        }
}
?>