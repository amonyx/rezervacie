<?php 
	if(isset($_GET['changeRoom'])){
		$mysql = new Connection();
		$room = $mysql->getRoomByID($_GET['changeRoom']);
		if($room == null){
			echo '<span style="color:red;">Miestnosť neexistuje!</span>';
			exit();
		}
	}
	
	require_once 'administracia.php';
?>

<hr>
<h3 class="text-center">Upraviť miestnosť</h3>
<hr>
<form method="post" role="form" class="form-horizontal">
				<span style="color:red;"><?=$data['message']?></span>
				
				<div class="col-md-4"></div>
				<div class="col-md-4">
				<div class="form-group">
				<label class="control-label" for="name_room">Názov:</label>
				<input class="form-control" id="name_room" name="name_room" type="text" value="<?php 
				if(isset($_GET['changeRoom'])){
					echo $room['Nazov'];
				}else if(isset($_POST["name_room"])){ 
					echo $_POST["name_room"];
				}
				?>"/>				
				<?php if ((isset($_GET['changeRoom']) && $room['Nazov'] == "")) echo "<font color='red'>*povinny udaj</font>"; ?>
				</div>
				
				<div class="form-group">
				<label class="control-label" for="capacity_room">Kapacita:</label>
				<input class="form-control" id="capacity_room" name="capacity_room" type="text" value="<?php 
				if(isset($_GET['changeRoom'])){
					echo $room['Kapacita'];
				}else if(isset($_POST["capacity_room"])){ 
					echo $_POST["capacity_room"];
				}
				?>"/>
				<?php if ((isset($_GET['changeRoom']) && $room['Kapacita'] == "")) echo "<font color='red'>*povinny udaj</font>"; ?>
				</div>
				
				<div class="form-group">
				<label class="control-label" for="type_room">Typ:</label>
			<?php 
					$mysql = new Connection();
					$results = $mysql->getRoomTypes();
					
					$arr_length = count($results);
					echo "<select class='form-control' name='type_room'>";
					for($i = 0; $i < $arr_length; $i++){
						if($results[$i]['ID'] == $room['ID_Typ_Miestnosti']){
							echo '<option value='.$results[$i]['ID'].' selected="selected">'.$results[$i]['Nazov'].'</option>';
						} else{
							echo '<option value='.$results[$i]['ID'].'>'.$results[$i]['Nazov'].'</option>';
						}
					}
					echo "</select>";
			?>
			</div>
			<div class="form-group">
				<input class="form-control input-lg btn-success" name="handleRooms" type="submit" value="Upraviť miestnosť">
			</div>
			</div>
			<div class="col-md-4"></div>
</form>