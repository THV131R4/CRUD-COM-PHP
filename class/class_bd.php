<?php
$db=new BD();
	class BD{	
		private $dbms,//nome do dbms
				$nomeBanco, //nome do banco
				$host,
				$usuario,
				$senha,
				$conexao,
				$dsn, 
				$query;


		public function __construct(
				$dbms      = "",
				$nomeBanco = "", //nome do banco
				$host      = "",
				$usuario   = "",
				$senha     = "",
				$conexao   = "",
				$dsn       = "",
				$query     = ""
		){
			$this->dbms  	 = 'mysql';//nome do dbms
			$this->nomeBanco = 'proj1';//nome do banco
			$this->host 	 = '127.0.0sds.1';
			$this->usuario   = 'root';
			$this->senha     = '';
			$this->dsn 		 = sprintf('%s:host=%s;dbname=%s', $this->dbms, $this->host, $this->nomeBanco);
			$this->query 	 = $query;
			$this->conectar();
		}

		public function conectar(){
			try {
			    $this->conexao   = new PDO($this->dsn, $this->usuario, $this->senha);
				$this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			    echo "Conectado ao banco!<br>";
			} catch (PDOException $erro){
			    echo 'Erro ao conectar banco de dados!<br>';
			    //echo 'Erro na conexao: ' . $erro->getMessage();
			} catch(Exception $erro){

			}
		}

		public function desconectar(){//desconectar banco
			$this->conexao = NULL;
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
	}	  
?>
