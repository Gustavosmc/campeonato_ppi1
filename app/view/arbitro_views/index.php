<link rel="stylesheet" href="../assets/css/arbitro.css" type="text/css">
<link rel="stylesheet" type="text/css" href="../assets/css/font/flaticon.css">

<div class="tabela">
<?php 	
    include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/arbitro_controller.php';
	$arbitroCtr = new ArbitroController();
	
	echo "<table>
			  <tr>
			    <th>Nome</th>
			    <th>Idade</th> 
			    <th>RG</th>
			  </tr>";
	
	foreach ($arbitroCtr->index() as $value) {
		echo "<tr>
			    <td>$value->nome</td>
			    <td>$value->idade</td> 
			    <td>$value->rg</td>
			    <td>
			    <button type='button'>  +  </button>
			    <span class='flaticon-football-referee-with-whistle'></span></td>
  			  </tr>";
		
		
	}
	echo "</table>";
?>
</div>