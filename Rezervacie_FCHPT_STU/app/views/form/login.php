<form method="post">
	<table>
		<tr>
			<td colspan="2">
				<span style="color:red;"><?=$data['message']?></span>
			</td>
		</tr>
		<tr>
			<td>
				<label for="login">U�iva�e�sk� meno:</label>
			</td>
			<td>
				<input name="login" type="text"/>
			</td>
		</tr>
		<tr>
			<td>
				<label for="heslo">Heslo:</label>
			</td>
			<td>
				<input name="heslo" type="password"/>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input name="prihlasenie" type="submit" value="Prihl�si�"/>
			</td>
		</tr>
	</table>
</form>