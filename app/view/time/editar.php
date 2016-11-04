<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>

<div class="corpo" id="formularioTime">
	<h2>Edição de Time</h2>
	 <?php 
	   include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/time_controller.php';
	    $timeCtr = new TimeController();
		$cidades = $timeCtr->todasCidades();
		$estadios = $timeCtr->todosEstadios();
	   	$time = $timeCtr->editar();
		$idCidade = $timeCtr->pegarCidade()->id;
		$idEstadio = $timeCtr->pegarEstadio()->id;
	 ?>
	 
	<div id="editar" >
		  <form action="atualizar.php" method="post" style="display: inline">
			<input type="hidden" name="num" <?php echo "value='$time->id'"; ?>/>
			Nome:<br />
			<input type="text" name="nome" <?php echo "value='$time->nome'"; ?>><br>
			Sigla:<br />
			<input type="text" name="sigla" <?php echo "value='$time->sigla'"; ?>><br>
			Cor:<br />  
			<input type="text" name="cor" <?php echo "value='$time->cor'"; ?>><br>
			Patrimônio:<br />  
			<input type="text" name="patrimonio" <?php echo "value='$time->patrimonio'"; ?>><br>
			Ano:<br />  
			<input type="number" name="ano" min='0' max='9999' <?php echo "value='$time->ano'"; ?>><br>
			Cidade:<br />
			<select name='idcidade'>	  
				   <?php 	
					 foreach($cidades as $c){
					 	 $selected = $c->id == $idCidade ? 'selected' : '';	 
					 	 echo "<option value='$c->id' $selected>$c->nome</option>";
					 }?>  
			</select></br>
			Estádio:<br />
			<select name='idestadio'>	  
				   <?php 	
					 foreach($estadios as $e){
					 	 $selected = $e->id == $idEstadio ? 'selected' : '';	 
					 	 echo "<option value='$e->id' $selected>$e->nome</option>";
					 }?>  
			</select></br></br>
			<input type="submit" value="Salvar" >
		</form>
		<form action='mostrar.php' method='get' style="display: inline;">
			<input type="hidden" name="num" value='<?php echo "$time->id"; ?>' />
			<input type='submit' value='Cancelar' >
		</form>
	</div>
	
	
	
</div>

<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/footer.php'; ?>