<?php 

	require_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/model/arbitro.php';
	require_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/db/conexao.php';
	
	$con = new Conexao(DB_SERVER, DB_NAME, DB_USERNAME, DB_PASSWORD);
	$con->conectar();
	if($con->conn){
		echo "OK\n";
	}else
		echo "falhou\n";
	
	
	$arbitro = new Arbitro(0, "Gustavo", "Unai", "102023939", 1);
	echo "inserir ". $con->insert($arbitro);
	echo "\tid = $arbitro->id";
	
	echo "\n";
	
	$arbitro->nome = "Ronaldo";
	echo "update ". $con->update($arbitro);
	
	echo "\n";
	
	$arbitro->id = 7;
	echo "deletar ". $con->delete($arbitro);
	
	foreach ($arbitro->fabricarObjetos($con->select('arbitro', '*', "idarbitro < 30")) as $key) {
		echo $key->nome."\n";
	}
	
	
	$con->desconectar();

	
	
	
	
	
 ?>