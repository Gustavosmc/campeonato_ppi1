
<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>
<br>
<div class="corpo" id='indexEstadio' >
	
	<div  id='menuEstadio' >
		<div id="name">
		  <span class="flaticon-football-court-illumination-lamps"></span>
		  <i>Estádios</i>
		</div>
		<form action='index.php' method='post' style="display: inline;">
			<input type='text' name="busca" placeholder="Buscar nome" />
			<input type='submit' value='Buscar' >
		</form>
		
		
		<form action='novo.php' method='get' style="display: inline;">
			<input type='submit' value='Novo Estadio'>
		</form>
		
	</div>

<?php 	
    include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/estadio_controller.php';
	$estadioCtr = new EstadioController();
	$estadios = $estadioCtr->index();
	if(!$estadios){
		echo "Nem um estadio encontrado";
	}else{
		echo "<table>
			  <tr>
			    <th>Nome</th>
			    <th>Apelido</th>
			    <th>Capacidade</th>
			    <th>Cidade</th>			    
			    <th>Acões</th>
			  </tr>";
	
			foreach ($estadios as $value) {
				$id = $value->id;
				$cidade = $estadioCtr->pegarCidade($value->fkcidade)->nome;				
				echo "<tr>
					    <td>$value->nome</td>
					    <td>$value->apelido</td> 
					    <td>$value->capacidade</td>
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