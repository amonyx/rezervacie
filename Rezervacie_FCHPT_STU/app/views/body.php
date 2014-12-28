<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?=$title?></title>
	<link rel="stylesheet" type="text/css" href="http://<?=DOMAIN?>/<?=URL_BASE?>/css/bootstrap.css">
</head>
<body>
	<header>
		<?php 
			if($this->user == null){
				?>
				<a href="http://<?=DOMAIN?>/<?=URL_BASE?>/Ucitel/prihlasenie">Prihlásiť</a>
				<?php 
			}
			else{
				?>
				<a href="http://<?=DOMAIN?>/<?=URL_BASE?>/Ucitel/odhlasenie">Odhlásiť</a>
				<?php 
			}
		?>
	</header>
	<nav>
		<ul>
			<li><a href="http://<?=DOMAIN?>/<?=URL_BASE?>/Vyhladavanie">Vyhľadávanie</a></li>
		<?php 
			if($this->user != null){
				echo '<li><a href="http://'.DOMAIN.'/'.URL_BASE.'/Ucitel/kalendar">Kalendár</a></li>';
				echo '<li><a href="http://'.DOMAIN.'/'.URL_BASE.'/Ucitel/rezervacia">Nová rezervácia</a></li>';
				echo '<li><a href="http://'.DOMAIN.'/'.URL_BASE.'/Ucitel/zmenaHesla">Zmena Hesla</a></li>';
				if($this->user->admin){
					echo '<li><a href="http://'.DOMAIN.'/'.URL_BASE.'/Admin">Administrácia</a></li>';										
				}
			}
		?>
		</ul>
	</nav>
	<section>
		<?php require_once '/app/views/'.$view.'.php'; ?>
	</section>
	<footer>
	</footer>
</body>
</html>