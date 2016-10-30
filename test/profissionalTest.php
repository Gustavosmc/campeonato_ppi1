<?php 

	require_once 'app/model/profissional.php';
	require_once '../db/conexao.php';
	
	$con = new Conexao(DB_SERVER, DB_NAME, DB_USERNAME, DB_PASSWORD);
	if($con->conn){
		echo "OK\n";
	}else
		echo "falhou\n";
	
	
	$profissional = new Profissional(0, "João", 18, '3930404','ZAGUEIRO',1040.40,90,7);
	echo "inserir ". $con->insert($profissional);
	echo "\tid = $profissional->id";
	
	echo "\n";
	
	$profissional->nome = "Zezinho";
	echo "update ". $con->update($profissional);
	
	echo "\n";
	
	$profissional->id = 2;
	echo "deletar ". $con->delete($profissional);
	
	echo "\n";
	
	foreach ($profissional->fabricarObjetos($con->select('profissional', '*', "idprofissional < 30")) as $key) {
		echo $key->nome."\n";
		echo $key->salario."\n";
	}
	
	
	$con->desconectar();

	
	
	
	
	
 ?>