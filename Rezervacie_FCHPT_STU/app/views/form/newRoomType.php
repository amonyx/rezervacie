<?php 
	require_once 'administracia.php';
?>
<hr>
<h3 class="text-center">Vytvorenie nového typu miestnosti</h3>
<hr>
<form method="post" role="form" class="form-horizontal">
	<span style="color:red;"><?=$data['message']?></span>
	<div class="col-md-4"></div>
	<div class="col-md-4">
	<div class="form-group">
				<label class="control-label" for="name_room_type">Názov:</label>
				<input class="form-control" id="name_room_type" name="name_room_type" type="text" value="<?php if (isset($_POST["name_room_type"])) echo $_POST["name_room_type"]; ?>"/>
				<?php if (isset($_POST["name_room_type"]) && $_POST["name_room_type"] == "") echo "<font color='red'>*povinny udaj</font>"; ?>
	</div>
	<div class="form-group">
				<input class="form-control input-lg btn-success" name="createRoomType" type="submit" value="Vytvoriť typ miestnosti"/>
	</div>
	</div>
	<div class="col-md-4"></div>
	
</form>