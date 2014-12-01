<?php
class Vyhladavanie extends Controller
{
	public function index($kokotina = ''){
		$this->hladaj($kokotina);
	}

	public function hladaj($kokotina = ''){
		$this->show('formular/vyhladavanie',array('param' => $kokotina, 'param2' => 'picovina'));
	}

	public function kalendar_ucitel($id){
		
	}

	public function kalendar_miestnost($id){
		
	}

	public function klucove_slovo($slovo){
		
	}
}