<?php
class Miestnost
{
	public $id;
	public $typ;
	public $kapacita;
	public $nazov;

	public function __construct($Miestnost = array('ID'=>'','typ'=>'','kapacita'=>'','nazov'=>'')) {
		$this->id = $Miestnost['ID'];
		$this->typ = $Miestnost['typ'];
		$this->kapacita = $Miestnost['kapacita'];
		$this->nazov = $Miestnost['nazov'];
	}
}

/*ZMENA */