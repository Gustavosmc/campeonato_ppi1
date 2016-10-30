<?php 

	/**
	 * 
	 */
	 
	require_once 'app/model/interfaces.php';
	class Campeonato implements DaoObject{
	    public $id;
		public $descricao;
		
		function __construct($id=0, $descricao='') {
			 $this->descricao = $descricao;
			 $this->id = $id;
		}
				
		/**
		 * retorna um array com os campos da tabela, atenção pois o primeiro
		 * item é sempre o nome da tabela
		 */
		public function arrayPropriedades()	{
			return ['tabela'=> 'campeonato', 'idcampeonato'=> $this->id, 'descricao'=>$this->descricao];
		}
		
		/**
		 * fabrica objetos do tipo desta apartir de um stmt de colunas banco
		 */
		public function fabricarObjetos($stmtObjetos){
			$result = array();
			foreach ($stmtObjetos as $row) {
       			array_push($result, new Campeonato($row['idcampeonato'], $row['descricao']));
    		}
			return $result;
		}
		
		
	}
	
	
	
	
	

 ?>