<?php 

	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/model/estadio.php';
	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/model/cidade.php';
	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/db/conexao.php';
	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/base_controller.php';
	include 'helper.php';

	/**
	 * 
	 */
	class EstadioController extends BaseController{
		private $conexao = null;
		public $estadio = null;
		public $cidade = null;
		
		
		function __construct() {
			$this->conexao = new Conexao(DB_SERVER, DB_NAME, DB_USERNAME, DB_PASSWORD);
			$this->estadio = new Estadio();
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
			$fk = ($id) ? $id : $this->estadio->fkcidade;
			$cidade = $cidade->fabricarObjetos($this->conexao->select('cidade', '*', "idcidade = $fk limit 1"));
			$this->conexao->desconectar();	
			return $cidade[0];
		}
		
		
		
		public function index(){
			$busca =  "idestadio > 0 ORDER BY nome";
			if(isset($_POST['busca'])){
				$valor = test_input($_POST['busca']);
				$busca = "nome LIKE '$valor%' ORDER BY nome";			
			}
			$this->conexao->conectar();
			$ret = $this->estadio->fabricarObjetos($this->conexao->select('estadio', '*', $busca));
			$this->conexao->desconectar();
			if(count($ret) == 0){
				return null;
			}
			return $ret;
			
		}
		
		public function novo(){
			$this->estadio = new Estadio();
		}
		
		public function mostrar(){
			$this->filtrar();
			return $this->estadio;
		}
	
		public function salvar($post){
				$nome = $post['nome'];
				$apelido = $post['apelido'];
				$capacidade = $post['capacidade'];
				$idcidade = $post['idcidade'];
				$estadio = new Estadio(0, test_input($nome), test_input($apelido), test_input($capacidade), test_input($idcidade));
				$this->conexao->conectar();
				$ret = $this->conexao->insert($estadio);
				$this->conexao->desconectar();
				$this->estadio = $estadio;
				return $ret;
		}
		
		public function editar(){			
			 	$this->filtrar();
				return $this->estadio;
		}
		
		public function atualizar($post){
			    $id = $post['num'];
				$nome = $post['nome'];
				$apelido = $post['apelido'];
				$capacidade = $post['capacidade'];
				$idcidade = $post['idcidade'];
				$this->estadio = new Estadio(test_input($id), test_input($nome), test_input($apelido), test_input($capacidade), 
				test_input($idcidade));	   
				$this->conexao->conectar();
				$status = $this->conexao->update($this->estadio);
				$this->conexao->desconectar();
				return $status;
			
		}
		
		public function apagar($post){
			$id = $post['num'];
			$id = test_input($id);
			$this->estadio->id = $id;
			$this->conexao->conectar();
			$ret = $this->conexao->delete($this->estadio);
			$this->conexao->desconectar();
			return $ret;
		}
		
		
		// TODO arrumar venerabilidade SQL-Injection
		public function filtrar(){
			$id = $this->estadio->id;
			if(isset($_GET['num'])){
				$id = test_input($_GET['num']);
			}		
			$this->conexao->conectar();
			$ret = $this->estadio->fabricarObjetos($this->conexao->select('estadio', '*', "idestadio = $id limit 1"));
			$this->conexao->desconectar();
			if(count($ret) == 0){
				$this->estadio = null;
			}else
				$this->estadio = $ret[0];
		}
		
		
		
		
	}
	


 ?>