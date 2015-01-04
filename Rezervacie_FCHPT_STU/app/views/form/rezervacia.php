<?php 

function showTimeSelector($text){
	echo ' <select name="' . $text . 'Hour">';
	for ($i = 0; $i <= 23; $i++) {
		if ($i<10) {
			if ($i==9 && $text=="start") {
			echo '<option value="0' . $i . '" selected="selected">0' . $i . '</option>' . "\n";
			}
		else {	
		  echo '<option value="0' . $i . '">0' . $i . '</option>' . "\n";
		  }
		}
		else {
			if ($text=="end" && $i==11) {
			echo '<option value="' . $i . '" selected="selected">' . $i . '</option>' . "\n";
			}
		  echo '<option value="' . $i . '">' . $i . '</option>' . "\n";
		}
	}
	echo '</select> : ';
	
	echo ' <select name="' . $text . 'Minute">';
	for ($i = 0; $i < 12; $i++) {
		if ($i<2) {
		  echo '<option value="0' . $i*5 . '">0' . $i*5 . '</option>' . "\n";
		}
		else {
		  echo '<option value="' . $i*5 . '">' . $i*5 . '</option>' . "\n";
		}
	}
	echo '</select>';
}

	
	if($this->user != null){	
		
		?>
		
		<h3>Pridanie rezervácie</h3>
		
		<form method="post">
		Typy miestností: <br>
		<?php 
			$mysql = new Connection();
			$result = $mysql->getRoomTypes();		
			for($i=0; $i < count($result); $i++){
					echo '<input type="checkbox" name="' . $result[$i]['ID'] . '" id="room' . $result[$i]['ID'] . '">';
					echo '<label for="room' . $result[$i]['ID'] . '"> ' . $result[$i]['Nazov'] . '</label><br>';							
			} 
		?>
		
		<p>
		<label for="miestnost">Výber miestnosti: </label>
		<select name="miestnost" id="miestnost">
		<?php 
			$mysql = new Connection();
			$result = $mysql->getAllRooms();		
			for($i=0; $i < count($result); $i++){
					echo '<option value="' . $result[$i]['Nazov'] . '">' . $result[$i]['Nazov'] . '</option>' . "\n";
			} 
		?>	
		</select></p>
		
		<p><label for="ucel">Účel rezervácie: </label><br>
		<textarea name="ucel" id="ucel" rows="6" cols="25" placeholder="Vyplňte účel vytvorenia rezervácie"></textarea></p>
		
		<p><label for="pocetOsob">Počet osôb: </label>
		<input type="range" name="pocetOsob" oninput="number1.value=pocetOsob.value" id="pocetOsob" min="1" max="20" value="10">
		<output name="number1" for="pocetOsob" id="number1">10</output></p>
		<!-- <div id="demo"></div> -->

		<script type="text/javascript">

		var miestnosti_php = <?php 
			$mysql = new Connection(); 
			$result = $mysql->getAllRooms();		
			$result_string = "";
			for($i=0; $i < count($result); $i++){
				$result_string = $result_string . $result[$i]['Nazov']. ',' . $result[$i]['Kapacita'] . '#';
			}
			echo json_encode($result_string);
		?>;

		var pole_miestnosti = miestnosti_php.split("#");
		//document.getElementById("demo").innerHTML = pole_miestnosti;
		</script>
		<script type="text/javascript">
		$(document).ready(function() {
		    $("#miestnost").change(function() {
		       var room = $("#miestnost").val();
		       var ind = pole_miestnosti.indexOf(room);

		       $("#pocetOsob").attr({
			      "value" : pole_miestnosti[ind-1]/2,
			      "max" : pole_miestnosti[ind-1]
			    });
		       $("#number1").html(pole_miestnosti[ind-1]/2);
		    }); 
		});
		</script>
		
		<p>
		Začiatok:
		<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
	    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
	    <script src="../js/jquery-ui.js"></script>
		<script>
		  $(function() {
		    $("#datepicker").datepicker();
		  });
  		</script>
		<input type="text" name="startDate" id="datepicker">
		<?php
		showTimeSelector("start");
		?>
		</p>

		<p>
		Koniec:
		<?php
		showTimeSelector("end");
		?>
		</p>
		
		<p><label for="opakovania">Počet opakovaní: </label>
		<input type="range" name="opakovania" oninput="number2.value=opakovania.value" id="opakovania" min="1" max="10" value="1">
		<output name="number2" for="opakovania">1</output></p>
		
		<input type="submit" name="vytvorRezervaciu" value="Vytvoriť rezerváciu">
		
		</form>
		<?php
		
	}


?>
