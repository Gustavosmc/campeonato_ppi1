
<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>
<br>
<div class="corpo" id='indexCampeonato' >
	
	<div  id='menuCampeonato' >
		<div id="name">
		  <span class="flaticon-trophy-football-cup"></span>
		  <i>Campeonatos</i>
		</div>
		<form action='index.php' method='post' style="display: inline;">
			<input type='text' name="busca" placeholder="Buscar nome" />
			<input type='submit' value='Buscar' >
		</form>
		
		
		<form action='novo.php' method='get' style="display: inline;">
			<input type='submit' value='Novo Campeonato'>
		</form>
		
	</div>

<?php 	
    include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/campeonato_controller.php';
	$campeonatoCtr = new CampeonatoController();
	$campeonatos = $campeonatoCtr->index();
	if(!$campeonatos){
		echo "Nem um campeonato encontrado";
	}else{
		echo "<table>
			  <tr>
			    <th>Descrição</th>		    
			    <th>Acões</th>
			  </tr>";
	
			foreach ($campeonatos as $value) {
				$id = $value->id;			
				echo "<tr>
					    <td>$value->descricao</td>
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