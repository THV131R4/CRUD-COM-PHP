<?php

$db=new BD();
	class BD{
		protected $conexao;	
		private $dbms,//nome do dbms
				$nomeBanco, //nome do banco
				$host,
				$usuario,
				$senha,
				$dsn, 
				$query;


		public function __construct(
				$dbms      = "",
				$nomeBanco = "", //nome do banco
				$host      = "",
				$usuario   = "",
				$senha     = "",
				$dsn       = "",
				$query     = ""
		){
				// $this->dbms  	 = 'mysql';//nome do dbms
				// $this->nomeBanco = 'proj1';//nome do banco
				// $this->host 	 = '127.0.0.1';
				// $this->usuario   = 'root';
				// $this->senha     = '';
				// $this->dsn 		 = sprintf('%s:host=%s;dbname=%s', $this->dbms, $this->host, $this->nomeBanco);
				// //$this->dsn 		 = $this->dbms.':dbname='.$this->nomeBanco.';host='.$this->host;
				// $this->query 	 = $query;
				$this->dbms  	 = $dbms;//nome do dbms
				$this->nomeBanco = $nomeBanco;//nome do banco
				$this->host 	 = $host;
				$this->usuario   = $usuario;
				$this->senha     = $senha;
				$this->dsn 		 = $dsn;
				//$this->dsn 		 = $this->dbms.':dbname='.$this->nomeBanco.';host='.$this->host;
				$this->query 	 = $query;
				
				$this->conectar();
		}

		public function conectar(){
			try {
			    $this->conexao   = new PDO($this->dsn, $this->usuario, $this->senha);
				$this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			    echo "Conectado ao banco!<br>";
			} catch (PDOException $erro) {
			    echo 'Erro ao conectar banco de dados!';
			    echo 'Erro na conexao: ' . $erro->getMessage();
			}
		}

		 public function __sleep()
		    {
		    	$this->dbms  	 = 'mysql';//nome do dbms
				$this->nomeBanco = 'proj1';//nome do banco
				$this->host 	 = '127.0.0.1';
				$usuario   = 'root';
				$senha     = '';
				$dsn 		 = sprintf('%s:host=%s;dbname=%s', $this->dbms, $this->host, $this->nomeBanco);
				//$this->dsn 		 = $this->dbms.':dbname='.$this->nomeBanco.';host='.$this->host;
				$this->query 	 = $query;
				return array($dsn, $usuario, $senha);
		    }
		    
		    public function __wakeup()
		    {
		        $this->conectar();
		    }

		public function setQuery($query){
			$this->query = $query;
		}

		public function getQuery(){
			return $this->query;
		}

		public function executar(){
			//echo "EXECUTANDO ESTA QUERY: ".$this->getQuery()."<br>";
			//echo (empty($this->getQuery()) ? "QUERY VAZIA!<br>" : "QUERY PREENCHIDA!<br>");
			$stmt = $this->conexao->prepare($this->getQuery());
			if ($stmt->execute()){
				return $stmt;//retorno query
				//echo "Procedimento feito com sucesso!";
			} else {
				echo "Procedimento com erros!";
				//print_r($this->conexao->errorInfo());
			}
		}		

		public function desconectar(){//desconectar banco
			$this->conexao = NULL;
		}
	}	  
?>
	  


