<?php 
//******************ZMENA
	if($this->user != null){				
		if($this->user->admin){	
		echo '<div class="row">';
			echo '<div class="list-group col-md-4">';
			echo '<a class="list-group-item" href="http://'.DOMAIN.'/'.URL_BASE.'/Admin/CreateNewUser">Vytvorenie nového používateľa</a>';							
			echo '<a class="list-group-item" href="http://'.DOMAIN.'/'.URL_BASE.'/Admin/ZmenaPrav">Zmena administrátorských práv</a>';
			echo '</div>';
			echo '<div class="list-group col-md-4">';
			echo '<a class="list-group-item" href="http://'.DOMAIN.'/'.URL_BASE.'/Admin/CreateNewRoom">Vytvorenie novej miestnosti</a>';
			echo '<a class="list-group-item" href="http://'.DOMAIN.'/'.URL_BASE.'/Admin/handleRooms">Správa miestností</a>';
			echo '</div>';
			echo '<div class="list-group col-md-4">';
			echo '<a class="list-group-item" href="http://'.DOMAIN.'/'.URL_BASE.'/Admin/CreateNewRoomType">Vytvorenie nového typu miestnosti</a>';				
			echo '<a class="list-group-item" href="http://'.DOMAIN.'/'.URL_BASE.'/Admin/handleRoomTypes">Správa typov miestností</a>';				
			echo '</div>';
			echo '<div class="row">';
			echo '<div class="list-group col-md-4"></div>';
			echo '<div class="list-group col-md-4">';
			echo '<a class="list-group-item" href="http://'.DOMAIN.'/'.URL_BASE.'/Admin/logy">Prehľad logov</a>';					
			echo '</div>';
			echo '<div class="list-group col-md-4"></div>';
			echo '</div>';
		echo '</div>';
		}
	}
//******************KONIEC ZMENY
?>
