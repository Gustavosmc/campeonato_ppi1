<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>

<div class="corpo" id="formularioProfissional">
	<h2>Cadastro de Profissional</h2>
	 <?php 
		include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/profissional_controller.php';
		$profissionalCtr = new ProfissionalController();
		$profissional = $profissionalCtr->editar();
		$times = $profissionalCtr->todosTimes();
		$posicoes = $profissionalCtr->todasPosicoes();
	 ?>
	 <div id="novo">
	    <form action="salvar.php" method="post" style="display: inline">
			Nome:<br />
			<input type="text" name="nome" ><br>
			Idade:<br />
			<input type="number" name="idade" ><br>
			RG:<br />  
			<input type="number" name="rg" ><br>	
			Salário:<br>
			<input type="number" step='0.01' name='salario' ><br>
			Habilidades:<br>
			<input type="text" name='habilidade' ><br>
			Posição:<br>
			<select name='posicao'>	  
				   <?php 	
					 foreach($posicoes as $k=>$v){	 
					 	 echo "<option value='$v' >$v</option>";
					 }?>  
			</select></br>
			Time:<br />
			<select name='idtime'>	  
				   <?php 	
					 foreach($times as $t){
					 	 echo "<option value='$t->id' >$t->nome</option>";
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