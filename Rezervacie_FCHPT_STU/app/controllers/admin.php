<?php
class Admin extends Controller
{
	public function index(){
		if($this->user != null){
			if($this->user->admin){
				$this->show('Admin','message',array('message' => 'Ste v èasti administrácie.'));
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