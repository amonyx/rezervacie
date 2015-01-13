<?php
class Admin extends Controller
{
	public function index(){
		if($this->user != null){
			if($this->user->admin){
				$this->show('Administrácia', 'form/administracia',array());					
			}
			else{
				$this->show('Oops','messages/errorMessage',array('message' => 'Prístup bol zamietnutý.'));
			}		
		}	
		else{
			$this->showLogin('Pre vstup je nutné byť prihlásený.');
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
								$meno = htmlspecialchars($_POST['meno']);
								$priezvisko = htmlspecialchars($_POST['priezvisko']);
								$login = htmlspecialchars(($_POST['login']));
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
										$message = 'Nastala chyba pri vytvaraní.';
									}
									else
									{
										$popis = "Admin " . $this->user->meno . ' '. $this->user->priezvisko . " pridal noveho užívateľa s loginom " . $login;
										$mysql->createNewLog($this->user->login, "Pridanie užívateľa", $popis);
										if(isset($_POST["genHeslo"])) 
										{
											$this->show('Success','messages/successMessage',array('message' => 'Používateľ úspešne vytvorený. Vygenerované heslo: ' . $_POST['heslo'] . '.'));
										}
										else
										{
											$this->show('Success','messages/successMessage',array('message' => 'Používateľ úspešne vytvorený.'));
										}
									}
								}
								else
								{
									$message = "Používateľ " . $login . " už existuje.";									
								}
							}
						}							
					}
					else
					{
						$message = 'Nevyplnené údaje.';
					}					
				}
				$this->show('Nový používateľ', 'form/createUser',array('message' => $message));					
			}				
			else{
				$this->show('Oops','messages/errorMessage',array('message' => 'Prístup bol zamietnutý.'));
			}
		}				
		else{
			$this->showLogin('Pre vstup je nutné byž prihlásený.');
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
								$message2 = 'Používateľovi "' . $login . '" boli úspešne zmenené práva.';
								$popis = "Admin " . $this->user->meno . ' '. $this->user->priezvisko . " zmenil práva užívateľovi s loginom " . $login;
								$mysql->createNewLog($this->user->login, "Zmena práv", $popis);
							}
						}						
					}
					else
					{
						$this->show('Oops','messages/errorMessage',array('message' => 'Nastala chyba.'));
					}
				}			
				$this->show('Zmena práv', 'form/zmenaAdminPrav',array('message' => $message, 'message2' => $message2));					
			}
			else{
				$this->show('Oops','messages/errorMessage',array('message' => 'Prístup bol zamietnutý.'));
			}		
		}	
		else{
			$this->showLogin('Pre vstup je nutné byť prihlásený.');
		}
	}
	
	public function CreateNewRoom($message = ''){
	if($this->user != null){
			if($this->user->admin){
				if(@$_POST['createRoom']){
					if (isset($_POST['name_room']) && $_POST['name_room'] != '' && isset($_POST['capacity_room']) && $_POST['capacity_room'] != '' && isset($_POST['type_room'])){			
						if(is_numeric($_POST['capacity_room']) && ($_POST['capacity_room'] > 0))
						{							
							$name_room = htmlspecialchars($_POST['name_room']);
							$capacity_room = $_POST['capacity_room'];
							$type_room = $_POST['type_room'];
						
							$mysql = new Connection();
							$mysql_result = $mysql->createRoom($name_room, $type_room ,$capacity_room);
							if($mysql_result == null){
								$message = 'Nastala chyba pri vytváraní.';
							}	
							else
							{
								$popis = "Admin " . $this->user->meno . ' '. $this->user->priezvisko . " pridal novú miestnosť " . $name_room;
								$mysql->createNewLog($this->user->login, "Pridanie miestnosti", $popis);
								$this->show('Úspešné', 'message',array('message' => "Uspešné vytvorenie miestnosti. Názov: " . $name_room . " Typ: " . $type_room . " Kapacita:" . $capacity_room));									
							}
						}else{
							$this->show('Oops','message',array('message' => 'Zla kapacita.'));
						}
					}
					else
					{
						$message = 'Nevyplnené údaje.';
					}
					
				}
				$this->show('Nová miestnosť', 'form/createRoom',array('message' => $message));		
			}				
			else{
				$this->show('Oops','message',array('message' => 'Prístup bol zamietnutý.'));
			}
		}				
		else{
			$this->showLogin('Pre vstup je nutné byť prihlásený.');
		}
	}
	
	public function handleRooms($message = ''){
	if($this->user != null){
			if($this->user->admin){
				$this->show('Správa miestností', 'form/handleRooms',array('message' => $message));		
			}				
			else{
				$this->show('Oops','message',array('message' => 'Prístup bol zamietnutý.'));
			}
		}				
		else{
			$this->showLogin('Pre vstup je nutné byť prihlásený.');
		}
	}
	
	public function handleRoomTypes($message = ''){
	if($this->user != null){
			if($this->user->admin){
				$this->show('Správa typov miestností', 'form/handleRoomTypes',array('message' => $message));		
			}				
			else{
				$this->show('Oops','message',array('message' => 'Prístup bol zamietnutý.'));
			}
		}				
		else{
			$this->showLogin('Pre vstup je nutné byť prihlásený.');
		}
	}
	
	public function CreateNewRoomType($message = ''){
	if($this->user != null){
			if($this->user->admin){
				if(@$_POST['createRoomType']){
						if (isset($_POST['name_room_type']) && ($_POST['name_room_type'] != '')){										
								$name_room_type = htmlspecialchars($_POST['name_room_type']);
							
								$mysql = new Connection();
								$mysql_result = $mysql->createRoomType($name_room_type);
								if($mysql_result == null){
									$message = 'Nastala chyba pri vytváraní.';
								}	
								else
								{
									$popis = "Admin " . $this->user->meno . ' '. $this->user->priezvisko . " pridal nový typ miestnosti " . $name_room_type;
									$mysql->createNewLog($this->user->login, "Pridanie typu miestnosti", $popis);
									$this->show('Úspešné', 'message',array('message' => "Úspešné vytvorenie typu miestnosti. Názov: " . $name_room_type));									
								}
						}
						else
						{
							$message = 'Nevyplnené údaje.';
						}
						
					}
					$this->show('Nový typ miestnosti', 'form/newRoomType',array('message' => $message));		
			}				
			else{
				$this->show('Oops','message',array('message' => 'Prístup bol zamietnutý.'));
			}
		}				
		else{
			$this->showLogin('Pre vstup je nutné byť prihlásený.');
		}
	}
	
	public function logy(){
	if($this->user != null){
			if($this->user->admin){
				$mysql = new Connection();
				$message = '';
					if(isset($_POST['deleteDB'])){
					$logs = $mysql->deleteOldReservations();

					$popis = "Admin " . $this->user->meno . ' '. $this->user->priezvisko . " vymazal z databázy rezervácie staršie ako 6 mesiacov.";
					$mysql->createNewLog($this->user->login, "Vymazanie starých rezervácií", $popis);

					$message = 'Úspešné vymazanie starých rezervácií.';
				}
				$logs = $mysql->get_logs();

				$this->show('Logy', 'listview_logs',array('logs' => $logs, 'message' => $message));		
			}				
			else{
				$this->show('Oops','message',array('message' => 'Prístup bol zamietnutý.'));
			}

			
		}				
		else{
			$this->showLogin('Pre vstup je nutné byť prihlásený.');
		}
	}
	
}
