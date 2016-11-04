<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>

<div class="corpo" id="formularioTime">
	<h2>Cadastro de Time</h2>
	 <?php 
		   include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/time_controller.php';
		   	$timeCtr = new TimeController();
			$timeCtr->novo();
			$cidades = $timeCtr->todasCidades();
			$estadios = $timeCtr->todosEstadios();
			
	 ?>
	 <div id="novo">
	    <form action="salvar.php" method="post" style="display: inline">
			Nome:<br />
			<input type="text" name="nome" ><br>
			Sigla:<br />
			<input type="text" name="sigla" ><br>
			Cor:<br />  
			<input type="text" name="cor" ><br>
			Patrimônio:<br />  
			<input type="text" name="patrimonio" ><br>
			Ano:<br />  
			<input type="number" min='0' max='9999' name="ano" ><br>
			Cidade:<br />
			<select name='idcidade'>	  
				   <?php 	
					 foreach($cidades as $c){ 
					 	 echo "<option value='$c->id'>$c->nome</option>";
					 }?>  
			</select></br>
			Estádio:<br />
			<select name='idestadio'>	  
				   <?php 	
					 foreach($estadios as $e){	 
					 	 echo "<option value='$e->id' >$e->nome</option>";
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