<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>

<div class="corpo" id="formularioProfissional">
	<h2>Edição de Profissional</h2>
	 <?php 
	   include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/profissional_controller.php';
	    $profissionalCtr = new ProfissionalController();
		$profissional = $profissionalCtr->editar();
		$times = $profissionalCtr->todosTimes();
		$time = $profissionalCtr->pegarTime($profissional->fktime)->nome;
		$posicoes = $profissionalCtr->todasPosicoes();
	
	 ?>
	 
	<div id="editar" >
		  <form action="atualizar.php" method="post" style="display: inline">
			<input type="hidden" name="num" <?php echo "value='$profissional->id'"; ?>/>
			Nome:<br />
			<input type="text" name="nome" <?php echo "value='$profissional->nome'"; ?>><br>
			Idade:<br />
			<input type="number" name="idade" <?php echo "value='$profissional->idade'"; ?>><br>
			RG:<br />  
			<input type="number" name="rg" <?php echo "value='$profissional->rg'"; ?>><br>	
			Salário:<br>
			<input type="number" step='0.01' name='salario' <?php echo "value='$profissional->salario'"; ?>><br>
			Habilidades:<br>
			<input type="text" name='habilidade' <?php echo "value='$profissional->habilidade'"; ?>><br>
			Posição:<br>
			<select name='posicao'>	  
				   <?php 	
					 foreach($posicoes as $k=>$v){
					 	 $selected = $v == $profissional->posicao ? 'selected' : '';	 
					 	 echo "<option value='$v' $selected>$v</option>";
					 }?>  
			</select></br>
			Time:<br />
			<select name='idtime'>	  
				   <?php 	
					 foreach($times as $t){
					 	 $selected = $time == $t->nome ? 'selected' : '';	 
					 	 echo "<option value='$t->id' $selected>$t->nome</option>";
					 }?>  
			</select></br></br>
			
			<input type="submit" value="Salvar" >
		</form>
		<form action='mostrar.php' method='get' style="display: inline;">
			<input type="hidden" name="num" value='<?php echo "$profissional->id"; ?>' />
			<input type='submit' value='Cancelar' >
		</form>
	</div>
	
	
	
</div>

<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/footer.php'; ?>