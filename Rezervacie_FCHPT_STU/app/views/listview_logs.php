<?php 
	require_once 'form/administracia.php';
?>
<hr>
<h3 class="text-center">Prehľad logov a vymazanie starých rezervácií</h3>
<hr>

<div class="col-md-4"></div>
<div class="col-md-4">
<form method="post" role="form" class="form-horizontal" style="padding-bottom:2em;">
<div class="form-group  text-center">
<label class="control-label" for="deleteDB"><strong>Vymazať z databázy rezervácie staršie ako 6 mesiacov:</strong></label>
</div>
<input type="submit" class="input-lg btn-warning form-control" value="Vymaž" name="deleteDB">
</form>
</div>
<div class="col-md-4"></div>

<span style="color:green;"><?=$data['message']?></span>
<table class="table table-striped table-condensed table-hover">

	<?php
	foreach($data['logs'] as $log){
		echo '<tr>
		<td class="text-center">'.$log['Datum'].'</td>
		<td class="text-center">'.$log['Uzivatel'].'</td>
		<td class="text-center">'.$log['Akcia'].'</td>
		<td class="text-center">'.$log['Popis'].'</td>
		</tr>';
	}
	?>
</table>