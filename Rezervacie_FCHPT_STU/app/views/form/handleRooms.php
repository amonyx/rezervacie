<?php 
	if(!(isset($_GET['changeRoom'])) && (!(isset($_GET['deleteRoom'])))){
?>

<form action="" method="GET">
	<p>Správa Miestnosti:</p>
	<table>
		<?php 
			$mysql = new Connection();
			//$test = $mysql->TEST_MIESTNOSTI_VYTVOR(100);
			$results = $mysql->getAllRooms();

			$arr_length = count($results);
		?>
		<tr>
			<td>
				<label for="name_room">Názov:</label>
			</td>
			<td>
				<label for="capacity_room">Kapacita:</label>
			</td>
			<td>
				<label for="type_room">Typ:</label>
			</td>
		</tr>
			<?php	
				for($i = 0; $i < $arr_length; $i++){
				echo "<tr>";
					echo "<td>";
					echo $results[$i]['Nazov'];
					echo "</td>";
					
					echo "<td>";
					echo $results[$i]['Kapacita'];
					echo "</td>";
					
					echo "<td>";
					$res = $mysql->getRoomTypeByID($results[$i]['ID_Typ_Miestnosti']);
					echo $res['Nazov'];
					echo "</td>";
					
					echo "<td>";
					echo '<button value="'.$results[$i]["ID"].'" name="changeRoom" type="submit" id="changeRoom">Zmeniť</button>';
					echo "</td>";
					echo "<td>";
					echo '<button value="'.$results[$i]["ID"].'" name="deleteRoom" type="submit" id="deleteRoom">Zmazať</button>';
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