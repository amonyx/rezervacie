<?php
class Ucitel extends Controller
{
	public function index(){
		if($this->user != null){
				$this->show('Uèite¾','message',array('message' => 'Ste v èasti pre uèite¾ov.'));			
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
				
			$this->show('Kalendar', 'kalendar',array('message' => $message, 'message2' => $message2));
		}	
		else{
			$this->showLogin('Pre vstup je nutné by prihlásený.');
		}
	}
	
	public function rezervacia(){
		if($this->user != null){
			// vytvorenie novej rezervacie
			$this->show('Uèite¾ | Rezervácia','form/rezervacia',array('message' => 'Vytvorit rezervaciu'));	
					
		}	
		else{
			$this->showLogin('Pre vstup je nutné by prihlásený.');
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
