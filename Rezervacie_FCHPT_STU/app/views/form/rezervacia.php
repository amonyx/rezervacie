<?php 

function showTimeSelector($text){
	echo ' <select class="form-control" name="' . $text . 'Hour">';
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
	
	echo ' <select class="form-control" name="' . $text . 'Minute">';
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
		<hr>
		<h3 class="text-center">Nová rezervácia</h3>
		<hr>
		<form method="post" role="form" class="form-horizontal">
		
		<div class="col-md-1"></div>
		<div class="col-md-3">
		<div class="form-group">
		<table class="table">
		<thead>
		<tr>
		<th>
		<strong class="text-center">Typy miestností</strong>
		</th>
		<th>
		</th>
		</tr>
		</thead>
		<?php 
			$mysql = new Connection();
			$result = $mysql->getRoomTypes();		
			for($i=0; $i < count($result); $i++){
					echo '<tr>';
					echo '<td>';
					echo '<input class="form-control" type="checkbox" name="' . $result[$i]['ID'] . '" id="room' . $result[$i]['ID'] . '">';		
					echo '</td>';
					echo '<td>';
					echo '<label class="control-label" for="room' . $result[$i]['ID'] . '"> ' . $result[$i]['Nazov'] . '</label>';
					echo '</td>';
					echo '</tr>';			
			} 
		?>
		</table>
		</div>
		</div>
		<div class="col-md-1"></div>
		
		<div class="col-md-6">
		<div class="form-group">
		<label class="control-label" for="miestnost">Výber miestnosti: </label>
		<select class="form-control" name="miestnost" id="miestnost">
		<?php 
			$mysql = new Connection();
			$result = $mysql->getAllRooms();		
			for($i=0; $i < count($result); $i++){
					echo '<option value="' . $result[$i]['Nazov'] . '">' . $result[$i]['Nazov'] . '</option>' . "\n";
			} 
		?>	
		</select>
		</div>
		
		<div class="form-group">
		<label class="control-label" for="ucel">Účel rezervácie: </label>
		<textarea class="form-control" name="ucel" id="ucel" rows="3" cols="35" placeholder="Vyplňte účel vytvorenia rezervácie"></textarea>
		</div>
		
		<div class="form-group">
		<label class="control-label" for="pocetOsob">Počet osôb: </label>
		<input class="form-control" type="range" name="pocetOsob" oninput="number1.value=pocetOsob.value" id="pocetOsob" min="1" max="20" value="10">
		<output class="form-control" name="number1" for="pocetOsob" id="number1">10</output>
		</div>
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
		
		<div class="form-group">
		<strong>Začiatok:</strong>
	    <script src="http://<?=DOMAIN?>/<?=URL_BASE?>/js/jquery-1.10.2.js"></script>
		<script>
		  $(document).ready(function () {
			$('#datepicker').datepicker({
			  format: "dd/mm/yyyy"
			});

		   $('.dp').on('change', function(){
			   $('.dp').hide();
		   });

			});
  		</script>
		 <div class="hero-unit">
			<input class="form-control" name="startDate" type="text" class="dp" size="8" id="datepicker">
		</div>
		<?php
		showTimeSelector("start");
		?>
		</div>

		<div class="form-group">
		<strong>Koniec:</strong>
		<?php
		showTimeSelector("end");
		?>
		</div>
		
		<div class="form-group">
		<label class="control-label" for="opakovania">Počet opakovaní: </label>
		<input class="form-control" type="range" name="opakovania" oninput="number2.value=opakovania.value" id="opakovania" min="1" max="10" value="1">
		<output class="form-control" name="number2" for="opakovania">1</output>
		</div>
		
		<div class="form-group">
		<input class="form-control input-lg btn-success" type="submit" name="vytvorRezervaciu" value="Vytvoriť rezerváciu">
		</div>
		
		</div>
		<div class="col-md-1"></div>
		</form>
		<?php	
	}
?>
