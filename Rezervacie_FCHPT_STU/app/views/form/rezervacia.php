<?php 
//******************ZMENA
     function showDateSelector($text) {
		$currentDay = date("j");
		$currentMonth = date("n");
		$currentYear = date("Y");
		echo '<select name="' . $text . 'Day' . '">';
		for ($i=1; $i<=31; $i++){
			if ($currentDay == $i) {
				echo '<option value="' . $i . '" selected="selected">' . $i . '</option>' . "\n";
			}
			else {
				echo '<option value="' . $i . '">' . $i . '</option>' . "\n";
			}
		}
		echo '</select>';
		
		$months = array("Január", "Február", "Marec", "Apríl", "Máj", "Jún", "Júl", "August", "September", "Október", "November", "December");
		echo '<select name="' . $text . 'Month' . '">';
		for ($i=0; $i<12; $i++){
			if ($currentMonth == ($i+1)) {
				echo '<option value="' . $months[$i] . '" selected="selected">' . $months[$i] . '</option>' . "\n";
			}
			else {
				echo '<option value="' . $months[$i] . '">' . $months[$i] . '</option>' . "\n";
			}
		}
		echo '</select>';
		
		echo '<select name="' . $text . 'Year' . '">';
		for ($i=2014; $i<=2030; $i++){
			if ($currentYear == ($i+1)) {
				echo '<option value="' . $i . '" selected="selected">' . $i . '</option>' . "\n";
			}
			else {
				echo '<option value="' . $i . '">' . $i . '</option>' . "\n";
			}
		}	
		echo '</select>';
		
	}
	
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
		<textarea name="ucel" id="ucel" rows="6" cols="25" placeholder="Vyplnte ucel vytvorenia rezervacie"></textarea></p>
		
		<p><label for="pocetOsob">Pocet osob: </label>
		<input type="range" name="pocetOsob" oninput="number1.value=pocetOsob.value" id="pocetOsob" min="1" max="20">
		<output name="number1" for="pocetOsob">10</output></p>
		
		<p>
		Od kedy:
		
		<?php
		showDateSelector("start");
		echo ' <select name="startHour">';
		for ($i = 0; $i <= 23; $i++) {
			if ($i<10) {
				if ($i==9) {
				echo '<option value="0' . $i . '" selected="selected">0' . $i . '</option>' . "\n";
				}
			else {	
			  echo '<option value="0' . $i . '">0' . $i . '</option>' . "\n";
			  }
			}
			else {
			  echo '<option value="' . $i . '">' . $i . '</option>' . "\n";
			}
		}
		echo '</select> : ';
		
		echo '<select name="endHour">';
		for ($i = 0; $i < 12; $i++) {
			if ($i<2) {
			  echo '<option value="0' . $i*5 . '">0' . $i*5 . '</option>' . "\n";
			}
			else {
			  echo '<option value="' . $i*5 . '">' . $i*5 . '</option>' . "\n";
			}
		}
		echo '</select>';
		?>
		</p>
		
		<p>
		Do kedy:
		<?php
		showDateSelector("end");
		echo ' <select name="endHour">';
		for ($i = 0; $i <= 23; $i++) {
			if ($i<10) {
			  echo '<option value="0' . $i . '">0' . $i . '</option>' . "\n";
			}
			else {
			if ($i==11){
				echo '<option value="' . $i . '" selected="selected">' . $i . '</option>' . "\n";
			} else {
			  echo '<option value="' . $i . '">' . $i . '</option>' . "\n";
			}
			}
		}
		echo '</select> : ';
		
		echo '<select name="endMinute">';
		for ($i = 0; $i < 12; $i++) {
			if ($i<2) {
			  echo '<option value="0' . $i*5 . '">0' . $i*5 . '</option>' . "\n";
			}
			else {
			  echo '<option value="' . $i*5 . '">' . $i*5 . '</option>' . "\n";
			}
		}
		echo '</select>';
		?>
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
