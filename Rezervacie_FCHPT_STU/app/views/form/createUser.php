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
				<input name="meno" type="text" value="<?php if (isset($_POST["meno"])) echo $_POST["meno"]; ?>">
				<?php if (isset($_POST["meno"]) && $_POST["meno"] == "") echo "<font color='red'>*povinny udaj</font>"; ?>
			</td>
		</tr>
		<tr>
			<td>
				<label for="priezvisko">Priezvisko:</label>
			</td>
			<td>
				<input name="priezvisko" type="text"  value="<?php if (isset($_POST["priezvisko"])) echo $_POST["priezvisko"]; ?>">
				<?php if (isset($_POST["priezvisko"]) && $_POST["priezvisko"] == "") echo "<font color='red'>*povinny udaj</font>"; ?>
			</td>
		</tr>
		<tr>
			<td>
				<label for="login">Login(Prihlasovaci nick):</label>
			</td>
			<td>
				<input name="login" type="text"  value="<?php if (isset($_POST["login"])) echo $_POST["login"]; ?>">
				<?php if (isset($_POST["login"]) && $_POST["login"] == "") echo "<font color='red'>*povinny udaj</font>"; ?>
			</td>
		</tr>
		<tr>
			<td>
				<label for="heslo">Heslo:</label>
			</td>
			<td>
				<input name="heslo" type="password"  value="<?php if (isset($_POST["heslo"])) echo $_POST["heslo"]; ?>">
				<?php if (isset($_POST["heslo"]) && $_POST["heslo"] == "") echo "<font color='red'>*povinny udaj</font>"; ?>
			</td>
		</tr>
		<tr>
			<td>
				<label for="admin">Admin:</label>
			</td>
			<td>
				<input name="admin" type="checkbox"/>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input name="createUser" type="submit" value="Vytvorenie Usera"/>
			</td>
		</tr>
	</table>
</form>