<?php 
	
	//Variáveis de acesso Db
	define('DB_SERVER', '0.0.0.0');
	define('DB_NAME', 'futebol');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', 'root');
	

class Conexao {
	public $db;
	public $conn;
	var $server, $username, $password, $database;
    public function __construct($server=null, $database=null, $username=null, $password=null){
    	  $this->server = $server;
		  $this->username = $username;
		  $this->password = $password;
		  $this->database = $database;
    }

	/**
	 * inicia uma conexão usando os dados passados no parâmetro
	 */
    private function iniciarConexao($servidor, $usuario, $senha, $banco){
		$conn = null;
		$dsn = 'mysql:host='.$servidor.';dbname='.$banco;
		try {
			$this->conn = new PDO($dsn, $usuario, $senha);		
    		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$this->conn->exec("set names utf8");
		} catch(PDOException $e) {
    		print "erro $e";
		}		
	}
	
	public function iniciarConexaoDefault(){
		$this->iniciarConexao(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
		$this->database = DB_NAME;
		$this->server = DB_SERVER;
		$this->password = DB_PASSWORD;
		$this->username = DB_USERNAME;
	}
	
	
	public function conectar(){
		$this->iniciarConexao($this->server, $this->username, $this->password, $this->database);
	}
	
	public function desconectar(){
		$this->conn = null;
	}
	
	
	// TODO arrumar bug inserção registro nula
	/**
	 * Atenção: Essa função modifica o id do objeto passado para o valor do objeto inserido no banco
	 */
    public function insert($objetoDao) {
    	try{
	    	$dados = $objetoDao->arrayPropriedades();
	    	$tabela = $dados['tabela'];
			unset($dados['tabela']);
	        foreach ($dados as $key => $value) {
	            $keys[] = $key;
	            $insertvalues[] = '\'' . $value . '\'';
	        }
	        $keys = implode(',', $keys);
	        $insertvalues = implode(',', $insertvalues);
	        $sql = "INSERT INTO $tabela ($keys) VALUES ($insertvalues)";
			$ret = $this->conn->exec($sql);
			$objetoDao->id = $this->conn->lastInsertId();
			return $ret;
		 }catch(Exception $e){
		 	return -1;		 	
		 }
    }
	
	
    public function update($objetoDao, $where='') {
    	try{
	    	$dados = $objetoDao->arrayPropriedades();
	    	$tabela = $dados['tabela'];
			$sql = '';
			unset($dados['tabela']);
	        foreach ($dados as $key => $value) {
	            $sets[] = $key . '=\'' . $value . '\'';
	        }
	        $sets = implode(',', $sets);
			if($where != ''){
				$sql = "UPDATE $tabela SET $sets WHERE $where";
			}else
				$id = $dados["id$tabela"];
				$sql = "UPDATE $tabela SET $sets WHERE id$tabela = $id";  
	        return $this->conn->exec($sql); 
		}catch(Exception $e){
			print $e;
			return -1;
			
		}
    }
	
	
	public function delete($objetoDao){
		try{
			 $dados = $objetoDao->arrayPropriedades();
			 $tabela = $dados['tabela'];
			 $id = $dados["id$tabela"];
			 $sql = "DELETE FROM $tabela WHERE id$tabela=$id";
		     return $this->conn->exec($sql);
		}catch(Exception $e){
			return -1;
		}
	}
	
	   
    public function select($tabela, $colunas = "*", $where = " ") {
    	try{
	        $sql = "SELECT $colunas FROM $tabela WHERE $where ;";
	        $stmt = $this->conn->prepare($sql); 
	        $stmt->execute();
	    	$stmt->setFetchMode(PDO::FETCH_ASSOC);
			return $stmt;
		}catch(Exception $e){
			return null;
		}
    }
	
	
	
	
}

	

 ?>