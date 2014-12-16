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
	
	public function kalendar(){
		if($this->user != null){
			// zobrazenie vlastneho kalendara pre ucitela
			$this->show('Uèite¾ | Kalendár','message',array('message' => 'Ste v èasti pre uèite¾ov.'));		
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
