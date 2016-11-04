
<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>
<br>
<div class="corpo" id='indexTime' >
	
	<div  id='menuTime' >
		<div id="name">
		  <span class="flaticon-football-badge"></span>
		  <i>Times</i>
		</div>
		<form action='index.php' method='post' style="display: inline;">
			<input type='text' name="busca" placeholder="Buscar nome" />
			<input type='submit' value='Buscar' >
		</form>
		
		
		<form action='novo.php' method='get' style="display: inline;">
			<input type='submit' value='Novo Time'>
		</form>
		
	</div>

<?php 	
    include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/time_controller.php';
	$timeCtr = new TimeController();
	$times = $timeCtr->index();
	if(!$times){
		echo "Nem um time encontrado";
	}else{
		echo "<table>
			  <tr>
			    <th>Nome</th>
			    <th>Sigla</th>
			    <th>Cor</th>
			    <th>Patrimônio</th>
			    <th>Ano Nascimento</th>
			    <th>Estádio</th>
			    <th>Cidade</th>			    
			    <th>Acões</th>
			  </tr>";
	
			foreach ($times as $value) {
				$id = $value->id;
				$cidade = $timeCtr->pegarCidade($value->fkcidade)->nome;	
				$estadio = $timeCtr->pegarEstadio($value->fkestadio)->nome;			
				echo "<tr>
					    <td>$value->nome</td>
					    <td>$value->sigla</td> 
					    <td>$value->cor</td>
					    <td>$value->patrimonio</td>
					    <td>$value->ano</td>
					    <td>$estadio</td>
					    <td>$cidade</td>
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