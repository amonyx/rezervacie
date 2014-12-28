<?php 
	if(isset($_GET['changeRoomType'])){
		$mysql = new Connection();
		$room = $mysql->getRoomTypeByID($_GET['changeRoomType']);
		if($room == null){
			echo '<span style="color:red;">Typ miestnosti neexistuje!</span>';
			exit();
		}
	}
?>

<form method="post">
	<p>Úprava Typov Miestností:</p>
	<table>
		<tr>
			<td colspan="3">
				<span style="color:red;"><?=$data['message']?></span>
			</td>
		</tr>
		<tr>
			<td>
				<label for="name_room_type">Názov:</label>
			</td>
			<td>
				<input id="name_room_type" name="name_room_type" type="text" value="<?php 
				if(isset($_GET['changeRoomType'])){
					echo $room['Nazov'];
				}else if(isset($_POST["name_room_type"])){ 
					echo $_POST["name_room_type"];
				}
				?>"/>
				<?php if ((isset($_GET['changeRoomType']) && $room['Nazov'] == "")) echo "<font color='red'>*povinny udaj</font>"; ?>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<input name="handleRoomTypes" type="submit" value="Zmeniť Typ Miestnosti">
			</td>
		</tr>
	</table>
</form>