<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>

<div class="formulario">
	<h2>Cadastro de Arbitro</h2>
	 <?php 
		   include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/arbitro_controller.php';
		   	$arbitroCtr = new ArbitroController();
			$arbitroCtr->novo();
			$cidades = $arbitroCtr->todasCidades();
	 ?>
	<form action="salvar.php" method="post">
		Nome: <input type="text" name="nome"><br>
		Idade: <input type="number" name="idade"><br>
		RG:   <input type="number" name="rg"><br>
		<select name='idcidade'>	  
		   <?php 
		   	
			 foreach($cidades as $c){
			 	 echo "<option value='$c->id'>$c->nome</option>";
			 }
		    	
		    ?>  
		</select>
	<input type="submit" value="Salvar">
	</form>
	
</div>

<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/footer.php'; ?>