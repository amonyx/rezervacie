<?php 
	require_once 'form/administracia.php';
?>
<hr>
<h3 class="text-center">Prehľad logov</h3>
<hr>

<form method="post">
<div style="margin: 0.5em 0;">
<span>Vymazať z databázy rezervácie staršie ako 6 mesiacov: </span>
<input type="submit" value="Vymaž" name="deleteDB">
</div>
</form>
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