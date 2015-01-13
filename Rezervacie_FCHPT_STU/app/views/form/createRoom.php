<?php 
	require_once 'administracia.php';
?>

<hr>
<h3 class="text-center">Vytvorenie novej miestnosti</h3>
<hr>

<form method="post" role="form" class="form-horizontal">
				<div class="row text-center"><span style="color:red;"><?=$data['message']?></span></div>
				<div class="col-md-4"></div>
				<div class="col-md-4">
				<div class="form-group">
				<label class="control-label" for="name_room">Názov:</label>
				<input class="form-control" id="name_room" name="name_room" type="text" value="<?php if (isset($_POST["name_room"])) echo $_POST["name_room"]; ?>"/>
				<?php if (isset($_POST["name_room"]) && $_POST["name_room"] == "") echo "<font color='red'>*povinny udaj</font>"; ?>
				</div>
				
				<div class="form-group">
				<label class="control-label" for="capacity_room">Kapacita:</label>
				<input class="form-control" id="capacity_room" name="capacity_room" type="text" value="<?php if (isset($_POST["capacity_room"])) echo $_POST["capacity_room"]; ?>"/>
				<?php if (isset($_POST["capacity_room"]) && $_POST["capacity_room"] == "") echo "<font color='red'>*povinny udaj</font>"; ?>
				</div>
				
				<div class="form-group">
			<?php 
					$mysql = new Connection();
					$results = $mysql->getRoomTypes();

					$isRoomUnique = $mysql ->getRoomIdByName(@$_POST["name_room"]);

					$arr_length = count($results);
					echo "<select class='form-control' name='type_room'>";
					for($i = 0; $i < $arr_length; $i++){
						echo '<option value='.$results[$i]['ID'].'>'.$results[$i]['Nazov'].'</option>';
					}
					echo "</select>";
			?>
			</div>
				<div class="form-group">
				<input class="input-lg btn-success form-control" name="createRoom" type="submit" value="Vytvoriť miestnosť"/>
				</div>
			</div>
			<div class="col-md-4"></div>
</form>