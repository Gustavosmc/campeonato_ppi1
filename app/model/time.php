<?php 

	/**
	 * 
	 */
	 
	require_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/model/interfaces.php';
	class Time implements ObjetoDao{
		public $tabela = 'time';
	  	var  $id, $nome, $sigla, $cor, $patrimonio, $ano, $fkestadio, $fkcidade;
		
		function __construct($id=0, $nome='', $sigla='', $cor='', $patrimonio=0, $ano=0, $fkestadio=0, $fkcidade=0) {
			 $this->id = $id;
			 $this->nome = $nome;
			 $this->sigla = $sigla;
			 $this->cor = $cor;
			 $this->patrimonio = $patrimonio;
			 $this->ano = $ano;
			 $this->fkestadio = $fkestadio;
			 $this->fkcidade = $fkcidade;
		}
				
		/**
		 * retorna um array com os campos da tabela, atenção pois o primeiro
		 * item é sempre o nome da tabela
		 */
		public function arrayPropriedades()	{
			return ['tabela'=> $this->tabela,'idtime'=> $this->id, 'nome'=> $this->nome, 'sigla'=> $this->sigla,
				'cor'=> $this->cor, 'patrimonio'=> $this->patrimonio, 'ano'=> $this->ano, 'fkestadio'=> $this->fkestadio,
				'fkcidade'=> $this->fkcidade];
		}
		
		/**
		 * fabrica objetos do tipo desta apartir de um stmt de colunas banco
		 */
		public function fabricarObjetos($stmtObjetos){
			$result = array();
			foreach ($stmtObjetos as $row) {
       			array_push($result, new Time($row['idtime'], $row['nome'],
				$row['sigla'], $row['cor'],$row['patrimonio'], $row['ano'], $row['fkestadio'],
				$row['fkcidade']));
    		}
			return $result;
		}
		
		
	}
	
	
	
	
	

 ?>