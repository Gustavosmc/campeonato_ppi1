<?php 
    $view = '/campeonato/app/view/';
	$rootArbitro = $view.'arbitro/index.php';
	$rootTime = $view.'time/index.php';
	$rootJogo = $view.'jogo/index.php';
	$rootEstadio = $view.'estadio/index.php';
	$rootProfissional = $view.'profissional/index.php';
	
 ?>
<html>
	<head>
		<link rel="stylesheet" href="../assets/css/campeonato.css" type="text/css">
		<link rel="stylesheet" href="../assets/css/font/flaticon.css" type="text/css" >
	    <meta charset="UTF-8">
	
		
	</head>
	<body id="principal" onload="">
		<div id="header">
			<ul class="nav"> 
				<li><a href='<?php echo "$rootArbitro" ?>'>Árbitros</a></li>
				<li><a href='<?php echo "$rootEstadio" ?>'>Estádios</a></li>
				<li><a href='<?php echo "$rootProfissional" ?>'>Profissionais</a></li>
				<li><a href='<?php echo "$rootTime" ?>'>Times</a> </li>
				<li><a href='<?php echo "$rootJogo" ?>'>Jogos</a></li>
				<li><a href='<?php echo "$rootJogo" ?>'>Tabela</a></li>

 			</ul>
	  	</div>
	

