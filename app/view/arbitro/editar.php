<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>

<div class="formulario">
	<h2>Edição de Arbitro</h2>
	 <?php 
	   include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/arbitro_controller.php';
	    $arbitroCtr = new ArbitroController();
		$cidades = $arbitroCtr->todasCidades();
	   	$arbitro = $arbitroCtr->editar();
		$idCidade = $arbitroCtr->pegarCidade()->id;
	 ?>
	 
	<form action="atualizar.php" method="post">
		<input type="hidden" name="num" <?php echo "value='$arbitro->id'"; ?>/>
		Nome: <input type="text" name="nome" <?php echo "value='$arbitro->nome'"; ?>><br>
		Idade: <input type="number" name="idade" <?php echo "value='$arbitro->idade'"; ?>><br>
		RG:   <input type="number" name="rg" <?php echo "value='$arbitro->rg'"; ?>><br>
		Cidada:<select name='idcidade'>	  
		   <?php 	
			 foreach($cidades as $c){
			 	 $selected = $c->id == $idCidade ? 'selected' : '';	 
			 	 echo "<option value='$c->id' $selected>$c->nome</option>";
			 }
		    	
		    ?>  
		</select><br>
	<input type="submit" value="Salvar"><br>
	</form>
	
	
</div>

<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/footer.php'; ?>