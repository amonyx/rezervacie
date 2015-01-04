<hr>
<h3 class="text-center">Prihlásenie</h3>
<hr>
<form method="post" role="form" class="form-horizontal">
				<div class="form-group text-center">
				<span style="color:red;"><?=$data['message']?></span>
				</div>
				<div class="col-md-4"></div>
				<div class="col-md-4">
				<div class="form-group">
				<label class="control-label" for="login">Uživateľské meno:</label>
				<input class="form-control" name="login" type="text"/>
				</div>
	
				<div class="form-group">
				<label class="control-label" for="heslo">Heslo:</label>
				<input class="form-control" name="heslo" type="password"/>
				</div>
				
				<div class="form-group">
				<input class="form-control input-lg btn-success" name="prihlasenie" type="submit" value="Prihlásiť"/>
				</div>
				</div>
				<div class="col-md-4"></div>
</form>