
<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>
<br>
<div class="corpo" id='indexArbitro' >
	
	<div  id='menuArbitro' >
		<div id="name">
		  <span class="flaticon-whistle"></span>
		  <i>Arbitros</i>
		</div>
		<form action='index.php' method='post' style="display: inline;">
			<input type='text' name="busca" placeholder="Buscar nome" />
			<input type='submit' value='Buscar' >
		</form>
		
		
		<form action='novo.php' method='get' style="display: inline;">
			<input type='submit' value='Novo Arbitro'>
		</form>
		
	</div>

<?php 	
    include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/arbitro_controller.php';
	$arbitroCtr = new ArbitroController();
	$arbitros = $arbitroCtr->index();
	if(!$arbitros){
		echo "Nem um arbitro encontrado";
	}else{
		echo "<table>
			  <tr>
			    <th>Nome</th>
			    <th>Idade</th>
			    <th>RG</th>
			    <th>Cidade</th>			    
			    <th>Acões</th>
			  </tr>";
	
			foreach ($arbitros as $value) {
				$id = $value->id;
				$cidade = $arbitroCtr->pegarCidade($value->fkcidade)->nome;				
				echo "<tr>
					    <td>$value->nome</td>
					    <td>$value->idade</td> 
					    <td>$value->rg</td>
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