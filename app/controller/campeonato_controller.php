<?php 

	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/model/campeonato.php';
	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/model/grupo.php';
	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/db/conexao.php';
	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/base_controller.php';
	include 'helper.php';

	/**
	 * 
	 */
	class campeonatoController extends BaseController{
		private $conexao = null;
		public $campeonato = null;
		public $grupo = null;
		
		
		
		function __construct() {
			$this->conexao = new Conexao(DB_SERVER, DB_NAME, DB_USERNAME, DB_PASSWORD);
			$this->campeonato = new Campeonato();
		}
		
		public function todosGrupos(){
			$this->filtrar();
			$idcamp = $this->campeonato->id;
			$this->conexao->conectar();
			$this->grupo = new Grupo();
			$grupos = $this->grupo->fabricarObjetos($this->conexao->select('grupo', '*', "fkcampeonato = $idcamp"));
			$this->conexao->desconectar();
			return $grupos;		
		}

		// public function pegarCidade($id=0){
			// $this->conexao->conectar();
			// $cidade = new Cidade();
			// $fk = ($id) ? $id : $this->campeonato->fkcidade;
			// $cidade = $cidade->fabricarObjetos($this->conexao->select('cidade', '*', "idcidade = $fk limit 1"));
			// $this->conexao->desconectar();	
			// return $cidade[0];
		// }
		
		
		
		public function index(){
			$busca =  "idcampeonato > 0 ORDER BY descricao";
			if(isset($_POST['busca'])){
				$valor = test_input($_POST['busca']);
				$busca = "descricao LIKE '$valor%' ORDER BY descricao";			
			}
			$this->conexao->conectar();
			$ret = $this->campeonato->fabricarObjetos($this->conexao->select('campeonato', '*', $busca));
			$this->conexao->desconectar();
			if(count($ret) == 0){
				return null;
			}
			return $ret;
			
		}
		
		public function novo(){
			$this->campeonato = new Campeonato();
		}
		
		public function mostrar(){
			$this->filtrar();
			return $this->campeonato;
		}
		
		public function salvar($post){
				$descricao = $post['descricao'];
				$campeonato = new Campeonato(0, test_input($descricao));
				$this->conexao->conectar();
				$ret = $this->conexao->insert($campeonato);
				$this->conexao->desconectar();
				$this->campeonato = $campeonato;
				return $ret;
		}
		
		public function editar(){			
			 	$this->filtrar();
				return $this->campeonato;
		}
		
		public function atualizar($post){
			    $id = $post['num'];
				$descricao = $post['descricao'];
				$this->campeonato = new Campeonato(test_input($id), test_input($descrica));	   
				$this->conexao->conectar();
				$ret = $this->conexao->update($this->campeonato);
				$this->conexao->desconectar();
				return $ret;
		}
		
		public function apagar($post){
			$id = $post['num'];
			$id = test_input($id);
			$this->campeonato->id = $id;
			$this->conexao->conectar();
			$ret = $this->conexao->delete($this->campeonato);
			$this->conexao->desconectar();
			return $ret;
		}
		
		
		// TODO arrumar venerabilidade SQL-Injection
		public function filtrar(){
			$id = $this->campeonato->id;
			if(isset($_GET['num'])){
				$id = test_input($_GET['num']);
			}		
			$this->conexao->conectar();
			$ret = $this->campeonato->fabricarObjetos($this->conexao->select('campeonato', '*', "idcampeonato = $id limit 1"));
			$this->conexao->desconectar();
			if(count($ret) == 0){
				$this->campeonato = null;
			}else
				$this->campeonato = $ret[0];
		}
		
		
		
		
	}
	


 ?>