<?php 

	require_once 'app/model/time.php';
	require_once '/db/conexao.php';
	
	$con = new Conexao(DB_SERVER, DB_NAME, DB_USERNAME, DB_PASSWORD);
	$con->conectar();
	if($con->conn){
		echo "OK\n";
	}else
		echo "falhou\n";
	
	
	$time = new Time($id=0, $nome='Cruzeiro', $sigla='CRU', $cor='Azul', $patrimonio=39000,
	 $ano='1900', $fkestadio=1, $fkcidade=1);
	 
	echo "inserir ". $con->insert($time);
	echo "\tid = $time->id";
	
	echo "\n";
	
	$time->nome = "Ronaldo";
	echo "update ". $con->update($time);
	
	echo "\n";
	
	$time->id = 7;
	echo "deletar ". $con->delete($time);
	
	echo "\n";
	
	foreach ($time->fabricarObjetos($con->select('time', '*', "idtime < 30")) as $key) {
		echo $key->id."\n";	
		echo $key->nome."\n";
		echo $key->ano."\n";
		
		
	}	
	$con->desconectar();

	
	
	
	
	
 ?>