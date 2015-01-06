<?php 
	require_once 'form/administracia.php';
?>
<table>
	<?php
	foreach ($data['logs'] as $log){
		echo '<tr><td>'.$log['Uzivatel'].'</td><td>'.$log['Akcia'].'</td><td>'.$log['Datum'].'</td><td>'.$log['Popis'].'</td></tr>';
	}
	?>
</table>