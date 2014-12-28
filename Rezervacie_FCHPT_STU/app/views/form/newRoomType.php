<form method="post">
	<p>Pridanie Typu Miestnosti:</p>
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
				<input id="name_room_type" name="name_room_type" type="text" value="<?php if (isset($_POST["name_room_type"])) echo $_POST["name_room_type"]; ?>"/>
				<?php if (isset($_POST["name_room_type"]) && $_POST["name_room_type"] == "") echo "<font color='red'>*povinny udaj</font>"; ?>
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<input name="createRoomType" type="submit" value="Pridať typ miestnosti"/>
			</td>
		</tr>
	</table>
</form>