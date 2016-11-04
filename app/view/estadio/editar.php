<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>

<div class="corpo" id="formularioEstadio">
	<h2>Edição de Estadio</h2>
	 <?php 
	   include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/estadio_controller.php';
	    $estadioCtr = new EstadioController();
		$cidades = $estadioCtr->todasCidades();
	   	$estadio = $estadioCtr->editar();
		$idCidade = $estadioCtr->pegarCidade()->id;
	 ?>
	 
	<div id="editar" >
		  <form action="atualizar.php" method="post" style="display: inline">
			<input type="hidden" name="num" <?php echo "value='$estadio->id'"; ?>/>
			Nome:<br />
			<input type="text" name="nome" <?php echo "value='$estadio->nome'"; ?>><br>
			Apelido:<br />
			<input type="text" name="apelido" <?php echo "value='$estadio->apelido'"; ?>><br>
			Capacidade:<br />  
			<input type="number" name="capacidade" <?php echo "value='$estadio->capacidade'"; ?>><br>
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
			<input type="hidden" name="num" value='<?php echo "$estadio->id"; ?>' />
			<input type='submit' value='Cancelar' >
		</form>
	</div>
	
	
	
</div>

<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/footer.php'; ?>