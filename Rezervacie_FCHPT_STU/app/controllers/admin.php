<?php
class Admin extends Controller
{
	public function index(){
		if($this->user != null){
			if($this->user->admin){
				$this->show('Admin','message',array('message' => 'Ste v �asti administr�cie.'));
			}
			else{
				$this->show('Oops','message',array('message' => 'Pr�stup bol zamietnut�.'));
			}		
		}	
		else{
			$this->showLogin('Pre vstup je nutn� by� prihl�sen�.');
		}
	}
}