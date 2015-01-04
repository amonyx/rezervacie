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

<?php 
	require_once 'administracia.php';
?>

<hr>
<h3 class="text-center">Zmena administrátorských práv</h3>
<hr>
<table>
	<tr>
		<td colspan="2">
			<span style="color:red;"><?=$data['message']?></span>
			<span style="color:green;"><?=$data['message2']?></span>
		</td>
	</tr>	
</table>
<form method="post" action="" role="form" class="form-horizontal">
		
		<input class="form-control" id="confirmID" type="hidden" name="confirmID" value=""/>
		<input class="form-control" id="ChangeAdmin" type="hidden" name="ChangeAdmin" value="submit" />	
		<table class="table table-striped table-bordered table-hover">
		<thead>
		<tr>
		<th class="text-center"><h3>Prihlasovacie meno</h3></th>
		<th class="text-center"><h3>Má/Nemá administrátorské práva</h3></th>
		</tr>
		</thead>
		<div class="form-group">
		<?php
			$mysql = new Connection();
			$result = $mysql->getUsers();		
			$arr_length = count($result);
			for($i=0; $i < $arr_length; $i++){
				if($this->user->login != $result[$i]['Login'])
				{
					echo '<tr>';
					echo '<td class="text-center"><big><label class="control-label" for="' . $result[$i]['Login'] . '"> ' . $result[$i]['Login'].':</label></big></td>';
					echo '<td class="text-center">';
					echo '<div class="row">';
					echo '<div class="col-md-5"></div>';
					echo '<div class="col-md-1">';
					echo '<input class="form-control" id="' . $result[$i]['Login'] . '" name="' . $result[$i]['Login'] . '"  type="checkbox" onchange="ChangeValue(this.id);this.form.submit();" ';
					if($result[$i]['Admin'] == 1)
					{
						echo ' value=1 checked></td>'; 
					}
					else
					{
						echo ' value=0 ></td>';	
					}
					echo '</div>';
					echo '<div class="col-md-6"></div>';
					echo '</div>';
					echo '</tr>';
				}
			}
		?>	
		<span id="php_code"> </span>	
		</div>
		</table>
</form>