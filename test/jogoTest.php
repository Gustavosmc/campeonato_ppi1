<?php 

	require_once 'app/model/jogo.php';
	require_once '../db/conexao.php';
	
	$con = new Conexao(DB_SERVER, DB_NAME, DB_USERNAME, DB_PASSWORD);
	if($con->conn){
		echo "OK\n";
	}else
		echo "falhou\n";
	
	
	$jogo = new Jogo(0,7,19,3,2,1,8,3);
	echo "inserir ". $con->insert($jogo);
	echo "\tid = $jogo->id";
	
	echo "\n";
	
	$jogo->gols_time1 = 7;
	echo "update ". $con->update($jogo);
	
	echo "\n";
	
	$jogo->id = 7;
	echo "deletar ". $con->delete($jogo);
	
	foreach ($jogo->fabricarObjetos($con->select('jogo', '*', "idjogo < 30")) as $key) {
		echo $key->gols_time1."x".$key->gols_time2;
		echo "\n";
	}
	
	
	
	$con->desconectar();

	
	
	
	
	
 ?>