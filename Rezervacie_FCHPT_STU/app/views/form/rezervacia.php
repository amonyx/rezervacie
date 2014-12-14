<?php 
//******************ZMENA
	if($this->user != null){				
		?>
		<h3>Pridanie rezervacie</h3>
		
		<form method="post">
		Typy miestnosti: <br>
		<input type="checkbox" name="lab" id="lab"> <label for="lab">Laboratorium</label><br>
		<input type="checkbox" name="kanc" id="kanc"> <label for="kanc">Kancelaria</label><br>
		<input type="checkbox" name="ucebna" id="ucebna"> <label for="ucebna">Ucebna</label><br>
		
		<p>
		<label for="miestnost">Vyber miestnosti</label>
		<select name="miestnost" id="miestnost">
			<option value="room1">Miestnost 1</option>
			<option value="room2">Miestnost 2</option>
			<option value="room3">Miestnost 3</option>
		</select></p>
		
		<p><label for="ucel">Ucel rezervacie: </label><br>
		<textarea name="ucel" id="ucel" rows="6" cols="25">
Vyplnte ucel vytvorenia rezervacie
		</textarea></p>
		
		<p><label for="pocetOsob">Pocet osob: </label>
		<input type="range" name="pocetOsob" oninput="number1.value=pocetOsob.value" id="pocetOsob" min="1" max="20">
		<output name="number1" for="pocetOsob">10</output></p>
		
		<p>
		<label for="zaciatok">Od kedy:</label>
		<input type="date" id="zaciatok" name="zaciatok">
		</p>
		
		<p>
		<label for="koniec">Do kedy:</label>
		<input type="date" id="koniec" name="koniec">
		</p>
		
		<p><label for="opakovania">Pocet opakovani: </label>
		<input type="range" name="opakovania" oninput="number2.value=opakovania.value" id="opakovania" min="1" max="10" value="1">
		<output name="number2" for="opakovania">1</output></p>
		
		<input type="button" value="Pridat">
		
		</form>
		<?php
	}
//******************KONIEC ZMENY
?>
