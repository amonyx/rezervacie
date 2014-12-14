<?php
class Admin extends Controller
{
	public function index(){
		if($this->user != null){
			if($this->user->admin){
				$this->show('Administracia', 'form/administracia',array());					
			}
			else{
				$this->show('Oops','message',array('message' => 'Prístup bol zamietnutı.'));
			}		
		}	
		else{
			$this->showLogin('Pre vstup je nutné by prihlásenı.');
		}
	}
	
	public function CreateNewUser($message = ''){
		if($this->user != null){
			if($this->user->admin){
				if(@$_POST['createUser']){
					if (isset($_POST['meno']) && $_POST['meno'] != '' && isset($_POST['priezvisko']) && $_POST['priezvisko'] != '' && isset($_POST['login']) && $_POST['login'] != '' && isset($_POST['heslo']) && $_POST['heslo'] != ''){			
						if(strlen($_POST['heslo']) >= 6)
						{							
							$meno = $_POST['meno'];
							$priezvisko = $_POST['priezvisko'];
							$login = $_POST['login'];
							$heslo = sha1($_POST['heslo']);
							if(isset($_POST['admin']))
							{
								$admin = 1;
							}
							else
							{
								$admin = 0;
							}
							$mysql = new Connection();
							$mysql_result = $mysql->createUser($meno, $priezvisko, $login, $heslo, $admin);
							if($mysql_result == null){
								$message = 'Nastala chyba pri vytvarani.';
							}	
							else
							{
								$this->show('Succesful', 'message',array('message' => "Uspesne vytvorenie uzivatela. Login: " . $login . " Heslo: " . $_POST['heslo']));									
							}
						}
					}
					else
					{
						$message = 'Nevyplnene udaje.';
					}
					
				}
				$this->show('New User', 'form/createUser',array('message' => $message));		
			}				
			else{
				$this->show('Oops','message',array('message' => 'Prístup bol zamietnutı.'));
			}
		}				
		else{
			$this->showLogin('Pre vstup je nutné by prihlásenı.');
		}
	}
}