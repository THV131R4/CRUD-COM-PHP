<?php
	//$bd = new BD();
	class BD{	
		 private $dsn = 'mysql:dbname=proj1;host=127.0.0.1',
				$user ='root',
				$password='',
				$conexao;

		public function __construct(){
			try {
			   $this->conexao = new PDO($this->dsn, $this->user, $this->password);
			  //echo "Conectado ao banco!<br>";
			} catch (PDOException $erro) {
			    echo 'Erro na conexao: ' . $erro->getMessage();
			}
		}

		public function query($query){
			echo "O metodo query esta rebendo a seguinte query: ".$query."<br>";
			//echo (empty($query) ? "query vazia!<br>" : "query ocupada!<br>");
			$query = $this->conexao->prepare($query);
			if ($query->execute()){
				return $query;//retorno query
				//echo "Procedimento feito com sucesso!";
			} else {
				//print_r($this->conexao->errorInfo());
			}
		}		
	
		public function desconectar(){//funçao para desconectar banco
			$this->conexao = NULL;
		}
	}	  
?>
