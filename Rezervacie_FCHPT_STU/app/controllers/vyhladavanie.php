<?php
class Vyhladavanie extends Controller
{
	public function index(){
		$this->hladaj();
	}

	public function hladaj($message = '',$message2 = ''){		
		if(@$_POST['ID_MAPA_SUBMIT']){																			
			if($this->user != null){
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
			else{
				$this->showLogin('Pre vstup je nutné by prihlásenı.');
			}
		}
		if(@$_POST['ID_MAPA_SUBMIT_DELETE']){
			if($this->user != null){	
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
			else{
				$this->showLogin('Pre vstup je nutné by prihlásenı.');
			}
		}			
		$this->show('Vy¾adávanie','form/vyhladavanie',array('message' => $message, 'message2' => $message2));						
	}
}