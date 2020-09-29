<?php
	class BD{	
		private $sgdb,//nome do sgdb
				$nomeBanco, //nome do banco
				$host,
				$usuario,
				$senha,
				$conexao,
				$dsn, 
				$query;


		public function __construct(
				$sgdb      = "",
				$nomeBanco = "", //nome do banco
				$host      = "",
				$usuario   = "",
				$senha     = "",
				$conexao   = "",
				$dsn       = "",
				$query     = ""
		){
				$this->sgdb  	 = 'mysql';//nome do sgdb
				$this->nomeBanco = 'proj1';//nome do banco
				$this->host 	 = '127.0.0.1';
				$this->usuario   = 'root';
				$this->senha     = '';
				$this->dsn 		 = $this->sgdb.':dbname='.$this->nomeBanco.';host='.$this->host;
				$this->query 	 = $query;
			try {
			    $this->conexao   = new PDO($this->dsn, $this->usuario, $this->senha);
				$this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			    //echo "Conectado ao banco!<br>";
			} catch (PDOException $erro) {
			    echo 'Erro ao conectar banco de dados!';
			    //echo 'Erro na conexao: ' . $erro->getMessage();
			}
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
