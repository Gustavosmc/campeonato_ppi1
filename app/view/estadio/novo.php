<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>

<div class="corpo" id="formularioEstadio">
	<h2>Cadastro de Estádio</h2>
	 <?php 
	   include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/estadio_controller.php';
	    $estadioCtr = new EstadioController();
		$cidades = $estadioCtr->todasCidades();
	   	$estadio = $estadioCtr->novo();
	 ?>
	 
	<div id="editar" >
		  <form action="salvar.php" method="post" style="display: inline">
			Nome:<br />
			<input type="text" name="nome" ><br>
			Apelido:<br />
			<input type="text" name="apelido"><br>
			Capacidade:<br />  
			<input type="number" name="capacidade" ><br>
			Cidada:<br />
			<select name='idcidade'>	  
				   <?php 	
					 foreach($cidades as $c){
					 	 echo "<option value='$c->id'>$c->nome</option>";
					 }?>  
			</select></br></br>
			<input type="submit" value="Salvar" >
		</form>
		<form action='index.php' method='get' style="display: inline;">
			<input type='submit' value='Voltar' />
		</form>
	</div>
	
	
	
</div>

<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/footer.php'; ?>