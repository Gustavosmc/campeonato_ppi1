<?php 

	require_once 'app/model/campeonato.php';
	require_once '../db/conexao.php';
	
	$cam = new Campeonato(0,"Brasilao");
	
	$con = new Conexao(DB_SERVER, DB_NAME, DB_USERNAME, DB_PASSWORD);
	if($con->conn){
		echo "OK\n";
	}else
		echo "falhou\n";
	
	// Teste de insert
	echo 'inseriu '. $con->insert($cam->arrayPropriedades());
	echo "\n";
	
	
	// Teste de update
	$cam = new Campeonato(1, "Futsal");
	echo 'atualizou '. $con->update($cam->arrayPropriedades(), "idcampeonato", 1 );
	echo "\n";
	
	// Teste de select
	$resultado = $con->select('campeonato','*', "descricao like '%u%' limit 1");
	$campts = new Campeonato();
	$campts = $campts->fabricarObjetos($resultado);	
	foreach ($campts as $camp) {
		echo "$camp->id  $camp->descricao\n";
		
	}
	
	
	// Teste de delete
	$del = new Campeonato();
	$del->id = 4;
	echo 'deletou '. $con->delete($del->arrayPropriedades());
	
	
	
	
	$con->desconectar();

	
	
	
	
	
 ?>