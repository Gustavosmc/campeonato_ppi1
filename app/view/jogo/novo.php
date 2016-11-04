<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>

<div class="corpo" id="formularioJogo">
	<h2>Cadastro de Jogo</h2>
	 <?php 
		   include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/jogo_controller.php';
		   $jogoCtr = new JogoController();
		   $jogo = $jogoCtr->mostrar();
		   $times = $jogoCtr->todosTimes();
		   $estadios = $jogoCtr->todosEstadios();
		   $arbitros = $jogoCtr->todosArbitros();
		   
	 ?>
	 <div id="novo">
	   <form action="salvar.php" method="post" style="display: inline;">
		Time 1:<br>
		<select name='fktime1'>	  
		   <?php 		   	
			 foreach($times as $t){
			 	 echo "<option value='$t->id'>$t->nome</option>";
			 } ?>  
		</select></br>
		Gols Time 1:<br>
		<input type="number" name="gols1" style="display: inline;"><br>
		Time 2:<br>
		<select name='fktime2'>	  
		   <?php 		   	
			 foreach($times as $t){
			 	 echo "<option value='$t->id'>$t->nome</option>";
			 } ?>  
		</select></br>
		Gols Time 2:<br>
		<input type="number" name="gols2" style="display: inline;"><br>
		Estádio:<br>
		<select name='fkestadio'>	  
		   <?php 		   	
			 foreach($estadios as $e){
			 	 echo "<option value='$e->id'>$e->nome</option>";
			 } ?>  
		</select></br>
		Árbitro:<br>
		<select name='fkarbitro'>	  
		   <?php 		   	
			 foreach($arbitros as $a){
			 	 echo "<option value='$a->id'>$a->nome</option>";
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