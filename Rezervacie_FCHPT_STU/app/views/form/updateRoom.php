<?php 
	if(isset($_GET['changeRoom'])){
		$mysql = new Connection();
		$room = $mysql->getRoomByID($_GET['changeRoom']);
		if($room == null){
			echo '<span style="color:red;">Miestnosť neexistuje!</span>';
			exit();
		}
	}
?>

<form method="post">
	<p>Úprava Miestnosti:</p>
	<table>
		<tr>
			<td colspan="3">
				<span style="color:red;"><?=$data['message']?></span>
			</td>
		</tr>
		<tr>
			<td>
				<label for="name_room">Názov:</label>
			</td>
			<td>
				<input id="name_room" name="name_room" type="text" value="<?php 
				if(isset($_GET['changeRoom'])){
					echo $room['Nazov'];
				}else if(isset($_POST["name_room"])){ 
					echo $_POST["name_room"];
				}
				?>"/>
				<?php if ((isset($_GET['changeRoom']) && $room['Nazov'] == "")) echo "<font color='red'>*povinny udaj</font>"; ?>
			</td>
		</tr>
		<tr>
			<td>
				<label for="capacity_room">Kapacita:</label>
			</td>
			<td>
				<input id="capacity_room" name="capacity_room" type="text" value="<?php 
				if(isset($_GET['changeRoom'])){
					echo $room['Kapacita'];
				}else if(isset($_POST["capacity_room"])){ 
					echo $_POST["capacity_room"];
				}
				?>"/>
				<?php if ((isset($_GET['changeRoom']) && $room['Kapacita'] == "")) echo "<font color='red'>*povinny udaj</font>"; ?>
			</td>
		</tr>
		<tr>
			<td>
			<?php 
					$mysql = new Connection();
					$results = $mysql->getRoomTypes();
					
					$arr_length = count($results);
					echo "<select name='type_room'>";
					for($i = 0; $i < $arr_length; $i++){
						if($results[$i]['ID'] == $room['ID_Typ_Miestnosti']){
							echo '<option value='.$results[$i]['ID'].' selected="selected">'.$results[$i]['Nazov'].'</option>';
						} else{
							echo '<option value='.$results[$i]['ID'].'>'.$results[$i]['Nazov'].'</option>';
						}
					}
					echo "</select>";
			?>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<input name="handleRooms" type="submit" value="Zmeniť Miestnosť">
			</td>
		</tr>
	</table>
</form>