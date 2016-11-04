<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>

<div class="corpo" id="mostrarTime">
<?php 
 	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/time_controller.php';
	$timeCtr = new TimeController();
	$time = $timeCtr->mostrar();
	$cidade = $timeCtr->pegarCidade()->nome;
	$estadio = $timeCtr->pegarEstadio()->nome;
	
	
	if(isset($_GET['novo'])){
		echo "<h3>$time->nome cadastrado com sucesso!</h3>";
	}elseif(isset($_GET['edicao'])){
		echo "<h3>$time->nome atualizado com sucesso!</h3>";	
	}elseif($time){
		echo "<h3>Dados do time $time->nome</h3>";
	}
	
	if($time){
		
		echo "
		<p>Nome : $time->nome</p> 
		<p>Sigla : $time->sigla</p> 
		<p>Cor : $time->cor</p>
		<p>Patrimônio : $time->patrimonio</p>
		<p>Ano : $time->ano</p>
		<p>Cidade : $cidade</p>
		<p>Estádio : $estadio</p>
				
		<div class='acao'>
			  <form action='editar.php' method='get' accept-charset='utf-8' style='display: inline;'>
			    <input type='hidden' name='num' value='$time->id'/>
			    <input type='submit' value='Editar' />
			 </form>
			  <form action='apagar.php' method='post' accept-charset='utf-8' style='display: inline;'>
			    <input type='hidden' name='num' value='$time->id'/>
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
