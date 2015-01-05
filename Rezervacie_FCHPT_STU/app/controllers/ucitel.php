<?php
class Ucitel extends Controller
{
	public function index(){
		if($this->user != null){
				$this->show('Učiteľ','message',array('message' => 'Ste v časti pre učiteľov.'));			
		}	
		else{
			$this->showLogin('Pre vstup je nutné by prihlásený.');
		}
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
						$message = 'Nastala chyba pri zmene mapy rezervacie.';
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
							$mysql = new Connection();
							$mysql_result = $mysql->updateRezervacia($id, $id_uzivatel, $id_miestnost, $ucel);								
							if($mysql_result == null){
								$message = 'Nastala chyba pri zmene.';
							}
							else
							{								
								$message2 = 'Rezervacia bola uspesne zmenena';
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
					
					$mysql = new Connection();
					$mysql_result = $mysql->deleteReservationInMapByID($id_mapa);								
					if($mysql_result == true)
					{
						if($mysql_result_pocet[0] == 1){
							
							$mysql = new Connection();
							$mysql_result = $mysql->deleteReservationByID($id_rezervacia);								
							if($mysql_result == true){
								$message2 = 'Rezervacia uspesne odstranena';
							}
							else{
								$message = 'Nastala chyba pri odstraneni rezervacii';
							}		
						}
						else
						{
							$message2 = 'Rezervacia uspesne odstranena';
						}						
					}
					else{
						$message = 'Nastala chyba pri odstraneni mapy rezervacie';
					}
					
					
				}
			}			
			$this->show('Kalendar', 'kalendar',array('message' => $message, 'message2' => $message2));
		}	
		else{
			$this->showLogin('Pre vstup je nutné by prihlásený.');
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

				$mysql = new Connection();
				$mysql_result = $mysql->createReservation($user, $roomID , $ucel);
				if($mysql_result == null){
					$message = 'Nastala chyba pri vytvárani.';
				}	
				else
				{
					$popis = "Učiteľ " . $this->user->meno . ' '. $this->user->priezvisko . " pridal do databázy novú rezerváciu";
					$mysql = new Connection();
					$mysql_result = $mysql->createNewLog($this->user->id, "Pridanie", $popis); //pridanie logu

					$mysql = new Connection();
					$mysql_result = $mysql->getLastRecord(); 
					$id = $mysql_result['ID'];

					$datum = array_reverse(explode("/", $_POST['startDate']));
					$zaciatok = $datum[0] . '-' . $datum[1] . '-' . $datum[2] . ' ' . $_POST['startHour'] . ':' . $_POST['startMinute'] . ':00';
					$koniec = $datum[0] . '-' . $datum[1] . '-' . $datum[2] . ' ' . $_POST['endHour'] . ':' . $_POST['endMinute'] . ':00';

					$pocetOsob = $_POST['pocetOsob'];

					$opakovania = $_POST['opakovania'];

					for ($i=0;$i<$opakovania;$i++){
					$mysql = new Connection();
					$mysql_result = $mysql->createReservationMap($id, $zaciatok, $koniec, $pocetOsob, $i);
					}

					$this->show('Učiteľ | Rezervácia', 'message',array('message' => "Úspešné vytvorenie rezervácie."));									
				}

			
			}
			else {
				$this->show('Učiteľ | Rezervácia','form/rezervacia',array('message' => 'Vytvoriť rezervaciu'));	
				echo "Chybne vyplnený formulár.";
			}
			}

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
			$this->show('Prihlásenie','message',array('message' => 'Už ste príhlásený.'));
		}
	}
	
	public function odhlasenie(){
		if($this->user != null){
			unset($_SESSION['id_user']);
			setcookie('is_auth', 0, time() - 1); //zmaze cookie
			$this->user = null;
			$this->show('Odhlásenie','message',array('message' => 'Odhlásenie prebehlo úspešne.'));
		}	
		else{
			$this->showLogin('Už ste boli odhlásený.');
		}
	}
	
	public function zmenaHesla($message = ''){
		if($this->user != null){
			if(@$_POST['changePassword']){
				if(isset($_POST['heslo']) && $_POST['heslo'] != '')
				{				
					if(strlen($_POST['heslo']) >= 6)
					{
						if($_POST['heslo'] == $_POST['heslo2'])
						{
							$heslo = sha1($_POST['heslo']);
							
						}
					}
				}
			}
			$this->show('Zmena Hesla', 'form/zmenaHesla',array('message' => $message));
		}
		else{
			$this->showLogin('Už ste boli odhlásený.');
		}
	}


}
