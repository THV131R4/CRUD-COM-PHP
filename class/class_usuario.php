<?php
	require_once('class_bd.php');
	
	class Usuario{
		private $db,
			    $idUsuario,
		 	    $nome,
			    $email,
			    $senha,
			    $resultSet;

		public function __construct(
				$idUsuario = "", 
			    $nome      = "",
			    $email     = "",
			    $senha     = "",
			    $resultSet = ""
		){//abre o construtor da classe Usuario
				$this->bd        = new BD(); //conectar ao banco
            	$this->idUsuario = preg_replace('/[^[:alpha:]_]/', '',$idUsuario); 
            	$this->nome      = preg_replace('/[^[:alpha:]_]/', '',$senha); 
            	$this->email     = $email; 
            	$this->senha     = preg_replace('/[^[:alnum:]_]/', '',$senha); 
            	$this->resultSet = $resultSet; 

		}//fecha construtor 

		function getId() { 
			return $this->idUsuario; 
		}

		function setId($idUsuario) {
			$this->idUsuario = $idUsuario; 
		} 

		function getNome() { 
			return $this->nome; 
		}

		function setNome($nome) {
			$this->nome = $nome; 
		} 
		
		function getEmail() { 
			return $this->email; 
		}
		
		function setEmail($email) { 
			$this->email = $email; 
		}
		
		function getSenha() { 
			return $this->senha; 
		}
		
		function setSenha($senha) { 
			$this->senha = $senha; 
		}

		function getResultSet() { 
			return $this->resultSet; 
		}
		
		function setResultSet($resultSet) { 
			$this->resultSet = $resultSet; 
		}
			
		public function cadastrar(){
			$this->bd->setQuery("
				INSERT INTO usuario (
					nome, 
					email, 
					senha
				) 
				VALUES (							 
					'".addslashes($this->getNome())."', 
					'".addslashes($this->getEmail())."', 
					'".addslashes($this->getSenha())."'
				);	
			");
			$this->bd->executar();
		}//fecha cadastrar

 
		public function modificar(){
			if($this->getSenha()==''){
				$this->bd->setQuery("
					UPDATE  usuario 
					SET
						nome =  '".addslashes($this->getNome())."',
						email = '".addslashes($this->getEmail())."'				
					WHERE  
						id_usuario ='".$this->getId()."'
					;
				");	
			} else {
				$this->bd->setQuery("
					UPDATE  usuario 
					SET
						nome =  '".addslashes($this->getNome())."',
						email = '".addslashes($this->getEmail())."',	 
						senha = '".addslashes($this->getSenha())."'				
					WHERE  
						id_usuario ='".$this->getId()."'
					;
				");
			}

			$this->bd->executar();
		}//fecha modificar

	
	   public function excluir(){
	   		$this->bd->setQuery("
	   			UPDATE usuario
	   			SET excluido = 1
	   			WHERE id_usuario='".$this->getId()."';
	   		");

			$this->bd->executar();
		}//fecha excluir


		public function listar(){
			$this->bd->setQuery("
				SELECT id_usuario, nome, email, senha 
				FROM usuario
				WHERE usuario.excluido IS NULL;
			");
			
			$this->setResultSet($this->bd->executar());  
	        $jsonUsuarios = '{"usuario":[';

	        while ($tupla = $this->getResultSet()->fetch(PDO::FETCH_ASSOC)) {
	            $jsonUsuarios .= '{ "idUsuario":"'.$tupla['id_usuario'].'",
	                                "nome":"'	  .$tupla['nome'].'",
	                            	"email":"'    .$tupla['email'].'"
	            },';
	        }// FECHA while    

	        $jsonUsuarios = substr($jsonUsuarios, 0, -1);
	        $jsonUsuarios .= "]}";//fecha jsonUsuarios
	        echo $jsonUsuarios; 
		}

		
		public function verificarLogin(){
			if($this->getEmail()==='' || $this->getSenha()=='') {
				header('Location: ../../view/pages/login.php');
				exit();
			} else {
				$this->bd->setQuery("
					SELECT usuario.id_usuario
					FROM usuario 
					WHERE usuario.email LIKE trim('".$this->getEmail()."') 
					AND usuario.senha = '".$this->getSenha()."'
					AND usuario.excluido IS NULL;
				");
			
				$this->setResultSet($this->bd->executar());
			
				$idUsuario = $this->getResultSet()->fetch(PDO::FETCH_ASSOC);
				if($idUsuario>0) {
					$_SESSION['usuario'] = $usuario;
					header('Location: ../view/pages/lista_usuario.php');
					exit();
				} else {
					$_SESSION['nao_autenticado'] = true;
					header('Location: ../view/pages/login.php');
					exit();
				}	
			}
		}


		public function preencherCamposModificacao(){
			if($this->getId() != ''){ 
			    $this->bd->setQuery("
	                SELECT id_usuario, nome, email FROM usuario 
	                WHERE id_usuario=" . $this->getId() . ";
			    ");
			
			    $this->setResultSet($this->bd->executar());
			    $tupla = $this->getResultSet() == ''?'':$this->getResultSet()->fetch(PDO::FETCH_ASSOC);  
			    return $tupla;
			}	
		}
		
		  
		public function verificarEmailExistente(){
			$this->bd->setQuery("
					SELECT 1 
					FROM usuario 
					WHERE usuario.email LIKE trim('".$this->getEmail()."') AND 
					usuario.excluido IS NULL LIMIT 1;
			");
			
			$this->setResultSet($this->bd->executar());
			$resultSet = $resultSet->fetch(PDO::FETCH_ASSOC);
			echo $resultSet;
		}
	}//fecha a classe		
?>
