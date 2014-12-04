<?php
class Vyhladavanie extends Controller
{
	public function index(){
		$this->hladaj();
	}

	public function hladaj(){
		$this->show('Vy¾adávanie','form/vyhladavanie',array());
	}

	public function kalendar_ucitel($id){
		
	}

	public function kalendar_miestnost($id){
		
	}

	public function klucove_slovo($slovo){
		
	}
}