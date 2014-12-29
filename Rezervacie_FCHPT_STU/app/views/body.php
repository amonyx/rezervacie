<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?=$title?></title>
	<link rel="stylesheet" type="text/css" href="http://<?=DOMAIN?>/<?=URL_BASE?>/css/bootstrap.css">
	<script src="http://<?=DOMAIN?>/<?=URL_BASE?>/js/dhtmlxscheduler.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href="http://<?=DOMAIN?>/<?=URL_BASE?>/css/dhtmlxscheduler.css" type="text/css" media="screen" title="no title" charset="utf-8">
	
	<script src="http://<?=DOMAIN?>/<?=URL_BASE?>/js/dhtmlxscheduler_limit.js" type="text/javascript" charset="utf-8"></script>	
	<script src="http://<?=DOMAIN?>/<?=URL_BASE?>/js/dhtmlxscheduler_minical.js" type="text/javascript" charset="utf-8"></script>	
	<script src="http://<?=DOMAIN?>/<?=URL_BASE?>/js/locale/locale_sk.js" type="text/javascript" charset="utf-8"></script>
</head>

<body onload="init();">
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
		<li>
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
		</li>
		</ul>
	</nav>	
	<?php require_once '/app/views/'.$view.'.php'; ?>
	<footer>
	</footer>
</body>
</html>