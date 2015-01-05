<?php 
	if(!(isset($_GET['changeRoomType'])) && (!(isset($_GET['deleteRoomType'])))){

	require_once 'administracia.php';
?>

<hr>
<h3 class="text-center">Správa typov miestností</h3>
<hr>

<form action="" method="GET" role="form">
	<table class="table table-striped table-bordered table-hover">
		<thead>
		<tr>
			<th class="text-center">
			<h3>Názov</h3>
			</th>
			<th>
			</th>
			<th>
			</th>
		</tr>
		</thead>
			<?php	

				$mysql = new Connection();
				$results = $mysql->getRoomTypes();

				$arr_length = count($results);
	
				for($i = 0; $i < $arr_length; $i++){
				echo "<tr>";
					echo "<td class='text-center'>";
					echo "<big>";
					echo $results[$i]['Nazov'];
					echo "</big>";
					echo "</td>";
					echo "<td class='text-center'>";
					echo '<button class="btn-lg btn-warning glyphicon glyphicon-pencil" value="'.$results[$i]["ID"].'" name="changeRoomType" type="submit" id="changeRoomType">Zmeniť</button>';
					echo "</td>";
					echo "<td class='text-center'>";
					echo '<button class="btn-lg btn-danger glyphicon glyphicon-remove" value="'.$results[$i]["ID"].'" name="deleteRoomType" type="submit" id="deleteRoomType">Zmazať</button>';
					echo "</td>";
				echo "</tr>";
				}
			?>
	</table>
</form>
<?php	
}else{
		if(isset($_GET['deleteRoomType'])){
			$mysql = new Connection();
			$delete_result = $mysql->deleteRoomType($_GET['deleteRoomType']);
			if($delete_result){
				$popis = "Admin " . $this->user->meno . ' '. $this->user->priezvisko . " zmazal typ miestnosti s id=" . $_GET['deleteRoomType'];
				$mysql->createNewLog($this->user->login, "Zmazanie typu miestnosti", $popis);
				echo "Typ miestnosti úspešne zmazaný!";
			}else{
				echo "Typ miestnosti sa nepodarilo zmazať!";
			}
			header('Location : http://'.DOMAIN.'/'.URL_BASE.'/Admin/handleRoomTypes');
		}
	
		if(isset($_GET['changeRoomType'])){
			if(isset($_POST['handleRoomTypes'])){
				$mysql = new Connection();
				$change_result = $mysql->changeRoomType($_POST['name_room_type']);
				if($change_result){
					$popis = "Admin " . $this->user->meno . ' '. $this->user->priezvisko . " zmenil typ miestnosti " . $_POST['name_room_type'];
					$mysql->createNewLog($this->user->login, "Zmena typu miestnosti", $popis);
					echo "Typ miestnosti úspešne zmenený!";
				}else{
					echo "Typ miestnosti sa nepodarilo zmeniť!";
				}
			}else{
				include 'updateRoomType.php';
			}
		}
	}
?>