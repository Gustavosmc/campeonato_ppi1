<?php 

	/**
	 * 
	 */
	 
	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/model/interfaces.php';
	class Grupo implements ObjetoDao{
		public $tabela = 'grupo';
	  	var  $id, $descricao, $tamanho, $fkcampeonato;
		
		function __construct($id=0, $descricao='', $tamanho=0, $fkcampeonato=0, $tabela='grupo') {
			 $this->id = $id;
			 $this->descricao = $descricao;
			 $this->tamanho = $tamanho;
			 $this->fkcampeonato = $fkcampeonato;
			  
		}
				
		/**
		 * retorna um array com os campos da tabela, atenção pois o primeiro
		 * item é sempre o nome da tabela
		 */
		public function arrayPropriedades()	{
			return ['tabela'=> $this->tabela, 'idgrupo'=> $this->id,'descricao'=>$this->descricao,
				'tamanho'=> $this->tamanho, 'fkcampeonato'=> $this->fkcampeonato];
		}
		
		/**
		 * fabrica objetos do tipo desta apartir de um stmt de colunas banco
		 */
		public function fabricarObjetos($stmtObjetos){
			$result = array();
			foreach ($stmtObjetos as $row) {
       			array_push($result, new Grupo($row['idgrupo'], $row['descricao'],
				$row['tamanho'], $row['fkcampeonato']));
    		}
			return $result;
		}
		
		
	}
	
	
	
	
	

 ?>