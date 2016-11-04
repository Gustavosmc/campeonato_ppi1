<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>

<div class="corpo" id="mostrarProfissional">
<?php 
 	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/profissional_controller.php';
	$profissionalCtr = new ProfissionalController();
	$profissional = $profissionalCtr->mostrar();
	$time = $profissionalCtr->pegarTime($profissional->fktime)->nome;
	
	if(isset($_GET['novo'])){
		echo "<h3>$profissional->nome cadastrado com sucesso!</h3>";
	}elseif(isset($_GET['edicao'])){
		echo "<h3>$profissional->nome atualizado com sucesso!</h3>";	
	}elseif($profissional){
		echo "<h3>Dados do profissional $profissional->nome</h3>";
	}
	
	if($profissional){
		echo "
		<p>Nome : $profissional->nome</p> 
		<p>Idade : $profissional->idade</p> 
		<p>RG : $profissional->rg</p>
		<p>Posição : $profissional->posicao</p>
		<p>Salário : $profissional->salario</p>
		<p>Habilidade : $profissional->habilidade</p>
		<p>Time : $time</p>
		
		<div class='acao'>
			  <form action='editar.php' method='get' accept-charset='utf-8' style='display: inline;'>
			    <input type='hidden' name='num' value='$profissional->id'/>
			    <input type='submit' value='Editar' />
			 </form>
			  <form action='apagar.php' method='post' accept-charset='utf-8' style='display: inline;'>
			    <input type='hidden' name='num' value='$profissional->id'/>
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
