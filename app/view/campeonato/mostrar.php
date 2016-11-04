<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>

<div class="corpo" id="mostrarArbitro">
<?php 
 	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/arbitro_controller.php';
	$arbitroCtr = new ArbitroController();
	$arbitro = $arbitroCtr->mostrar();
	$nomeCidade = $arbitroCtr->pegarCidade()->nome;
	
	if(isset($_GET['novo'])){
		echo "<h3>$arbitro->nome cadastrado com sucesso!</h3>";
	}elseif(isset($_GET['edicao'])){
		echo "<h3>$arbitro->nome atualizado com sucesso!</h3>";	
	}elseif($arbitro){
		echo "<h3>Dados do arbitro $arbitro->nome</h3>";
	}
	
	if($arbitro){
		
		echo "
		<p>Nome : $arbitro->nome</p> 
		<p>Idade : $arbitro->idade</p> 
		<p>RG : $arbitro->rg</p>
		<p>Cidade : $nomeCidade</p>
		
		<div class='acao'>
			  <form action='editar.php' method='get' accept-charset='utf-8' style='display: inline;'>
			    <input type='hidden' name='num' value='$arbitro->id'/>
			    <input type='submit' value='Editar' />
			 </form>
			  <form action='apagar.php' method='post' accept-charset='utf-8' style='display: inline;'>
			    <input type='hidden' name='num' value='$arbitro->id'/>
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
