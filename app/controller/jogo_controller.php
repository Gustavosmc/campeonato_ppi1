<?php 

	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/model/arbitro.php';
	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/model/cidade.php';
	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/db/conexao.php';
	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/base_controller.php';
	include 'helper.php';

	/**
	 * 
	 */
	class ArbitroController extends BaseController{
		private $conexao = null;
		public $arbitro = null;
		public $cidade = null;
		
		
		function __construct() {
			$this->conexao = new Conexao(DB_SERVER, DB_NAME, DB_USERNAME, DB_PASSWORD);
			$this->arbitro = new Arbitro();
		}
		
		public function todasCidades(){
			$this->conexao->conectar();
			$cidade = new Cidade();
			$cidades = $cidade->fabricarObjetos($this->conexao->select('cidade', '*', 'idcidade > 0'));
			$this->conexao->desconectar();
			return $cidades;		
		}

		public function pegarCidade($id=0){
			$this->conexao->conectar();
			$cidade = new Cidade();
			$fk = ($id) ? $id : $this->arbitro->fkcidade;
			$cidade = $cidade->fabricarObjetos($this->conexao->select('cidade', '*', "idcidade = $fk limit 1"));
			$this->conexao->desconectar();	
			return $cidade[0];
		}
		
		
		
		public function index(){
			$busca =  "idarbitro > 0 ORDER BY nome";
			if(isset($_POST['busca'])){
				$valor = test_input($_POST['busca']);
				$busca = "nome LIKE '$valor%' ORDER BY nome";			
			}
			$this->conexao->conectar();
			$ret = $this->arbitro->fabricarObjetos($this->conexao->select('arbitro', '*', $busca));
			$this->conexao->desconectar();
			if(count($ret) == 0){
				return null;
			}
			return $ret;
			
		}
		
		public function novo(){
			$this->arbitro = new Arbitro();
		}
		
		public function mostrar(){
			$this->filtrar();
			return $this->arbitro;
		}
		
		public function salvar($post){
				$nome = $post['nome'];
				$idade = $post['idade'];
				$rg = $post['rg'];
				$idcidade = $post['idcidade'];
				$arbitro = new Arbitro(0, test_input($nome), test_input($idade), test_input($rg), test_input($idcidade));
				$this->conexao->conectar();
				$ret = $this->conexao->insert($arbitro);
				$this->conexao->desconectar();
				$this->arbitro = $arbitro;
				return $ret;
		}
		
		public function editar(){			
			 	$this->filtrar();
				return $this->arbitro;
		}
		
		public function atualizar($post){
			    $id = $post['num'];
				$nome = $post['nome'];
				$idade = $post['idade'];
				$rg = $post['rg'];
				$idcidade = $post['idcidade'];
				$this->arbitro = new Arbitro(test_input($id), test_input($nome), test_input($idade), test_input($rg), 
				test_input($idcidade));	   
				$this->conexao->conectar();
				$status = $this->conexao->update($this->arbitro);
				$this->conexao->desconectar();
				return $status;
			
		}
		
		public function apagar($post){
			$id = $post['num'];
			$id = test_input($id);
			$this->arbitro->id = $id;
			$this->conexao->conectar();
			$ret = $this->conexao->delete($this->arbitro);
			$this->conexao->desconectar();
			return $ret;
		}
		
		
		// TODO arrumar venerabilidade SQL-Injection
		public function filtrar(){
			$id = $this->arbitro->id;
			if(isset($_GET['num'])){
				$id = test_input($_GET['num']);
			}		
			$this->conexao->conectar();
			$ret = $this->arbitro->fabricarObjetos($this->conexao->select('arbitro', '*', "idarbitro = $id limit 1"));
			$this->conexao->desconectar();
			if(count($ret) == 0){
				$this->arbitro = null;
			}else
				$this->arbitro = $ret[0];
		}
		
		
		
		
	}
	


 ?>