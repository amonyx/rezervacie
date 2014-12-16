<form method="post">
	<table>		
		<tr>
			<td colspan="2">
				<span style="color:red;"><?=$data['message']?></span>
			</td>
		</tr>
		<tr>
			<td>
				<label for="heslo">Heslo:</label>
			</td>
			<td>
				<input name="heslo" type="password"  value="<?php if (isset($_POST["heslo"])) echo $_POST["heslo"]; ?>">				
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
		<tr>
			<td>
				<label for="heslo2">Opakuj heslo:</label>
			</td>
			<td>
				<input name="heslo2" type="password"  value="<?php if (isset($_POST["heslo2"])) echo $_POST["heslo2"]; ?>">
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
			<td colspan="2">
				<input name="changePassword" type="submit" value="Zmena Hesla"/>
			</td>
		</tr>
	</table>
</form>