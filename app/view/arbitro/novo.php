<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>

<div class="corpo" id="formularioArbitro">
	<h2>Cadastro de Arbitro</h2>
	 <?php 
		   include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/arbitro_controller.php';
		   	$arbitroCtr = new ArbitroController();
			$arbitroCtr->novo();
			$cidades = $arbitroCtr->todasCidades();
	 ?>
	 <div id="novo">
	   <form action="salvar.php" method="post" style="display: inline;">
		Nome:<br>
		<input type="text" name="nome" style="display: inline;"><br>
		Idade:<br>
		<input type="number" name="idade" style="display: inline;"><br>
		RG:<br>
		<input type="number" name="rg" style="display: inline;"><br>
		Cidade:<br>
		<select name='idcidade'>	  
		   <?php 		   	
			 foreach($cidades as $c){
			 	 echo "<option value='$c->id'>$c->nome</option>";
			 } ?>  
		</select></br></br>
		<input type="submit" value="Salvar" >
		</form>
		<form action='index.php' method='get' style="display: inline;">
			<input type='submit' value='Voltar' />
		</form>
	 </div>
	
	
</div>

<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/footer.php'; ?>