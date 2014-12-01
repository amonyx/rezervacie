<?php
class Home extends Controller
{
	public function __construct(){
		$this->user = 'janko je kokot';
	}

	public function index(){
		$this->show('home',$this->user);
	}
}