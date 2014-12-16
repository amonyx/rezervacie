<script language="javascript" type="text/javascript">  
	function ChangeValue(currentID)
	{		
		document.getElementById('ChangeAdmin').value = currentID;
		
		var pop = confirm('Zmenit administratorske prava pouzivatelovi: "' + currentID + '"?');
		if (pop == true) {								
			document.getElementById('confirmID').value = true;				
		} else {				
			document.getElementById('confirmID').value = false;				
		}		
	}
</script>
<table>
	<tr>
		<td colspan="2">
			<span style="color:red;"><?=$data['message']?></span>
			<span style="color:green;"><?=$data['message2']?></span>
		</td>
	</tr>	
</table>
<form method="post" action="">
	<table>	
		<input id="confirmID" type="hidden" name="confirmID" value=""/>
		<input id="ChangeAdmin" type="hidden" name="ChangeAdmin" value="submit" />	
		<?php
			$mysql = new Connection();
			$result = $mysql->getUsers();		
			$arr_length = count($result);
			for($i=0; $i < $arr_length; $i++){
				if($this->user->login != $result[$i]['Login'])
				{
					echo '<tr>';
					echo '<td>';
					echo '<label>' . $result[$i]['Login'] . ': </label>';
					echo '</td>';
					echo '<td>';
					echo '<input id="' . $result[$i]['Login'] . '" name="' . $result[$i]['Login'] . '"  type="checkbox" onchange="ChangeValue(this.id);this.form.submit();" ';
					if($result[$i]['Admin'] == 1)
					{
						echo ' value=1 checked>'; 
					}
					else
					{
						echo ' value=0 >';	
					}
					echo '</td>';				
				}
			}
		?>	
		<span id="php_code"> </span>	
	</table>	
</form>