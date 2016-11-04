
<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>
<br>
<div class="corpo" id='indexJogo' >
	
	<div  id='menuJogo' >
		<div id="name">
		  <span class="flaticon-football-in-midair"></span>
		  <i>Jogos</i>
		</div>
		<form action='index.php' method='post' style="display: inline;">
			<input type='text' name="busca" placeholder="Buscar nome" />
			<input type='submit' value='Buscar' >
		</form>
		
		
		<form action='novo.php' method='get' style="display: inline;">
			<input type='submit' value='Novo Jogo'>
		</form>
		
	</div>

<?php 	
    include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/jogo_controller.php';
	$jogoCtr = new JogoController();
	$jogos = $jogoCtr->index();
	if(!$jogos){
		echo "Nem um jogo encontrado";
	}else{
		echo "<table>
			  <tr>
			    <th>Time 1</th>
			    <th>Gols Time 1</th>
			    <th>X</th>
			    <th>Gols Time 2</th>			    
			    <th>Time 2</th>
			    <th>Estádio</th>
			    <th>Árbitro</th>	    
			  </tr>";
	
			foreach ($jogos as $value) {
				$id = $value->id;
				$time1 = $jogoCtr->pegarTime1($value->fktime1)->nome;
				$time2 = $jogoCtr->pegarTime2($value->fktime2)->nome;
				$estadio = $jogoCtr->pegarEstadio($value->fkestadio)->nome;	
				$arbitro = $jogoCtr->pegarArbitro($value->fkarbitro)->nome;				
				echo "<tr>
					    <td>$time1</td>
					    <td>$value->gols_time1</td> 
					    <td>X</td>
					    <td>$value->gols_time2</td>
					    <td>$time2</td>
					    <td>$estadio</td>
					    <td>$arbitro</td>
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