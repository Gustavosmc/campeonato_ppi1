<?php 

	require_once 'app/model/grupo.php';
	require_once '/db/conexao.php';
	
	$con = new Conexao(DB_SERVER, DB_NAME, DB_USERNAME, DB_PASSWORD);
	$con->conectar();
	if($con->conn){
		echo "OK\n";
	}else
		echo "falhou\n";
	
	
	$grupo = new Grupo(0, 'A',20,2);
	echo "inserir ". $con->insert($grupo);
	echo "\tid = $grupo->id";
	
	echo "\n";
	
	$grupo->descricao = "B";
	echo "update ". $con->update($grupo);
	
	echo "\n";
	
	$grupo->id = 2;
	echo "deletar ". $con->delete($grupo);
	
	foreach ($grupo->fabricarObjetos($con->select('grupo', '*', "idgrupo < 30")) as $key) {
		echo $key->descricao."\n";
	}
	
	
	$con->desconectar();

	
	
	
	
	
 ?>