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
			$this->show('Uèite¾ | Rezervácia','message',array('message' => 'Ste v èasti pre uèite¾ov.'));	
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
}
