<?php 
	require_once 'form/administracia.php';
?>
<hr>
<h3 class="text-center">Prehľad logov</h3>
<hr>
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