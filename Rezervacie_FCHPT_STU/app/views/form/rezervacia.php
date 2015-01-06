<script type="text/javascript" charset="utf-8">
	function setOutputNumber1(){
		document.getElementById('number1').innerHTML = document.getElementById('pocetOsob').value;	
	}
	
	function setOutputNumber2(){
		document.getElementById('number2').innerHTML = document.getElementById('opakovania').value;	
	}
	
	function setMaxRange(){	
		var e = document.getElementById("miestnost");
		var Miestnost_Kapacita = e.options[e.selectedIndex].text;
		var Kapacita_STR = Miestnost_Kapacita.split('(')[1].replace(")", "");
		var Kapacita = parseInt(Kapacita_STR);
		var range_value_str = document.getElementById('pocetOsob').value;
		var range_value = parseInt(range_value_str);
		
		if(Kapacita < range_value)
		{			
			document.getElementById('pocetOsob').value = Kapacita;
			document.getElementById('number1').innerHTML = Kapacita;			
		}
		else
		{						
			document.getElementById('pocetOsob').value = range_value-1;
			document.getElementById('pocetOsob').value = range_value;
			document.getElementById('number1').innerHTML = range_value;
		}
		var slider = document.getElementById("pocetOsob");
		if ('max' in slider) {  
			slider.max = Kapacita;
		} else {
			   
			slider.setAttribute ("max", Kapacita);
		}
	}
</script>

<?php 
function showTimeSelector($text){
	 
	echo '<td>';
	echo ' <select class="form-control" name="' . $text . 'Hour">';

	for ($i = 0; $i <= 23; $i++) {
			if ($i==9 && $text=="start") {
				echo '<option value="' . sprintf('%02d', $i) . '" selected="selected">' . sprintf('%02d', $i) . '</option>' . "\n";
			}
			elseif ($i==11 && $text=="end") {
				echo '<option value="' . sprintf('%02d', $i) . '" selected="selected">' . sprintf('%02d', $i) . '</option>' . "\n";
			}

			else {
		  		echo '<option value="' . sprintf('%02d', $i) . '">' . sprintf('%02d', $i) . '</option>' . "\n";
			}
	}
	echo '</select></td>';
	
	echo '<td><strong>:</strong></td>';
	
	echo '<td><select class="form-control" name="' . $text . 'Minute">';
	for ($i = 0; $i < 12; $i++) {
			echo '<option value="' . sprintf('%02d', $i*5) . '">' . sprintf('%02d', $i*5) . '</option>' . "\n";
	}
	echo '</select></td>';
}

	
	if($this->user != null){	
		
		?>
		<hr>
		<h3 class="text-center">Nová rezervácia</h3>
		<hr>
		<form method="post" role="form" class="form-horizontal">
		
		<div class="col-md-4">
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
					echo '<td class="col-md-2">';
					echo '<input class="form-control" type="checkbox" name="' . $result[$i]['ID'] . '" id="room' . $result[$i]['ID'] . '">';
					echo '</td>';
					echo '<td class="col-md-10">';
					echo '<label class="control-label" for="room' . $result[$i]['ID'] . '"> ' . $result[$i]['Nazov'] . '</label>';
					echo '</td>';
					echo '</tr>';			
			} 
		?>
		</table>
		</div>
		</div>
		<div class="col-md-1"></div>
		
		<div class="col-md-4">
		<div class="form-group">
		<label class="control-label" for="miestnost">Výber miestnosti: </label>
		<select class="form-control" name="miestnost" id="miestnost" onChange="setMaxRange();">
		<?php 
			$mysql = new Connection();
			$result = $mysql->getAllRooms();		
			for($i=0; $i < count($result); $i++){
				if (($result[$i]['Nazov'] . '('. $result[$i]['Kapacita'] . ')') == ($_POST['miestnost']. '('. $result[$i]['Kapacita'] . ')')) {
					echo '<option value="' . $result[$i]['Nazov'] . '"'. ' selected>' . $result[$i]['Nazov'] . '('. $result[$i]['Kapacita'] . ')</option>' . "\n";
				}
				else {
					echo '<option value="' . $result[$i]['Nazov'] . '"'. '>' . $result[$i]['Nazov'] . '('. $result[$i]['Kapacita'] . ')</option>' . "\n";
				}
			} 
		?>	
		</select>
		</div>
		
		<div class="form-group">
		<label class="control-label" for="ucel">Účel rezervácie: </label>
		<textarea class="form-control" name="ucel" id="ucel" rows="3" cols="35" placeholder="Vyplňte účel vytvorenia rezervácie" required><?php if (isset($_POST['ucel'])) {echo $_POST['ucel'];}?></textarea>
		</div>
		
		<div class="form-group">
		<label class="control-label" for="pocetOsob">Počet osôb: </label>
		<input class="form-control" type="range" name="pocetOsob" min="1" oninput="number1.value=pocetOsob.value" id="pocetOsob" onChange="setOutputNumber1();" value="<?php if(isset($_POST['pocetOsob'])) {echo $_POST['pocetOsob'];}?>">
		<div class="col-md-5"></div>
		<div class="col-md-2">
		<output class="form-control" name="number1" for="pocetOsob" id="number1">10</output>
		</div>
		<div class="col-md-5"></div>
		</div>
		<!-- <div id="demo"></div> -->
		
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
		<table>
		<tr>
		<td>
		 <div class="hero-unit has-feedback has-feedback-right">
			<input class="form-control" name="startDate" type="text" class="dp" size="8" id="datepicker" value="<?php if(isset($_POST['startDate'])) {echo $_POST['startDate'];} ?>" required>
			<i class="glyphicon glyphicon-calendar form-control-feedback"></i>
		</div>
		</td>
		<td><a class="invisible">a</a></td>
		<?php
		showTimeSelector("start");
		?>
		</tr>
		</table>
		</div>

		<div class="form-group">
		<strong>Koniec:</strong>
		<table>
		<tr>
		<?php
		showTimeSelector("end");
		?>
		</tr>
		</table>
		</div>
		
		<div class="form-group">
		<label class="control-label" for="opakovania">Počet opakovaní: </label>
		<input class="form-control" type="range" name="opakovania" oninput="number2.value=opakovania.value" id="opakovania" min="1" max="10" value="1" onChange="setOutputNumber2();">
		<div class="col-md-5"></div>
		<div class="col-md-2">
		<output class="form-control" name="number2" id="number2" for="opakovania">1</output>
		</div>
		<div class="col-md-5"></div>
		</div>
		
		<div class="form-group">
		<input class="form-control input-lg btn-success" type="submit" name="vytvorRezervaciu" value="Vytvoriť rezerváciu">
		</div>
		
		</div>
		<div class="col-md-4"></div>
		</form>
		
		<script>
			setMaxRange();
		</script>
		<?php	
	}
?>
