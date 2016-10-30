<?php 

	require_once 'app/model/cidade.php';
	require_once '../db/conexao.php';
	
	$con = new Conexao(DB_SERVER, DB_NAME, DB_USERNAME, DB_PASSWORD);
	if($con->conn){
		echo "OK\n";
	}else
		echo "falhou\n";
	
	
	$cidade = new Cidade(0, "João Pinheiro", "MG");
	echo "inserir ". $con->insert($cidade);
	echo "\tid = $cidade->id";
	
	echo "\n";
	
	$cidade->nome = "Pinheirão";
	echo "update ". $con->update($cidade);
	
	echo "\n";
	$cidade->id = 3;
	echo "deletar ". $con->delete($cidade);
	
	echo "\n";
	
	foreach ($cidade->fabricarObjetos($con->select('cidade', '*', "idcidade < 10")) as $key) {
		echo $key->nome."\n";
	}
	
	
	$con->desconectar();

 ?>