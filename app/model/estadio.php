<?php 

	/**
	 * 
	 */
	 
	require_once 'app/model/interfaces.php';
	class Estadio implements ObjetoDao{
		public $tabela = 'estadio';
	  	var  $id, $nome, $apelido, $capacidade, $fkcidade;
		
		function __construct($id=0, $nome='', $apelido='', $capacidade=0, $fkcidade=0, $tabela='estadio') {
			 $this->id = $id;
			 $this->nome = $nome;
			 $this->apelido = $apelido;
			 $this->capacidade = $capacidade;
			 $this->tabela = $tabela;
			 $this->fkcidade = $fkcidade;
		}
				
		/**
		 * retorna um array com os campos da tabela, atenção pois o primeiro
		 * item é sempre o nome da tabela
		 */
		public function arrayPropriedades()	{
			return ['tabela'=> $this->tabela, 'idestadio'=> $this->id,'nome'=>$this->nome,
				'apelido'=> $this->apelido, 'capacidade'=> $this->capacidade, 'fkcidade'=>$this->fkcidade];
		}
		
		/**
		 * fabrica objetos do tipo desta apartir de um stmt de colunas banco
		 */
		public function fabricarObjetos($stmtObjetos){
			$result = array();
			foreach ($stmtObjetos as $row) {
       			array_push($result, new Estadio($row['idestadio'], $row['nome'],
				$row['apelido'], $row['capacidade'],$row['fkcidade']));
    		}
			return $result;
		}
		
		
	}
	
	
	
	
	

 ?>