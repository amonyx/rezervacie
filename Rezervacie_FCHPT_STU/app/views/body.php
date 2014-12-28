<!DOCTYPE html>
<html>
<head>
	<title><?=$title?></title>
	<link rel="stylesheet" type="text/css" href="http://<?='DOMAIN'?>/<?='URL_BASE'?>/css/bootstrap.css">
</head>
<body>
	<header>
		<?php 
			if($this->user == null){
				?>
				<a href="http://<?=DOMAIN?>/<?=URL_BASE?>/Ucitel/prihlasenie">Prihl·siù</a>
				<?php 
			}
			else{
				?>
				<a href="http://<?=DOMAIN?>/<?=URL_BASE?>/Ucitel/odhlasenie">Odhl·siù</a>
				<?php 
			}
		?>
	</header>
	<nav>
		<ul>
			<li><a href="http://<?=DOMAIN?>/<?=URL_BASE?>/Vyhladavanie">Vyhæad·vanie</a></li>
		<?php 
			if($this->user != null){
				echo '<li><a href="http://'.DOMAIN.'/'.URL_BASE.'/Ucitel/kalendar">Kalend·r</a></li>';
				echo '<li><a href="http://'.DOMAIN.'/'.URL_BASE.'/Ucitel/rezervacia">Nov· rezerv·cia</a></li>';
				if($this->user->admin){
					echo '<li><a href="http://'.DOMAIN.'/'.URL_BASE.'/Admin">Administr·cia</a></li>';
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