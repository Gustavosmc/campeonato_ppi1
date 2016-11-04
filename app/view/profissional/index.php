
<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>
<br>
<div class="corpo" id='indexProfissional' >
	
	<div  id='menuProfissional' >
		<div id="name">
		  <span class="flaticon-football-player-kicking-ball-1"></span>
		  <i>Profissionais</i>
		</div>
		<form action='index.php' method='post' style="display: inline;">
			<input type='text' name="busca" placeholder="Buscar nome" />
			<input type='submit' value='Buscar' >
		</form>
		
		
		<form action='novo.php' method='get' style="display: inline;">
			<input type='submit' value='Novo Profissional'>
		</form>
		
	</div>

<?php 	
    include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/profissional_controller.php';
	$profissionalCtr = new ProfissionalController();
	$profissionais = $profissionalCtr->index();
	if(!$profissionais){
		echo "Nem um profissional encontrado";
	}else{
		echo "<table>
			  <tr>
			    <th>Nome</th>
			    <th>Idade</th>
			    <th>RG</th>
			    <th>Posição</th>
				<th>Salário</th>
				<th>Habilidade</th>
				<th>Time</th>		    
			    <th>Acões</th>
			  </tr>";
	
			foreach ($profissionais as $value) {
				$id = $value->id;
				$time = $profissionalCtr->pegarTime($value->fktime)->nome;				
				echo "<tr>
					    <td>$value->nome</td>
					    <td>$value->idade</td> 
					    <td>$value->rg</td>
					    <td>$value->posicao</td>
					    <td>R$ $value->salario</td>
					    <td>$value->habilidade</td>
					    <td>$time</td>
					    <td>
						  <form action='mostrar.php' method='get'>
							<input type='hidden' name='num' value='$id'><br>
							<input type='submit' value='Mais..'><br>
						  </form>
					    </td>
		  			  </tr>";
			}
	echo "</table>";
  }
?>

</div>

<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/footer.php'; ?>