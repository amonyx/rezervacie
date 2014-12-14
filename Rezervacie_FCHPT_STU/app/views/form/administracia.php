<?php 
//******************ZMENA
	if($this->user != null){				
		if($this->user->admin){								
			echo '<li><a href="http://'.DOMAIN.'/'.URL_BASE.'/Admin/CreateNewUser">Vytvorenie noveho pouzivatela</a></li>';					
			echo '<li><a href="http://'.DOMAIN.'/'.URL_BASE.'/Admin/CreateNewUser">Vytvorenie novej miestnosti</a></li>';					
			echo '<li><a href="http://'.DOMAIN.'/'.URL_BASE.'/Admin/CreateNewUser">Zmena administratoskych prav</a></li>';					
		}
	}
//******************KONIEC ZMENY
?>
