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
    		echo "erro $e";
		}		
	}
	
	public function iniciarConexaoDefault(){
		$this->iniciarConexao(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	}
	
	
	public function desconectar(){
		$this->conn = null;
	}
	
	
    public function insert($dados) {
    	$tabela = $dados['tabela'];
		unset($dados['tabela']);
        foreach ($dados as $key => $value) {
            $keys[] = $key;
            $insertvalues[] = '\'' . $value . '\'';
        }
        $keys = implode(',', $keys);
        $insertvalues = implode(',', $insertvalues);
        $sql = "INSERT INTO $tabela ($keys) VALUES ($insertvalues)";
		return $this->conn->exec($sql);
        
    }
	
	
    public function update($dados, $colunaPrimay, $valor) {
    	$tabela = $dados['tabela'];
		unset($dados['tabela']);
        foreach ($dados as $key => $value) {
            $sets[] = $key . '=\'' . $value . '\'';
        }
        $sets = implode(',', $sets);
        $sql = "UPDATE $tabela SET $sets WHERE $colunaPrimay = '$valor'";
        return $this->conn->exec($sql); 
    }
	
	   
    public function select($tabela, $colunas = "*", $where = " ") {
        $sql = "SELECT $colunas FROM $tabela WHERE $where ;";
        $stmt = $this->conn->prepare($sql); 
        $stmt->execute();
    	$stmt->setFetchMode(PDO::FETCH_ASSOC);
		return $stmt;
    }
	
	public function delete($dados){
		 $tabela = $dados['tabela'];
		 $id = $dados["id$tabela"];
		 $sql = "DELETE FROM $tabela WHERE id$tabela=$id";
	     return $this->conn->exec($sql);
	}
	
	
}

	

 ?>