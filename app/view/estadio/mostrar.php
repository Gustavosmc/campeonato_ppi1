<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>

<div class="corpo" id="mostrarEstadio">
<?php 
 	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/estadio_controller.php';
	$estadioCtr = new EstadioController();
	$estadio = $estadioCtr->mostrar();
	$nomeCidade = $estadioCtr->pegarCidade($estadio->fkcidade)->nome;
	
	if(isset($_GET['novo'])){
		echo "<h3>$estadio->nome cadastrado com sucesso!</h3>";
	}elseif(isset($_GET['edicao'])){
		echo "<h3>$estadio->nome atualizado com sucesso!</h3>";	
	}elseif($estadio){
		echo "<h3>Dados do estadio $estadio->nome</h3>";
	}
	
	if($estadio){
		
		echo "
		<p>Nome : $estadio->nome</p> 
		<p>Apelido : $estadio->apelido</p> 
		<p>Capacidade : $estadio->capacidade</p>
		<p>Cidade : $nomeCidade</p>
		
		<div class='acao'>
			  <form action='editar.php' method='get' accept-charset='utf-8' style='display: inline;'>
			    <input type='hidden' name='num' value='$estadio->id'/>
			    <input type='submit' value='Editar' />
			 </form>
			  <form action='apagar.php' method='post' accept-charset='utf-8' style='display: inline;'>
			    <input type='hidden' name='num' value='$estadio->id'/>
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
