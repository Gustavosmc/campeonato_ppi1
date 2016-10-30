<?php 

	/**
	 * 
	 */
	 
	require_once 'app/model/interfaces.php';
	class Arbitro implements ObjetoDao{
		public $tabela = 'arbitro';
	  	var  $id, $nome, $idade, $rg, $fkcidade;
		
		function __construct($id=0, $nome='', $idade=0, $rg='',$fkcidade=null, $tabela='arbitro') {
			 $this->id = $id;
			 $this->nome = $nome;
			 $this->idade = $idade;
			 $this->rg = $rg;
			 $this->fkcidade = $fkcidade;
			 $this->tabela = $tabela;
		}
				
		/**
		 * retorna um array com os campos da tabela, atenção pois o primeiro
		 * item é sempre o nome da tabela
		 */
		public function arrayPropriedades()	{
			return ['tabela'=> $this->tabela, 'idarbitro'=> $this->id,'nome'=>$this->nome,
				'idade'=>$this->idade, 'rg'=>$this->rg, 'fkcidade'=>$this->fkcidade];
		}
		
		/**
		 * fabrica objetos do tipo desta apartir de um stmt de colunas banco
		 */
		public function fabricarObjetos($stmtObjetos){
			$result = array();
			foreach ($stmtObjetos as $row) {
       			array_push($result, new Arbitro($row['idarbitro'], $row['nome'],
				$row['idade'], $row['rg'],$row['fkcidade']));
    		}
			return $result;
		}
		
		
	}
	
	
	
	
	

 ?>