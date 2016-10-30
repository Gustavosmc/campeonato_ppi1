<?php 
	
	//Variáveis de acesso Db
	define('DB_SERVER', 'localhost');
	define('DB_NAME', 'futebol');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', 'root');
	

class Conexao {
	public $db;
	public $conn;
    public function __construct($server, $database, $username, $password){
    	  $this->iniciarConexao($server, $username, $password, $database);
    }

	/**
	 * inicia uma conexão usando os dados passados no parâmetro
	 */
    function iniciarConexao($servidor, $usuario, $senha, $banco){
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
		 	print $e;
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
			print $e;
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
			print $e;
			return null;
		}
    }
	
	
	
	
}

	

 ?>