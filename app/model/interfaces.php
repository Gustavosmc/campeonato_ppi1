<?php 
	interface DaoObject{
		
		/**
		 * retorna um array com os campos da tabela, atenção pois o primeiro
		 * item é sempre o nome da tabela
		 */
		public function arrayPropriedades();
		
		
		/**
		 * fabrica objetos do tipo desta apartir de um stmt de colunas banco
		 */
		public function fabricarObjetos($stmtObjetos);
	}


 ?>