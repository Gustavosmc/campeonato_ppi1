<?php 

	require_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/model/interfaces.php';
	/**
	 * 
	 */
	class Cidade implements ObjetoDao{
		public $tabela = 'cidade';
	  	var $id, $nome, $estado;
		
		function __construct($id=0, $nome='', $estado='', $tabela='cidade') {
			 $this->id = $id;
			 $this->nome = $nome;
			 $this->estado = $estado;
		}
				
		/**
		 * retorna um array com os campos da tabela, atenção pois o primeiro
		 * item é sempre o nome da tabela
		 */
		public function arrayPropriedades()	{
			return ['tabela'=> $this->tabela, 'idcidade'=> $this->id,'nome'=>$this->nome, 'estado'=>$this->estado];
		}
		
		/**
		 * fabrica objetos do tipo desta apartir de um stmt de colunas banco
		 */
		public function fabricarObjetos($stmtObjetos){
			$result = array();
			foreach ($stmtObjetos as $row) {
       			array_push($result, new Cidade($row['idcidade'], $row['nome'], $row['estado']));
    		}
			return $result;
		}
		
		
	}
	
	
	
	
	

 ?>