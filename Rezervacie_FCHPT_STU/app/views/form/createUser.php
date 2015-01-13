<?php 
	require_once 'administracia.php';
?>
<hr>
<h3 class="text-center">Vytvorenie nového používateľa</h3>
<hr>
<form class="form-horizontal" method="post" role="form">
				<div class="row text-center"><span style="color:red;"><?=$data['message']?></span></div>
				
				
				<div class="col-md-4"></div>
				<div class="col-md-4">
				<div class="form-group">
				<label class="control-label" for="meno">Meno:</label>
				<input class="form-control" name="meno" type="text" value="<?php if (isset($_POST["meno"])) echo $_POST["meno"]; ?>" id="meno">
				<?php if (isset($_POST["meno"]) && $_POST["meno"] == "") echo "<font color='red'>*povinný údaj</font>"; ?>
				</div>
				
				<div class="form-group">
				<label class="control-label" for="priezvisko">Priezvisko:</label>
				<input class="form-control" name="priezvisko" type="text"  value="<?php if (isset($_POST["priezvisko"])) echo $_POST["priezvisko"]; ?>" id="priezvisko">
				<?php if (isset($_POST["priezvisko"]) && $_POST["priezvisko"] == "") echo "<font color='red'>*povinný údaj</font>"; ?>
				</div>
				
				<div class="form-group">
				<label class="control-label" for="login">Login(Prihlasovaci nick):</label>
				<input class="form-control" name="login" type="text"  value="<?php if (isset($_POST["login"])) echo $_POST["login"]; ?>" id="login">
				<?php if (isset($_POST["login"]))
					{
						if($_POST["login"] == "")
						{
							echo "<font color='red'>*povinný údaj</font>";
						}
					}								
				?>
				</div>
				
				<div class="form-group">
				<label class="control-label" for="genH">Generovat heslo:</label>
				<div class="row">
				<div class="col-md-5"></div>
				<div class="col-md-2">
				<input class="form-control" id="genH" name="genHeslo" type="checkbox" onchange="Check();" <?php if(isset($_POST["genHeslo"])) echo "checked"; ?>>
				</div>
				<div class="col-md-5"></div>
				</div>
				</div>
				
				<div class="form-group" id="gen">
				<label class="control-label" for="heslo">Heslo:</label>
				<input class="form-control" name="heslo" type="password" id="heslo" value="<?php if (isset($_POST["heslo"])) echo $_POST["heslo"]; ?>">				
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
				
				<div class="form-group" id="gen2">
				<label class="control-label" for="heslo2">Opakuj heslo:</label>
				<input class="form-control" name="heslo2" type="password" id="heslo2" value="<?php if (isset($_POST["heslo2"])) echo $_POST["heslo2"]; ?>">
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
						<label class="control-label" for="admin">Admin:</label>
						<div class="row">
				<div class="col-md-5"></div>
				<div class="col-md-2">
						<input class="form-control" name="admin" type="checkbox" id="admin" <?php if (isset($_POST["admin"])) echo "checked"; ?>>
				</div>
				<div class="col-md-5"></div>
				</div>
				</div>
				
				<div class="form-group">
						<input class="form-control input-lg btn-success" name="createUser" type="submit" value="Vytvoriť používateľa" onclick="Check()"/>
				</div>
				</div>
				<div class="col-md-4"></div>
</form>

<script language="javascript" type="text/javascript">   
	window.onload = function() {
		Check();
	};
	function Check(){		
		var checkBoxGenHeslo = document.getElementById("genH");
		if(checkBoxGenHeslo.checked)
		{		
			document.getElementById("gen").style.display = "none";
			document.getElementById("gen2").style.display = "none";
		}
		else
		{		
			document.getElementById("gen").style.display = "block";
			document.getElementById("gen2").style.display = "block";
		}
	};	
</script>