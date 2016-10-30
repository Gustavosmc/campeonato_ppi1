<?php 

	/**
	 * 
	 */
	 
	require_once 'app/model/interfaces.php';
	class Jogo implements ObjetoDao{
		public $tabela = 'jogo';
	  	var  $id, $fktime1, $fktime2, $gols_time1, $gols_time2, $fkestadio, $fkarbitro, $fkgrupo;
		
		function __construct($id=0, $fktime1=0, $fktime2=0, $gols_time1=0, $gols_time2=0, $fkestadio=0,
		 $fkarbitro=0, $fkgrupo=0,	$tabela='jogo') {
			 $this->id = $id;
			 $this->fktime1 = $fktime1;
			 $this->fktime2 = $fktime2;
			 $this->gols_time1 = $gols_time1;
			 $this->gols_time2 = $gols_time2;
			 $this->fkestadio = $fkestadio;
			 $this->fkarbitro = $fkarbitro;
			 $this->fkgrupo = $fkgrupo;
			 $this->tabela = $tabela;
			  
		}
				
		/**
		 * retorna um array com os campos da tabela, atenção pois o primeiro
		 * item é sempre o nome da tabela
		 */
		public function arrayPropriedades()	{
			return ['tabela'=> $this->tabela, 'idjogo'=> $this->id,'fktime1'=>$this->fktime1,
				'fktime2'=> $this->fktime2, 'gols_time1'=> $this->gols_time1,
				'gols_time2'=> $this->gols_time2, 'fkestadio'=> $this->fkestadio,
				'fkarbitro'=> $this->fkarbitro, 'fkgrupo'=> $this->fkgrupo];
		}
		
		/**
		 * fabrica objetos do tipo desta apartir de um stmt de colunas banco
		 */
		public function fabricarObjetos($stmtObjetos){
			$result = array();
			foreach ($stmtObjetos as $row) {
       			array_push($result, new Jogo($row['idjogo'], $row['fktime1'],
				$row['fktime2'], $row['gols_time1'], $row['gols_time2'], $row['fkestadio'],
				$row['fkarbitro'],$row['fkgrupo']));
    		}
			return $result;
		}
		
		
	}
	
	
	
	
	

 ?>