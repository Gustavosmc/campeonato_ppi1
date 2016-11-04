<?php 

	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/model/time.php';
	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/model/cidade.php';
	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/model/estadio.php';
	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/db/conexao.php';
	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/base_controller.php';
	include 'helper.php';

	/**
	 * 
	 */
	class TimeController extends BaseController{
		private $conexao = null;
		public $time = null;
		public $cidade = null;
		public $estadio = null;
		
		
		function __construct() {
			$this->conexao = new Conexao(DB_SERVER, DB_NAME, DB_USERNAME, DB_PASSWORD);
			$this->time = new Time();
		}
		
		public function todasCidades(){
			$this->conexao->conectar();
			$cidade = new Cidade();
			$cidades = $cidade->fabricarObjetos($this->conexao->select('cidade', '*', 'idcidade > 0'));
			$this->conexao->desconectar();
			return $cidades;		
		}
		
		public function todosEstadios(){
			$this->conexao->conectar();
			$estadio = new Estadio();
			$estadios = $estadio->fabricarObjetos($this->conexao->select('estadio', '*', 'idestadio > 0'));
			$this->conexao->desconectar();
			return $estadios;	
		}
		

		public function pegarCidade($id=0){
			$this->conexao->conectar();
			$cidade = new Cidade();
			$fk = ($id) ? $id : $this->time->fkcidade;
			$cidade = $cidade->fabricarObjetos($this->conexao->select('cidade', '*', "idcidade = $fk limit 1"));
			$this->conexao->desconectar();	
			return $cidade[0];
		}

		public function pegarEstadio($id=0){
			$this->conexao->conectar();
			$estadio = new Estadio();
			$fk = ($id) ? $id : $this->time->fkestadio;
			$estadios = $estadio->fabricarObjetos($this->conexao->select('estadio', '*', "idestadio = $fk limit 1"));
			$this->conexao->desconectar();	
			return $estadios[0];
		}
		
		
		
		public function index(){
			$busca =  "idtime > 0 ORDER BY nome";
			if(isset($_POST['busca'])){
				$valor = test_input($_POST['busca']);
				$busca = "nome LIKE '$valor%' ORDER BY nome";			
			}
			$this->conexao->conectar();
			$ret = $this->time->fabricarObjetos($this->conexao->select('time', '*', $busca));
			$this->conexao->desconectar();
			if(count($ret) == 0){
				return null;
			}
			return $ret;
			
		}
		
		public function novo(){
			$this->time = new Time();
		}
		
		public function mostrar(){
			$this->filtrar();
			return $this->time;
		}
		
		public function salvar($post){
				$nome = $post['nome'];
				$sigla = $post['sigla'];
				$cor = $post['cor'];
				$ano = $post['ano'];
				$patrimonio = $post['patrimonio'];
				$fkcidade = $post['idcidade'];
				$fkestadio = $post['idestadio'];	
				$time = new Time(0, test_input($nome), test_input($sigla), test_input($cor), test_input($patrimonio),
				 test_input($ano), test_input($fkestadio), test_input($fkcidade));
				$this->conexao->conectar();
				$ret = $this->conexao->insert($time);
				$this->conexao->desconectar();
				$this->time = $time;
				return $ret;
		}
		
		public function editar(){			
			 	$this->filtrar();
				return $this->time;
		}
		
		public function atualizar($post){
			    $id = $post['num'];
				$nome = $post['nome'];
				$sigla = $post['sigla'];
				$cor = $post['cor'];
				$ano = $post['ano'];
				$patrimonio = $post['patrimonio'];
				$fkcidade = $post['idcidade'];
				$fkestadio = $post['idestadio'];	
				$this->time = new Time(test_input($id), test_input($nome), test_input($sigla), test_input($cor), test_input($patrimonio),
				 test_input($ano), test_input($fkestadio), test_input($fkcidade)); 
				$this->conexao->conectar();
				$status = $this->conexao->update($this->time);
				$this->conexao->desconectar();
				return $status;
			
		}
		
		public function apagar($post){
			$id = $post['num'];
			$id = test_input($id);
			$this->time->id = $id;
			$this->conexao->conectar();
			$ret = $this->conexao->delete($this->time);
			$this->conexao->desconectar();
			return $ret;
		}
		
		
		// TODO arrumar venerabilidade SQL-Injection
		public function filtrar(){
			$id = $this->time->id;
			if(isset($_GET['num'])){
				$id = test_input($_GET['num']);
			}		
			$this->conexao->conectar();
			$ret = $this->time->fabricarObjetos($this->conexao->select('time', '*', "idtime = $id limit 1"));
			$this->conexao->desconectar();
			if(count($ret) == 0){
				$this->time = null;
			}else
				$this->time = $ret[0];
		}
		
		
		
		
	}
	


 ?>