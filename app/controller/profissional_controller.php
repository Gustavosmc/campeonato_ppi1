<?php 

	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/model/profissional.php';
	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/model/time.php';
	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/db/conexao.php';
	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/base_controller.php';
	include 'helper.php';
	
	/**
	 * 
	 */
	class ProfissionalController extends BaseController{
		private $conexao = null;
		public $profissional = null;
		public $cidade = null;
		
		
		function __construct() {
			$this->conexao = new Conexao(DB_SERVER, DB_NAME, DB_USERNAME, DB_PASSWORD);
			$this->profissional = new Profissional();
		    
		}
		
		public function todasPosicoes(){
			return ['LE'=>'LATERAL ESQUERDO', 'AT'=>'ATACANTE', 'MC'=>'MEIO CAMPO', 'LD'=>'LATERAL DIREITO',
				'ZA'=>'ZAGUEIRO', 'GO'=>'GOLEIRO', 'TE'=>'TECNICO'];
		}
		
		public function pegarTime($id=0){
			$this->conexao->conectar();
			$time = new Time();
			$fk = ($id) ? $id : $this->profissional->fktime;
			$times = $time->fabricarObjetos($this->conexao->select('time', '*', "idtime = $fk limit 1"));
			$this->conexao->desconectar();	
			return $times[0];
		}
		
		public function todosTimes(){
			$this->conexao->conectar();
			$time = new Time();
			$times = $time->fabricarObjetos($this->conexao->select('time', '*', 'idtime > 0'));
			$this->conexao->desconectar();
			return $times;
		}

	
		
		
		public function index(){
			$busca =  "idprofissional > 0 ORDER BY nome";
			if(isset($_POST['busca'])){
				$valor = test_input($_POST['busca']);
				$busca = "nome LIKE '$valor%' ORDER BY nome";			
			}
			$this->conexao->conectar();
			$ret = $this->profissional->fabricarObjetos($this->conexao->select('profissional', '*', $busca));
			$this->conexao->desconectar();
			if(count($ret) == 0){
				return null;
			}
			return $ret;
			
		}
		
		public function novo(){
			$this->profissional = new Profissional();
		}
		
		public function mostrar(){
			$this->filtrar();
			return $this->profissional;
		}
		
		public function salvar($post){
				$nome = $post['nome'];
				$idade = $post['idade'];
				$rg = $post['rg'];
				$posicao = $post['posicao'];
				$salario = $post['salario'];
				$habilidade = $post['habilidade'];
				$fktime = $post['idtime'];
				$profissional = new Profissional(0, test_input($nome), test_input($idade), test_input($rg), 
					test_input($posicao), test_input($salario), test_input($habilidade), test_input($fktime));
				$this->conexao->conectar();
				$ret = $this->conexao->insert($profissional);
				$this->conexao->desconectar();
				$this->profissional = $profissional;
				return $ret;
		}
		
		public function editar(){			
			 	$this->filtrar();
				return $this->profissional;
		}
		
		public function atualizar($post){
			    $id = $post['num'];
				$nome = $post['nome'];
				$idade = $post['idade'];
				$rg = $post['rg'];
				$posicao = $post['posicao'];
				$salario = $post['salario'];
				$habilidade = $post['habilidade'];
				$fktime = $post['idtime'];
				$this->profissional = new Profissional(test_input($id), test_input($nome), test_input($idade), test_input($rg), 
					test_input($posicao), test_input($salario), test_input($habilidade), test_input($fktime));	   
				$this->conexao->conectar();
				$status = $this->conexao->update($this->profissional);
				$this->conexao->desconectar();
				return $status;
			
		}
		
		public function apagar($post){
			$id = $post['num'];
			$id = test_input($id);
			$this->profissional->id = $id;
			$this->conexao->conectar();
			$ret = $this->conexao->delete($this->profissional);
			$this->conexao->desconectar();
			return $ret;
		}
		
		
		// TODO arrumar venerabilidade SQL-Injection
		public function filtrar(){
			$id = $this->profissional->id;
			if(isset($_GET['num'])){
				$id = test_input($_GET['num']);
			}		
			$this->conexao->conectar();
			$ret = $this->profissional->fabricarObjetos($this->conexao->select('profissional', '*', "idprofissional = $id limit 1"));
			$this->conexao->desconectar();
			if(count($ret) == 0){
				$this->profissional = null;
			}else
				$this->profissional = $ret[0];
		}
		
		
		
		
	}
	


 ?>