<?php 
//******************ZMENA
	if($this->user != null){				
		if($this->user->admin){								
			echo '<li><a href="http://'.DOMAIN.'/'.URL_BASE.'/Admin/CreateNewUser">Vytvorenie noveho pouzivatela</a></li>';					
			echo '<li><a href="http://'.DOMAIN.'/'.URL_BASE.'/Admin/CreateNewUser">Vytvorenie novej miestnosti</a></li>';					
			echo '<li><a href="http://'.DOMAIN.'/'.URL_BASE.'/Admin/ZmenaPrav">Zmena administratoskych prav</a></li>';
			echo '<li><a href="http://'.DOMAIN.'/'.URL_BASE.'/Admin/CreateNewRoom">Vytvorenie novej miestnosti</a></li>';
			echo '<li><a href="http://'.DOMAIN.'/'.URL_BASE.'/Admin/handleRooms">Správa miestností</a></li>';
			echo '<li><a href="http://'.DOMAIN.'/'.URL_BASE.'/Admin/CreateNewRoomType">Vytvorenie nového typu miestnosti</a></li>';				
			echo '<li><a href="http://'.DOMAIN.'/'.URL_BASE.'/Admin/handleRoomTypes">Správa typov miestností</a></li>';								
		}
	}
//******************KONIEC ZMENY
?>
