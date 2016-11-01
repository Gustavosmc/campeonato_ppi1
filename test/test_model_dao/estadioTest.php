<?php 

	require_once 'app/model/estadio.php';
	require_once '/db/conexao.php';
	
	$con = new Conexao(DB_SERVER, DB_NAME, DB_USERNAME, DB_PASSWORD);
	$con->conectar();
	if($con->conn){
		echo "OK\n";
	}else
		echo "falhou\n";
	
	
	$estadio = new Estadio(0, "Estadio Unai", "Unaizão", 20000, 1);
	echo "inserir ". $con->insert($estadio);
	echo "\tid = $estadio->id";
	
	echo "\n";
	
	$estadio->nome = "Novo Estádio";
	echo "update ". $con->update($estadio);
	
	echo "\n";
	
	$estadio->id = 3;
	echo "deletar ". $con->delete($estadio);
	
	echo "\n";
	
	foreach ($estadio->fabricarObjetos($con->select('estadio', '*', "idestadio < 30")) as $key) {
		echo $key->nome."\n";
	}
	
	
	$con->desconectar();

	
	
	
	
	
 ?>