<?php 

	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/model/arbitro.php';
	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/db/conexao.php';
	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/base_controller.php';

	/**
	 * 
	 */
	class ArbitroController extends BaseController{
		private $conexao = null;
		private $arbitro = null;
		
		function __construct() {
			$this->conexao = new Conexao(DB_SERVER, DB_NAME, DB_USERNAME, DB_PASSWORD);
			$this->arbitro = new Arbitro();
		}
		
		
		public function index(){
			$this->conexao->conectar();
			$ret = $this->arbitro->fabricarObjetos($this->conexao->select('arbitro', '*', "idarbitro > 0"));
			$this->conexao->desconectar();
			if(count($ret) == 0){
				return "Nem um arquivo encontrado";
			}
			return $ret;
			
		}
		
		public function novo(){
			
		}
		
		public function mostrar(){
			
		}
		
		public function salvar(){
			
		}
		
		public function editar(){
			
		}
		
		public function apagar(){
			
		}
		
		public function filtrar(){
			
		}
		
		
		
		
	}
	


 ?>