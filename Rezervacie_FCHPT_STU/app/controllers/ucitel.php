<?php
class Ucitel extends Controller
{
	public function index(){
		$this->kalendar();
	}
	
	public function kalendar($message = '',$message2 = ''){
		if($this->user != null){
			if(@$_POST['ID_MAPA_SUBMIT']){																	
				if(isset($_POST['ID_MAPA_SUBMIT']) && isset($_POST['ID_Rezervacia_MAPA_SUBMIT']) 
				&& isset($_POST['Zaciatok_MAPA_SUBMIT']) 
				&& isset($_POST['Koniec_MAPA_SUBMIT']) 
				&& isset($_POST['Pocet_Osob_MAPA_SUBMIT']))
				{							
					$id = $_POST['ID_MAPA_SUBMIT'];			
					$id_rezervacie = $_POST['ID_Rezervacia_MAPA_SUBMIT'];			
					$zaciatok = $_POST['Zaciatok_MAPA_SUBMIT'];			
					$koniec = $_POST['Koniec_MAPA_SUBMIT'];			
					$pocet_osob = $_POST['Pocet_Osob_MAPA_SUBMIT'];											
					$mysql = new Connection();
					$mysql_result = $mysql->updateMapaRezervacie($id, $id_rezervacie, $zaciatok, $koniec, $pocet_osob);								
					if($mysql_result == null){
						$message = 'Nastala chyba pri zmene mapy rezervácie.';
					}
					else
					{																								
						if(isset($_POST['ID_Rezervacia_MAPA_SUBMIT']) && isset($_POST['ID_Uzivatel_SUBMIT']) 
						&& isset($_POST['ID_Miestnost_SUBMIT']) 
						&& isset($_POST['Ucel_SUBMIT']))
						{														
							$id = $_POST['ID_Rezervacia_MAPA_SUBMIT'];			
							$id_uzivatel = $_POST['ID_Uzivatel_SUBMIT'];			
							$id_miestnost = $_POST['ID_Miestnost_SUBMIT'];			
							$ucel = $_POST['Ucel_SUBMIT'];	
							$mysql_result = $mysql->updateRezervacia($id, $id_uzivatel, $id_miestnost, $ucel);								
							if($mysql_result == null){
								$message = 'Nastala chyba pri zmene.';
							}
							else
							{								
								$message2 = 'Rezervácia bola úspešne zmenená';					
								$popis = "Učiteľ " . $this->user->meno . ' '. $this->user->priezvisko . " zmenil rezerváciu s id=" .$id;
								$mysql->createNewLog($this->user->login, "Zmena rezervácie", $popis);
							}										
						}												
					}										
				}				
			}					
			if(@$_POST['ID_MAPA_SUBMIT_DELETE']){
				
				if(isset($_POST['ID_MAPA_SUBMIT_DELETE']) && isset($_POST['ID_REZERVACIA_SUBMIT_DELETE']))
				{
					$id_mapa = $_POST['ID_MAPA_SUBMIT_DELETE'];			
					$id_rezervacia = $_POST['ID_REZERVACIA_SUBMIT_DELETE'];											
					$mysql = new Connection();
					$mysql_result_pocet = $mysql->getNumberOfReservationsInMapByID($id_rezervacia);								
					
					$mysql_result = $mysql->deleteReservationInMapByID($id_mapa);								
					if($mysql_result == true)
					{
						$popis = "Učiteľ " . $this->user->meno . ' '. $this->user->priezvisko . " zmazal mapu rezervácie pod id=" .$id_mapa;
						$mysql->createNewLog($this->user->login, "Zmazanie mapy rezervácie", $popis);
						if($mysql_result_pocet[0] == 1){
							
							$mysql_result = $mysql->deleteReservationByID($id_rezervacia);								
							if($mysql_result == true){
								$message2 = 'Rezervácia bola úspešne odstránená';
								$popis = "Učiteľ " . $this->user->meno . ' '. $this->user->priezvisko . " zmazal rezerváciu s id=" .$id_rezervacia;
								$mysql->createNewLog($this->user->login, "Zmazanie rezervácie", $popis);
							}
							else{
								$message = 'Nastala chyba pri odstránení rezervácií';
							}		
						}
						else
						{
							$message2 = 'Rezervácia bola úspešne odstránená';
						}						
					}
					else{
						$message = 'Nastala chyba pri odstránení mapy rezervácie';
					}
					
					
				}
			}			
			$this->show('Kalendár', 'kalendar',array('message' => $message, 'message2' => $message2));
		}	
		else{
			$this->showLogin('Pre vstup je nutné byť prihlásený.');
		}
	}
	
	public function rezervacia(){
		if($this->user != null){
			if(@$_POST['vytvorRezervaciu']){

				if (isset($_POST['ucel']) && isset($_POST['pocetOsob']) && isset($_POST['startDate']) &&
				isset($_POST['startHour']) && isset($_POST['startMinute']) && isset($_POST['endHour']) && isset($_POST['endMinute']) &&
				( ($_POST['startHour']<$_POST['endHour']) || ($_POST['startHour']==$_POST['endHour'] && $_POST['startMinute']<$_POST['endMinute']))) {

				$user = $this->user->id;
				$mysql = new Connection();
				$mysql_result = $mysql->getRoomIdByName($_POST['miestnost']);
				$roomID = $mysql_result['ID'];
				$ucel = $_POST['ucel'];

				$mysql_result = $mysql->createReservation($user, $roomID , $ucel);
				if($mysql_result == null){
					$message = 'Nastala chyba pri vytvárani.';
				}	
				else
				{
					$mysql_result = $mysql->getLastRecord(); 
					$id = $mysql_result['ID'];

					$datum = array_reverse(explode("/", $_POST['startDate']));
					$zaciatok = $datum[0] . '-' . $datum[1] . '-' . $datum[2] . ' ' . $_POST['startHour'] . ':' . $_POST['startMinute'] . ':00';
					$koniec = $datum[0] . '-' . $datum[1] . '-' . $datum[2] . ' ' . $_POST['endHour'] . ':' . $_POST['endMinute'] . ':00';

					$pocetOsob = $_POST['pocetOsob'];

					$opakovania = $_POST['opakovania'];

					for ($i=0;$i<$opakovania;$i++){
						$start = new DateTime($zaciatok);
						$start->add(new DateInterval('P'.$i*7 .'D'));
						$start = $start->format('Y-m-d H:i:s');
						$end = new DateTime($koniec);
						$end->add(new DateInterval('P'.$i*7 .'D'));
						$end = $end->format('Y-m-d H:i:s');

						$mysql = new Connection();
						$mysql_result = $mysql->getReservationsFromTo($roomID, $start, $end);
						if (!empty($mysql_result)) {
							echo 'Rezerváciu v čase od ' . $start . ' do ' . $end . ' sa nepodarilo vytvoriť, termín je už obsadený.<br>';
						}
						else {
							$mysql_result = $mysql->createReservationMap($id, $zaciatok, $koniec, $pocetOsob, $i);
						}
					}
					
					$popis = "Učiteľ " . $this->user->meno . ' '. $this->user->priezvisko . " pridal do databázy rezerváciu pod id=" . $id . " (" . $opakovania . " opakovaní)";
					$mysql->createNewLog($this->user->login, "Pridanie rezervácie", $popis);

					$this->show('Učiteľ | Rezervácia', 'message',array('message' => "Úspešné vytvorenie rezervácie."));									
				}

			
			}
			else {
				$this->show('Učiteľ | Rezervácia','form/rezervacia',array('message' => 'Vytvoriť rezervaciu'));	
				echo "Chybne vyplnený formulár.";
			}
			}
			//$mysql = new Connection();
			//$mysql_result = $mysql->getReservationsFromTo(2, '2015-01-28 08:30:00', '2015-01-28 09:30:00'); Otestované pre všetkých 6 možných prípadov
			$this->show('Učiteľ | Rezervácia','form/rezervacia',array('message' => 'Vytvoriť rezervaciu'));	
					
		}	
		else{
			$this->showLogin('Pre vstup je nutné byť prihlásený.');
		}
	}
	
	public function prihlasenie(){
		if($this->user == null){
			$this->showLogin();
		}	
		else{
			$this->refresh('Ucitel/');
		}
	}
	
	public function odhlasenie(){
		if($this->user != null){
			unset($_SESSION['id_user']);
			setcookie('is_auth', 0, time() - 1); //zmaze cookie
			$this->user = null;
			$this->showLogin('Odhlásenie prebehlo úspešne.');
		}	
		else{
			$this->showLogin('Už ste boli odhlásený.');
		}
	}
	
	public function zmenaHesla($message = '', $message2 = ''){
		if($this->user != null){
			if(@$_POST['changePassword']){
				if(isset($_POST["stareheslo"]))
				{
					$stareHeslo = $this->user->heslo;
					if(sha1($_POST['stareheslo']) == $stareHeslo)
					{										
						if(isset($_POST['heslo']))
						{				
							if(strlen($_POST['heslo']) >= 6)
							{
								if($_POST['heslo'] == $_POST['heslo2'])
								{
									$heslo = sha1($_POST['heslo']);
									$id = $this->user->id;
									$mysql = new Connection();
									
									$mysql_result = $mysql->changePass($id, $heslo);
									if($mysql_result == null)
									{
										$message = 'Nastala chyba pri vytvárani.';
									}	
									else
									{								
										$popis = "Učiteľ " . $this->user->meno . ' '. $this->user->priezvisko . " si zmenil heslo";
										$message2 = "Úspešne zmenené heslo.";
										$mysql->createNewLog($this->user->login, "Zmena hesla", $popis);
									}														
								}
								else
								{
									$message = 'Nezhodujú sa heslá.';
								}
							}
							else
							{
								$message = 'Heslo musí mať aspoň 6 znakov.';
							}
						}
					}
					else
					{
						$message = 'Heslo sa nezhoduje so starym heslom.';
					}
				}				
			}
			$this->show('Zmena Hesla', 'form/zmenaHesla',array('message' => $message, 'message2' => $message2));
		}
		else{
			$this->showLogin('Pre vstup je nutné byť prihlásený.');
		}
	}
}
