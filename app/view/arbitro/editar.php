<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>

<div class="corpo" id="formularioArbitro">
	<h2>Edição de Arbitro</h2>
	 <?php 
	   include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/arbitro_controller.php';
	    $arbitroCtr = new ArbitroController();
		$cidades = $arbitroCtr->todasCidades();
	   	$arbitro = $arbitroCtr->editar();
		$idCidade = $arbitroCtr->pegarCidade()->id;
	 ?>
	 
	<div id="editar" >
		  <form action="atualizar.php" method="post" style="display: inline">
			<input type="hidden" name="num" <?php echo "value='$arbitro->id'"; ?>/>
			Nome:<br />
			<input type="text" name="nome" <?php echo "value='$arbitro->nome'"; ?>><br>
			Idade:<br />
			<input type="number" name="idade" <?php echo "value='$arbitro->idade'"; ?>><br>
			RG:<br />  
			<input type="number" name="rg" <?php echo "value='$arbitro->rg'"; ?>><br>
			Cidada:<br />
			<select name='idcidade'>	  
				   <?php 	
					 foreach($cidades as $c){
					 	 $selected = $c->id == $idCidade ? 'selected' : '';	 
					 	 echo "<option value='$c->id' $selected>$c->nome</option>";
					 }?>  
			</select></br></br>
			<input type="submit" value="Salvar" >
		</form>
		<form action='mostrar.php' method='get' style="display: inline;">
			<input type="hidden" name="num" value='<?php echo "$arbitro->id"; ?>' />
			<input type='submit' value='Cancelar' >
		</form>
	</div>
	
	
	
</div>

<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/footer.php'; ?>