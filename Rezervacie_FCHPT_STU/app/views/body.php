<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?=$title?></title>
	<link href="http://<?=DOMAIN?>/<?=URL_BASE?>/css/range.css" rel="stylesheet" type="text/css">
	<link href="http://<?=DOMAIN?>/<?=URL_BASE?>/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" type="text/css" href="http://<?=DOMAIN?>/<?=URL_BASE?>/css/bootstrap.min.css">
	<script src="http://<?=DOMAIN?>/<?=URL_BASE?>/js/dhtmlxscheduler.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href="http://<?=DOMAIN?>/<?=URL_BASE?>/css/dhtmlxscheduler.css" type="text/css" media="screen" title="no title" charset="utf-8">
	<link rel="stylesheet" type="text/css" href="http://<?=DOMAIN?>/<?=URL_BASE?>/css/datepicker.css">
	<script src="http://<?=DOMAIN?>/<?=URL_BASE?>/js/dhtmlxscheduler_limit.js" type="text/javascript" charset="utf-8"></script>	
	<script src="http://<?=DOMAIN?>/<?=URL_BASE?>/js/dhtmlxscheduler_minical.js" type="text/javascript" charset="utf-8"></script>	
	<script src="http://<?=DOMAIN?>/<?=URL_BASE?>/js/locale/locale_sk.js" type="text/javascript" charset="utf-8"></script>
</head>

<body class="container-fluid" onload="init();">
	<div style="visibility:hidden;" class="row">
	<div class="col-md-12">
	<a href="#">a</a>
	</div>
	</div>
	<nav>
	<ul class="nav nav-tabs">
	
	<?php
		if($this->user == null){
			echo '<div class="col-md-6 zero-padding"><li class="text-center"><a href="http://'.DOMAIN.'/'.URL_BASE.'/Vyhladavanie">Vyhľadávanie</a></li></div>	';
			echo '<div class="col-md-6 zero-padding"><li class="text-center login"><a href="http://'.DOMAIN.'/'.URL_BASE.'/Ucitel/prihlasenie">Prihlásiť</a></li></div>';
		} else {
			echo '<div class="col-md-2"><li class="text-center"><a href="http://'.DOMAIN.'/'.URL_BASE.'/Vyhladavanie">Vyhľadávanie</a></li></div>	';
			echo '<div class="col-md-2"><li class="text-center"><a href="http://'.DOMAIN.'/'.URL_BASE.'/Ucitel/kalendar">Kalendár</a></li></div>';
			echo '<div class="col-md-2"><li class="text-center"><a href="http://'.DOMAIN.'/'.URL_BASE.'/Ucitel/rezervacia">Nová rezervácia</a></li></div>';
			echo '<div class="col-md-2"><li class="text-center"><a href="http://'.DOMAIN.'/'.URL_BASE.'/Ucitel/zmenaHesla">Zmena hesla</a></li></div>';
			if($this->user->admin){
				echo '<div class="col-md-2"><li class="text-center"><a href="http://'.DOMAIN.'/'.URL_BASE.'/Admin">Administrácia</a></li></div>';
			}
			echo '<div class="col-md-2"><li class="text-center login"><a href="http://'.DOMAIN.'/'.URL_BASE.'/Ucitel/odhlasenie">Odhlásiť</a></li></div>';
		}		
	?>
	</ul>
	</nav>	
	<?php require_once '/app/views/'.$view.'.php'; ?>
	<footer>
	</footer>
	<!-- Placed at the end of the document so the pages load faster -->
	<script type='text/javascript' src='http://<?=DOMAIN?>/<?=URL_BASE?>/js/jquery.min.js'></script>
    <script type='text/javascript' src="http://<?=DOMAIN?>/<?=URL_BASE?>/js/bootstrap.min.js"></script>
	<script type='text/javascript' src='http://<?=DOMAIN?>/<?=URL_BASE?>/js/bootstrap-datepicker.js'></script>
</body>
</html>