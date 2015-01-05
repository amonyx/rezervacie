<hr>
<h3 class="text-center">Zmena hesla</h3>
<hr>
<form method="post" role="form" class="form-horizontal">
				<span style="color:red;"><?=$data['message']?></span>
				<span style="color:green;"><?=$data['message2']?></span>
				<div class="col-md-4"></div>
				<div class="col-md-4">
				<div class="form-group">
				<label class="control-label" for="stareheslo">Staré Heslo:</label>
				<input class="form-control" name="stareheslo" id="stareheslo" type="password"  value="<?php if (isset($_POST["stareheslo"])) echo $_POST["stareheslo"]; ?>">				
				<?php if(isset($_POST["stareheslo"])){
						if($_POST["stareheslo"] == "")
						{
							echo "<font color='red'>*povinny udaj</font>";					
						}						
					}					
				?>
				</div>
				<div class="form-group">
				<label class="control-label" for="heslo">Heslo:</label>
				<input class="form-control" name="heslo" id="heslo" type="password"  value="<?php if (isset($_POST["heslo"])) echo $_POST["heslo"]; ?>">				
				<?php if(isset($_POST["heslo"])){
						if($_POST["heslo"] == "")
						{
							echo "<font color='red'>*povinny udaj</font>";					
						}
						elseif(strlen($_POST["heslo"]) < 6)  
						{
							echo "<font color='red'>*aspon 6 znakov</font>";
						}
					}					
				?>
				</div>
				<div class="form-group">
				<label class="control-label" for="heslo2">Opakuj heslo:</label>
				<input class="form-control" name="heslo2" id="heslo2" type="password"  value="<?php if (isset($_POST["heslo2"])) echo $_POST["heslo2"]; ?>">
				<?php if (isset($_POST["heslo2"])){
						if($_POST["heslo2"] == "")
						{
							echo "<font color='red'>*povinny udaj</font>";
						}
						elseif($_POST['heslo'] != $_POST['heslo2'])
						{				
							echo "<font color='red'>*nezhoduju sa hesla</font>";
							$_POST['heslo'] = "";
							$_POST['heslo2'] = "";
						}
					}
				?>
				</div>
				 <div class="form-group">
				<input class="form-control input-lg btn-success" name="changePassword" type="submit" value="Zmena Hesla"/>
				</div>
				</div>
				<div class="col-md-4"></div>
</form>