<?php
class Admin extends Controller
{
	public function index(){
		if($this->user != null){
			if($this->user->admin){
				$this->show('Administracia', 'form/administracia',array());					
			}
			else{
				$this->show('Oops','messages/errorMessage',array('message' => 'Pr�stup bol zamietnut�.'));
			}		
		}	
		else{
			$this->showLogin('Pre vstup je nutn� by� prihl�sen�.');
		}
	}
	
	public function CreateNewUser($message = ''){
		if($this->user != null){
			if($this->user->admin){	
				if(@$_POST['createUser']){
					if(isset($_POST["genHeslo"])) 
					{										
						function genHeslo(){
							$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
							return substr(str_shuffle($chars),0,6);
						}
						$_POST["heslo"] = genHeslo();
						$_POST["heslo2"] = $_POST["heslo"];
					}
					if (isset($_POST['meno']) && $_POST['meno'] != '' && isset($_POST['priezvisko']) && $_POST['priezvisko'] != '' && isset($_POST['login']) && $_POST['login'] != '' && isset($_POST['heslo']) && $_POST['heslo'] != ''){									
						if(strlen($_POST['heslo']) >= 6)
						{
							if($_POST['heslo'] == $_POST['heslo2'])
							{
								$meno = $_POST['meno'];
								$priezvisko = $_POST['priezvisko'];
								$login = $_POST['login'];
								$Duality = new Connection();
								$Duality_result = $Duality->getUserByLogin($login);
								if($Duality_result == null)
								{										
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
										if(isset($_POST["genHeslo"])) 
										{
											$this->show('Success','messages/successMessage',array('message' => 'Pouzivatel uspesne vytvoreny. Vygenerovane Heslo: ' . $_POST['heslo'] . '.'));
										}
										else
										{
											$this->show('Success','messages/successMessage',array('message' => 'Pouzivatel uspesne vytvoreny.'));
										}
									}
								}
								else
								{
									$message = "Pouzivatel " . $login . " existuje.";									
								}
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
				$this->show('Oops','messages/errorMessage',array('message' => 'Pr�stup bol zamietnut�.'));
			}
		}				
		else{
			$this->showLogin('Pre vstup je nutn� by� prihl�sen�.');
		}
	}
}