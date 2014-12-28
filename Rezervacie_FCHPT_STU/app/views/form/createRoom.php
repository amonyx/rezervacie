<form method="post">
	<p>Pridanie Miestnosti:</p>
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
				<input id="name_room" name="name_room" type="text" value="<?php if (isset($_POST["name_room"])) echo $_POST["name_room"]; ?>"/>
				<?php if (isset($_POST["name_room"]) && $_POST["name_room"] == "") echo "<font color='red'>*povinny udaj</font>"; ?>
			</td>
		</tr>
		<tr>
			<td>
				<label for="capacity_room">Kapacita:</label>
			</td>
			<td>
				<input id="capacity_room" name="capacity_room" type="text" value="<?php if (isset($_POST["capacity_room"])) echo $_POST["capacity_room"]; ?>"/>
				<?php if (isset($_POST["capacity_room"]) && $_POST["capacity_room"] == "") echo "<font color='red'>*povinny udaj</font>"; ?>
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
						echo '<option value='.$results[$i]['ID'].'>'.$results[$i]['Nazov'].'</option>';
					}
					echo "</select>";
			?>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<input name="createRoom" type="submit" value="Pridanie Miestnosti"/>
			</td>
		</tr>
	</table>
</form>