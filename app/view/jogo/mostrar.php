<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>

<div class="corpo" id="mostrarJogo">
<?php 
 	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/jogo_controller.php';
	$jogoCtr = new JogoController();
	$jogo = $jogoCtr->mostrar();
	$time1 = $jogoCtr->pegarTime1($jogo->fktime1)->nome;
	$time2 = $jogoCtr->pegarTime2($jogo->fktime2)->nome;
	$estadio = $jogoCtr->pegarEstadio($jogo->fkestadio)->nome;
	$arbitro = $jogoCtr->pegarArbitro($jogo->fkarbitro)->nome;
	
	if(isset($_GET['novo'])){
		echo "<h3>Jogo cadastrado com sucesso!</h3>";
	}elseif(isset($_GET['edicao'])){
		echo "<h3>Jogo atualizado com sucesso!</h3>";	
	}elseif($jogo){
		echo "<h3>Dados do jogo</h3>";
	}
	
	if($jogo){
		
		echo "
		<p>Time 1 : $time1</p> 
		<p>Gols : $jogo->gols_time1</p> 
		<p>Time 2 : $time2</p>
		<p>Gols : $jogo->gols_time2</p>
		<p>Estádio : $estadio</p>
		<p>Árbitro : $arbitro</p>
		
		<div class='acao'>
			  <form action='editar.php' method='get' accept-charset='utf-8' style='display: inline;'>
			    <input type='hidden' name='num' value='$jogo->id'/>
			    <input type='submit' value='Editar' />
			 </form>
			  <form action='apagar.php' method='post' accept-charset='utf-8' style='display: inline;'>
			    <input type='hidden' name='num' value='$jogo->id'/>
			    <input type='submit' value='Apagar' />
			 </form>
			  <form action='novo.php' method='get' accept-charset='utf-8' style='display: inline;'>
			    <input type='submit' value='Novo' />
			 </form>
		 </div>
 
		";
	}
 ?>

 </div>
 
<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/footer.php'; ?>
