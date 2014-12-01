<?php
require_once '/app/models/Connection.php';

class Controller{
	private $user = null;
    
    public function show($view, $data = array())
    {
        require_once '/app/views/'.$view.'.php';
    }
}
?>