<?php 

	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/model/jogo.php';
	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/model/estadio.php';
	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/model/arbitro.php';
	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/model/time.php';
	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/db/conexao.php';
	include_once $_SERVER["DOCUMENT_ROOT"] .'/campeonato/app/controller/base_controller.php';
	include 'helper.php';

	/**
	 * 
	 */
	class JogoController extends BaseController{
		private $conexao = null;
		public $jogo = null;
		public $estadio = null;
		
		
		function __construct() {
			$this->conexao = new Conexao(DB_SERVER, DB_NAME, DB_USERNAME, DB_PASSWORD);
			$this->jogo = new Jogo();
		}
		
		
		public function pegarEstadio($id=0){
			$this->conexao->conectar();
			$estadio = new Estadio();
			$fk = ($id) ? $id : $this->time->fkestadio;
			$estadios = $estadio->fabricarObjetos($this->conexao->select('estadio', '*', "idestadio = $fk limit 1"));
			$this->conexao->desconectar();	
			return $estadios[0];
		}
		
			public function pegarArbitro($id=0){
			$this->conexao->conectar();
			$arbitro = new Arbitro();
			$fk = ($id) ? $id : $this->time->fkarbitro;
			$arbitros = $arbitro->fabricarObjetos($this->conexao->select('arbitro', '*', "idarbitro = $fk limit 1"));
			$this->conexao->desconectar();	
			return $arbitros[0];
		}
		
		
		public function todosEstadios(){
			$this->conexao->conectar();
			$estadio = new Estadio();
			$estadios = $estadio->fabricarObjetos($this->conexao->select('estadio', '*', 'idestadio > 0'));
			$this->conexao->desconectar();
			return $estadios;	
		}
		
		public function todosTimes(){
			$this->conexao->conectar();
			$time = new Time();
			$times = $time->fabricarObjetos($this->conexao->select('time', '*', 'idtime > 0'));
			$this->conexao->desconectar();
			return $times;
		}
		
		public function todosArbitros(){
			$this->conexao->conectar();
			$arbitro = new Arbitro();
			$arbitros = $arbitro->fabricarObjetos($this->conexao->select('arbitro', '*', 'idarbitro > 0'));
			$this->conexao->desconectar();
			return $arbitros;
		}
		
		
		
		
		public function pegarTime1($id=0){
			$this->conexao->conectar();
			$time = new Time();
			$fk = ($id) ? $id : $this->jogo->fktime1;
			$times = $time->fabricarObjetos($this->conexao->select('time', '*', "idtime = $fk limit 1"));
			$this->conexao->desconectar();	
			return $times[0];
		}
		
		public function pegarTime2($id=0){
			$this->conexao->conectar();
			$time = new Time();
			$fk = ($id) ? $id : $this->jogo->fktime2;
			$times = $time->fabricarObjetos($this->conexao->select('time', '*', "idtime = $fk limit 1"));
			$this->conexao->desconectar();	
			return $times[0];
		}
		
		
		
		public function index(){
			$busca =  "idjogo > 0";
			if(isset($_POST['busca'])){
				// $valor = test_input($_POST['busca']);
				// $busca = "nome LIKE '$valor%' ORDER BY nome";			
			}
			$this->conexao->conectar();
			$ret = $this->jogo->fabricarObjetos($this->conexao->select('jogo', '*', $busca));
			$this->conexao->desconectar();
			if(count($ret) == 0){
				return null;
			}
			return $ret;
			
		}
		
		public function novo(){
			$this->jogo = new Jogo();
		}
		
		public function mostrar(){
			$this->filtrar();
			return $this->jogo;
		}
		
		public function salvar($post){
				$fktime1 = $post['fktime1'];
				$fktime2 = $post['fktime2'];
				$gols_time1 = $post['gols1'];
				$gols_time2 = $post['gols2'];
				$fkestadio = $post['fkestadio'];
				$fkarbitro = $post['fkarbitro'];
				$jogo = new Jogo(0, test_input($fktime1), test_input($fktime2), test_input($gols_time1), test_input($gols_time2),
					test_input($fkestadio), test_input($fkarbitro));
				$this->conexao->conectar();
				$ret = $this->conexao->insert($jogo);
				$this->conexao->desconectar();
				$this->jogo = $jogo;
				return $ret;
		}
		
		public function editar(){			
			 	$this->filtrar();
				return $this->jogo;
		}
		
		public function atualizar($post){
			    $id = $post['num'];
				$fktime1 = $post['fktime1'];
				$fktime2 = $post['fktime2'];
				$gols_time1 = $post['gols1'];
				$gols_time2 = $post['gols2'];
				$fkestadio = $post['fkestadio'];
				$fkarbitro = $post['fkarbitro'];
				$jogo = new Jogo(test_input($id), test_input($fktime1), test_input($fktime2), test_input($gols_time1), test_input($gols_time2),
					test_input($fkestadio), test_input($fkarbitro));   
				$this->conexao->conectar();
				$status = $this->conexao->update($this->jogo);
				$this->conexao->desconectar();
				return $status;
			
		}
		
		public function apagar($post){
			$id = $post['num'];
			$id = test_input($id);
			$this->jogo->id = $id;
			$this->conexao->conectar();
			$ret = $this->conexao->delete($this->jogo);
			$this->conexao->desconectar();
			return $ret;
		}
		
		
		// TODO arrumar venerabilidade SQL-Injection
		public function filtrar(){
			$id = $this->jogo->id;
			if(isset($_GET['num'])){
				$id = test_input($_GET['num']);
			}		
			$this->conexao->conectar();
			$ret = $this->jogo->fabricarObjetos($this->conexao->select('jogo', '*', "idjogo = $id limit 1"));
			$this->conexao->desconectar();
			if(count($ret) == 0){
				$this->jogo = null;
			}else
				$this->jogo = $ret[0];
		}
		
		
		
		
	}
	


 ?>