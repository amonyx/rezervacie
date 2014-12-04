<?php
class User
{
	public $id;
	public $meno;
	public $priezvisko;
	public $login;
	public $heslo;
	public $admin;

	public function __construct($user = array('ID'=>'','Meno'=>'','Priezvisko'=>'','Login'=>'','Heslo'=>'','Admin'=>'')) {
		$this->id = $user['ID'];
		$this->meno = $user['Meno'];
		$this->priezvisko = $user['Priezvisko'];
		$this->login = $user['Login'];
		$this->heslo = $user['Heslo'];
		$this->admin = $user['Admin'];
	}
}