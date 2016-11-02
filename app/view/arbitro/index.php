<link rel="stylesheet" href="../assets/css/arbitro.css" type="text/css">
<link rel="stylesheet" href="../assets/css/font/flaticon.css" type="text/css" >

<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/menu.php'; ?>

<div class="index" id='divArbitros'>
<h2>Arbitros</h2><br>
<div id='menuArbitro'>
	
	<form action='novo.php' method='get'>
		<input type='submit' value='Novo Arbitro'><br>
	</form>
</div>

<?php 	
    include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/arbitro_controller.php';
	$arbitroCtr = new ArbitroController();
	$arbitros = $arbitroCtr->index();
	if(!$arbitros){
		echo "Nem um arbitro cadastrado ainda";
		echo "<button type='button'>  +  </button>";
	}
	echo "<table>
			  <tr>
			    <th>Nome</th>
			    <th>Idade</th> 
			    <th>RG</th>		   
			  </tr>";
	
			foreach ($arbitros as $value) {
				$id = $value->id;
				echo "<tr>
					    <td>$value->nome</td>
					    <td>$value->idade</td> 
					    <td>$value->rg</td>
					    <td>
						  <form action='mostrar.php' method='get'>
							<input type='hidden' name='num' value='$id'><br>
							<input type='submit' value='Mais..'><br>
						  </form>
					    </td>
		  			  </tr>";
			}
	echo "</table>";
?>

</div>

<?php include $_SERVER["DOCUMENT_ROOT"].'/campeonato/app/view/layout/footer.php'; ?>