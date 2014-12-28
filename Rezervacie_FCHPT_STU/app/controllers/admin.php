<?php
class Admin extends Controller
{
	public function index(){
		if($this->user != null){
			if($this->user->admin){
				$this->show('Administracia', 'form/administracia',array());					
			}
			else{
				$this->show('Oops','messages/errorMessage',array('message' => 'Prístup bol zamietnutı.'));
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
				$this->show('Oops','messages/errorMessage',array('message' => 'Prístup bol zamietnutı.'));
			}
		}				
		else{
			$this->showLogin('Pre vstup je nutné by prihlásenı.');
		}
	}
	
	public function ZmenaPrav($message = '', $message2 = ''){
		if($this->user != null){
			if($this->user->admin){					
				if(@$_POST['ChangeAdmin']){	
					$login = $_POST['ChangeAdmin'];
					if(isset($_POST[$_POST['ChangeAdmin']]))
					{		
						$admin = 1;
					}
					else
					{
						$admin = 0;
					}					
					if(isset($_POST['confirmID']))
					{		
						if($_POST['confirmID'] == "true")
						{
							$mysql = new Connection();
							$mysql_result = $mysql->changeAdmin($login, $admin);								
							if($mysql_result == null){
								$message = 'Nastala chyba pri vytvarani.';
							}
							else
							{								
								$message2 = 'Pouzivatelovi "' . $login . '" boli uspesne zmenene administratorske prava';
							}
						}						
					}
					else
					{
						$this->show('Oops','messages/errorMessage',array('message' => 'Nastala chyba.'));
					}
				}			
				$this->show('Zmena Prav', 'form/zmenaAdminPrav',array('message' => $message, 'message2' => $message2));					
			}
			else{
				$this->show('Oops','messages/errorMessage',array('message' => 'Prístup bol zamietnutı.'));
			}		
		}	
		else{
			$this->showLogin('Pre vstup je nutné by prihlásenı.');
		}
	}
	
	public function CreateNewRoom($message = ''){
	if($this->user != null){
			if($this->user->admin){
				if(@$_POST['createRoom']){
					if (isset($_POST['name_room']) && $_POST['name_room'] != '' && isset($_POST['capacity_room']) && $_POST['capacity_room'] != '' && isset($_POST['type_room'])){			
						if(is_numeric($_POST['capacity_room']) && ($_POST['capacity_room'] > 0))
						{							
							$name_room = $_POST['name_room'];
							$capacity_room = $_POST['capacity_room'];
							$type_room = $_POST['type_room'];
						
							$mysql = new Connection();
							$mysql_result = $mysql->createRoom($name_room, $type_room ,$capacity_room);
							if($mysql_result == null){
								$message = 'Nastala chyba pri vytvarani.';
							}	
							else
							{
								$this->show('Succesful', 'message',array('message' => "Uspesne vytvorenie miestnosti. Nazov: " . $name_room . " Typ: " . $type_room . " Kapacita:" . $capacity_room));									
							}
						}else{
							$this->show('Oops','message',array('message' => 'Zla kapacita.'));
						}
					}
					else
					{
						$message = 'Nevyplnene udaje.';
					}
					
				}
				$this->show('New Room', 'form/createRoom',array('message' => $message));		
			}				
			else{
				$this->show('Oops','message',array('message' => 'Prístup bol zamietnutı.'));
			}
		}				
		else{
			$this->showLogin('Pre vstup je nutné by? prihlásenı.');
		}
	}
	
	public function handleRooms($message = ''){
	if($this->user != null){
			if($this->user->admin){
				$this->show('Handle Rooms', 'form/handleRooms',array('message' => $message));		
			}				
			else{
				$this->show('Oops','message',array('message' => 'Prístup bol zamietnutı.'));
			}
		}				
		else{
			$this->showLogin('Pre vstup je nutné by prihlásenı.');
		}
	}
	
	public function handleRoomTypes($message = ''){
	if($this->user != null){
			if($this->user->admin){
				$this->show('Handle Room Types', 'form/handleRoomTypes',array('message' => $message));		
			}				
			else{
				$this->show('Oops','message',array('message' => 'Prístup bol zamietnutı.'));
			}
		}				
		else{
			$this->showLogin('Pre vstup je nutné by prihlásenı.');
		}
	}
	
	public function CreateNewRoomType($message = ''){
	if($this->user != null){
			if($this->user->admin){
				if(@$_POST['createRoomType']){
						if (isset($_POST['name_room_type']) && ($_POST['name_room_type'] != '')){										
								$name_room_type = $_POST['name_room_type'];
							
								$mysql = new Connection();
								$mysql_result = $mysql->createRoomType($name_room_type);
								if($mysql_result == null){
									$message = 'Nastala chyba pri vytvarani.';
								}	
								else
								{
									$this->show('Succesful', 'message',array('message' => "Uspesne vytvorenie typu miestnosti. Nazov: " . $name_room_type));									
								}
						}
						else
						{
							$message = 'Nevyplnene udaje.';
						}
						
					}
					$this->show('New Room Types', 'form/newRoomType',array('message' => $message));		
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