<?php 
	if(!(isset($_GET['changeRoomType'])) && (!(isset($_GET['deleteRoomType'])))){
?>

<form action="" method="GET">
	<table>
		<tr>
			<td>
				<label for="name_room_type">Názov:</label>
			</td>
		</tr>
			<?php	

				$mysql = new Connection();
				$results = $mysql->getRoomTypes();

				$arr_length = count($results);
	
				for($i = 0; $i < $arr_length; $i++){
				echo "<tr>";
					echo "<td>";
					echo $results[$i]['Nazov'];
					echo "</td>";
					echo "<td>";
					echo '<button value="'.$results[$i]["ID"].'" name="changeRoomType" type="submit" id="changeRoomType">Zmeniť</button>';
					echo "</td>";
					echo "<td>";
					echo '<button value="'.$results[$i]["ID"].'" name="deleteRoomType" type="submit" id="deleteRoomType">Zmazať</button>';
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