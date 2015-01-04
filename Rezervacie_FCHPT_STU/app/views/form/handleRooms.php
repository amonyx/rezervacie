<?php 
	if(!(isset($_GET['changeRoom'])) && (!(isset($_GET['deleteRoom'])))){

	require_once 'administracia.php';
	?>
	
<hr>
<h3 class="text-center">Správa miestností</h3>
<hr>
<form action="" method="GET">
	<table class="table table-striped table-bordered table-hover">
		<?php 
			$mysql = new Connection();
			//$test = $mysql->TEST_MIESTNOSTI_VYTVOR(100);
			$results = $mysql->getAllRooms();

			$arr_length = count($results);
		?>
		<thead>
		<tr>
			<th class="text-center">
			<h3>Názov</h3>
			</th>
			<th class="text-center">
			<h3>Kapacita</h3>
			</th>
			<th class="text-center">
			<h3>Typ</h3>
			</th>
			<th>
			
			</th>
			<th>
			
			</th>
		</tr>
		</thead>
			<?php	
				for($i = 0; $i < $arr_length; $i++){
				echo "<tr>";
					echo "<td class='text-center'>";
					echo "<big>";
					echo $results[$i]['Nazov'];
					echo "</big>";
					echo "</td>";
					
					echo "<td class='text-center'>";
					echo "<big>";
					echo $results[$i]['Kapacita'];
					echo "</big>";
					echo "</td>";
					
					echo "<td class='text-center'>";
					echo "<big>";
					$res = $mysql->getRoomTypeByID($results[$i]['ID_Typ_Miestnosti']);
					echo $res['Nazov'];
					echo "</big>";
					echo "</td>";
					
					echo "<td class='text-center'>";
					echo '<button class="btn-lg btn-warning glyphicon glyphicon-pencil" value="'.$results[$i]["ID"].'" name="changeRoom" type="submit" id="changeRoom">Zmeniť</button>';
					echo "</td>";
					echo "<td class='text-center'>";
					echo '<button class="btn-lg btn-danger glyphicon glyphicon-remove" value="'.$results[$i]["ID"].'" name="deleteRoom" type="submit" id="deleteRoom">Zmazať</button>';
					echo "</td>";
				echo "</tr>";
				}
			?>
	</table>
</form>
<?php 
	}else{
		if(isset($_GET['changeRoom'])){
			if(isset($_POST['handleRooms'])){
				$mysql = new Connection();
				$change_room_bool = $mysql->changeRoom($_GET['changeRoom'], $_POST['name_room'], $_POST['type_room'], $_POST['capacity_room']);
				if($change_room_bool){
					echo "Miestnosť úspešne zmenená!";
				}else{
					echo "Nepodarilo sa zmeniť miestnosť!";
				}
			}else {
				include 'updateRoom.php';
			}
		}
		if(isset($_GET['deleteRoom'])){
			$mysql = new Connection();
			$result = $mysql->deleteRoom($_GET['deleteRoom']);
			if($result){
				echo "Miestnosť úspešne vymazaná.";
			}else{
				echo "Chyba pri vymazávaní miestnosti!";
			}
		}
	}
?>