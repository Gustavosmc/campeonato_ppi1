<?php 

	/**
	 * 
	 */
	 
	require_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/model/interfaces.php';
	class Profissional implements ObjetoDao{
		public $tabela = 'profissional';
	  	var  $id, $nome, $idade, $rg, $posicao, $salario, $habilidade, $fktime;
		
		function __construct($id=0, $nome='', $idade=0, $rg='', $posicao='', $salario=0, $habilidade=0, $fktime=0) {
			 $this->id = $id;
			 $this->nome = $nome;
			 $this->idade = $idade;
			 $this->rg = $rg;
			 $this->posicao = $posicao;
			 $this->salario = $salario;
			 $this->habilidade = $habilidade;
			 $this->fktime = $fktime;
		}
				
		/**
		 * retorna um array com os campos da tabela, atenção pois o primeiro
		 * item é sempre o nome da tabela
		 */
		public function arrayPropriedades()	{
			return ['tabela'=> $this->tabela, 'idprofissional'=> $this->id, 'nome'=> $this->nome,
				'idade'=> $this->idade, 'rg'=> $this->rg, 'posicao'=> $this->posicao,
				'salario'=> $this->salario, 'habilidade'=> $this->habilidade, 'fktime'=> $this->fktime];
		}
		
		/**
		 * fabrica objetos do tipo desta apartir de um stmt de colunas banco
		 */
		public function fabricarObjetos($stmtObjetos){
			$result = array();
			foreach ($stmtObjetos as $row) {
       			array_push($result, new Profissional($row['idprofissional'], $row['nome'],
				$row['idade'], $row['rg'],$row['posicao'], $row['salario'], $row['habilidade'],
				$row['fktime']));
    		}
			return $result;
		}
		
		
	}
	
	
	
	
	

 ?>