<?php
include_once '/app/models/Connection.php';
include_once '/app/models/User.php';

class Controller{
	public $user = null;
	
	public function __construct(){
		//skontroluje ci je niekto prihlaseny
		if (isset($_SESSION['id_user']) && isset($_COOKIE['is_auth'])){
			$mysql = new Connection();
			$mysql_result = $mysql->getUser($_SESSION['id_user']);
			if($mysql_result != null){
				$this->user = new User($mysql_result);
				setcookie('is_auth', 1, time() + (3600 * 2),'/'); //prenastavenie cookie na 2 hodiny
			}
			else{
				unset($_SESSION['id_user']);
				unset($_COOKIE['is_auth']);
			}
		}
		//skontroluje ci sa prave uzivatel neprihlasil
		elseif (isset($_POST['login']) && isset($_POST['heslo'])){			
			$login = $_POST['login'];
			$heslo = sha1($_POST['heslo']);
			$mysql = new Connection();
			$mysql_result = $mysql->login($login, $heslo);
			if($mysql_result != null){
				$this->user = new User($mysql_result);
				$_SESSION['id_user'] = $this->user->id;
				setcookie('is_auth', 1, time() + (3600 * 2),'/'); //prenastavenie cookie na 2 hodiny
				$this->refresh('Ucitel/');
			}		
		}
	}
    
    public function refresh($url){    	
				header( "HTTP/1.1 301 Moved Permanently" ); 
				header( "Location: http://".DOMAIN."/".URL_BASE."/".$url); 
    }
    
    public function show($title, $view, $data = array())
    {
        require_once '/app/views/body.php';
    }
    
    public function showLogin($message = '')
    {
		if(@$_POST['prihlasenie']){
			$message = 'Nesprávny login alebo heslo.';
		}
		$this->show('Prihlásenie','form/login',array('message' => $message));
    }

}
?>