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
			document.getElementById("gen").style.display = "";
			document.getElementById("gen2").style.display = "";
		}
	};	
</script>

<form method="post">
	<table>
		<tr>
			<td colspan="2">
				<span style="color:red;"><?=$data['message']?></span>
			</td>
		</tr>
		<tr>
			<td>
				<label for="meno">Meno:</label>
			</td>
			<td>
				<input name="meno" type="text" value="<?php if (isset($_POST["meno"])) echo $_POST["meno"]; ?>" id="meno">
				<?php if (isset($_POST["meno"]) && $_POST["meno"] == "") echo "<font color='red'>*povinny udaj</font>"; ?>
			</td>
		</tr>
		<tr>
			<td>
				<label for="priezvisko">Priezvisko:</label>
			</td>
			<td>
				<input name="priezvisko" type="text"  value="<?php if (isset($_POST["priezvisko"])) echo $_POST["priezvisko"]; ?>" id="priezvisko">
				<?php if (isset($_POST["priezvisko"]) && $_POST["priezvisko"] == "") echo "<font color='red'>*povinny udaj</font>"; ?>
			</td>
		</tr>
		<tr>
			<td>
				<label for="login">Login(Prihlasovaci nick):</label>
			</td>
			<td>
				<input name="login" type="text"  value="<?php if (isset($_POST["login"])) echo $_POST["login"]; ?>" id="login">
				<?php if (isset($_POST["login"]))
					{
						if($_POST["login"] == "")
						{
							echo "<font color='red'>*povinny udaj</font>";
						}
					}								
				?>
			</td>
		</tr>
		<tr>
			<td>
				<label for="genH">Generovat heslo:</label>
			</td>
			<td>
				<input id="genH" name="genHeslo" type="checkbox" onchange="Check();" <?php if(isset($_POST["genHeslo"])) echo "checked"; ?>>
			</td>
		</tr>
		<tr id="gen">
			<td>
				<label for="heslo">Heslo:</label>
			</td>
			<td>
				<input name="heslo" type="password" id="heslo" value="<?php if (isset($_POST["heslo"])) echo $_POST["heslo"]; ?>">				
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
			</td>
		</tr>
		<tr id="gen2">
			<td>
				<label for="heslo2">Opakuj heslo:</label>
			</td>
			<td>
				<input name="heslo2" type="password" id="heslo2" value="<?php if (isset($_POST["heslo2"])) echo $_POST["heslo2"]; ?>">
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
			</td>
		</tr>
		<tr>
			<td>
				<label for="admin">Admin:</label>
			</td>
			<td>
				<input name="admin" type="checkbox" id="admin" <?php if (isset($_POST["admin"])) echo "checked"; ?>>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input name="createUser" type="submit" value="Vytvorenie Usera" onclick="Check()"/>
			</td>
		</tr>
	</table>
</form>