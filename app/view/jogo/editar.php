<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>

<div class="corpo" id="formularioArbitro">
	<h2>Edição de Jogo</h2>
	 <?php 
	   include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/jogo_controller.php';
	    $jogoCtr = new JogoController();
		$jogo = $jogoCtr->editar();
		$times = $jogoCtr->todosTimes();
		$estadios = $jogoCtr->todosEstadios();
		$arbitros = $jogoCtr->todosArbitros();
		$idArbitro = $jogoCtr->pegarArbitro($jogo->fkarbitro)->id;
		$idEstadio = $jogoCtr->pegarEstadio($jogo->fkestadio)->id;
		$idTime1 = $jogoCtr->pegarTime1($jogo->fktime1)->id;
		$idTime2 = $jogoCtr->pegarTime2($jogo->fktime2)->id;		
	 ?>
	 
	<div id="editar" >
		  <form action="salvar.php" method="post" style="display: inline;">
		Time 1:<br>
		<select name='fktime1'>
		   <?php 	 	   	
			 foreach($times as $t){
			 	 $selected = $t->id == $idTime1 ? 'selected' : '';
			 	 echo "<option value='$t->id' $selected>$t->nome</option>";
			 } ?>  
		</select></br>
		Gols Time 1:<br>
		<input type="number" name="gols1" <?php echo "value='$jogo->gols_time1'"; ?> style="display: inline;"><br>
		Time 2:<br>
		<select name='fktime2'>	  
		   <?php 		   	
			 foreach($times as $t){
			 	 $selected = $t->id == $idTime2 ? 'selected' : '';
			 	 echo "<option value='$t->id' $selected>$t->nome</option>";
			 } ?>  
		</select></br>
		Gols Time 2:<br>
		<input type="number" name="gols2" <?php echo "value='$jogo->gols_time2'"; ?> style="display: inline;"><br>
		Estádio:<br>
		<select name='fkestadio'>	  
		   <?php 		   	
			 foreach($estadios as $e){
			 	 $selected = $e->id == $idEstadio ? 'selected' : '';
			 	 echo "<option value='$e->id' $selected>$e->nome</option>";
			 } ?>  
		</select></br>
		Árbitro:<br>
		<select name='fkarbitro'>	  
		   <?php 		   	
			 foreach($arbitros as $a){
			 	 $selected = $a->id == $idArbitro ? 'selected' : '';
			 	 echo "<option value='$a->id' $selected>$a->nome</option>";
			 } ?>  
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