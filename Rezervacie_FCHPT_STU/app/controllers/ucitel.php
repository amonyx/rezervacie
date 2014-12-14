<?php
class Ucitel extends Controller
{
	public function index(){
		if($this->user != null){
				$this->show('U�ite�','message',array('message' => 'Ste v �asti pre u�ite�ov.'));			
		}	
		else{
			$this->showLogin('Pre vstup je nutn� by� prihl�sen�.');
		}
	}
	
	public function kalendar(){
		if($this->user != null){
			// zobrazenie vlastneho kalendara pre ucitela
			$this->show('U�ite� | Kalend�r','message',array('message' => 'Ste v �asti pre u�ite�ov.'));		
		}	
		else{
			$this->showLogin('Pre vstup je nutn� by� prihl�sen�.');
		}
	}
	
	public function rezervacia(){
		if($this->user != null){
			// vytvorenie novej rezervacie
			$this->show('U�ite� | Rezerv�cia','message',array('message' => 'Ste v �asti pre u�ite�ov.'));	
		}	
		else{
			$this->showLogin('Pre vstup je nutn� by� prihl�sen�.');
		}
	}
	
	public function prihlasenie(){
		if($this->user == null){
			$this->showLogin();
		}	
		else{
			$this->show('Prihl�senie','message',array('message' => 'U� ste pr�hl�sen�.'));
		}
	}
	
	public function odhlasenie(){
		if($this->user != null){
			unset($_SESSION['id_user']);
			setcookie('is_auth', 0, time() - 1); //zmaze cookie
			$this->user = null;
			$this->show('Odhl�senie','message',array('message' => 'Odhl�senie prebehlo �spe�ne.'));
		}	
		else{
			$this->showLogin('U� ste boli odhl�sen�.');
		}
	}
}
