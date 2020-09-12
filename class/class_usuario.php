<?php
	require_once('class_bd.php');
	
	class Usuario {
		public $db,
			   $idUsuario,
		 	   $nome,
			   $email,
			   $senha;

		public function __construct($idUsuario="", 
			    $nome="",
			    $email="",
			    $senha=""
		){//abre o construtor da classe Usuario
				$this->bd = new BD(); //cria objeto bd da classe BD para conectar ao banco
            	$this->idUsuario = $idUsuario; 
            	$this->nome = $nome; 
            	$this->email = $email; 
            	$this->senha = $senha; 

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

			
		public function cadastrar() {
			$query = "
						INSERT INTO usuario (
							nome, 
							email, 
							senha
						) 
						VALUES (							 
							'".addslashes($this->nome)."', 
							'".addslashes($this->email)."', 
							'".addslashes($this->senha)."'
						);	
			";
			$this->bd->query($query);
		}//fecha cadastrar

 
		public function modificar() {
			if($this->senha==''){
				$query = "
						UPDATE  usuario 
						SET
							nome =  '".$this->nome."',
							email = '".$this->email."'				
						WHERE  
							id_usuario ='".$this->idUsuario."'
						;
				";//fecha $query	
			} else {
				$query = "
						UPDATE  usuario 
						SET
							nome =  '".$this->nome."',
							email = '".$this->email."',	 
							senha = '".$this->senha."'				
						WHERE  
							id_usuario ='".$this->idUsuario."'
						;
				";//fecha $query
			}
			//echo($query);
			$this->bd->query($query);
			//header("Location: page.php");
		}//fecha modificar

	
	   public function excluir() {
	   		$query = "
	   			UPDATE usuario
	   			SET excluido = 1
	   			WHERE id_usuario='".$this->idUsuario."';
	   		";
			$this->bd->query($query);
		}//fecha excluir


		public function listar(){
			$query = "
				SELECT id_usuario, nome, email, senha 
				FROM usuario
				WHERE usuario.excluido IS NULL;
			";
			$usuarios = $this->bd->query($query);  
	        $json = '
	            {"usuario":[
	        ';

	        while ($linha = $usuarios->fetch(PDO::FETCH_ASSOC)) {
	            $json .= '  {"idUsuario":"' . $linha['id_usuario'] . '",
	                            "nome":"' . $linha['nome'] . '",

	                            "email":"' . $linha['email'] . '"
	            },';
	        }// FECHA while    

	        $json = substr($json, 1, -1);
	        $json .= "]}";//fecha json
	        echo $json; 
		}


		
		public function verificarLogin(){
			if($this->email==='' || $this->senha=='') {
				header('Location: ../../view/pages/login.php');
				exit();
			} else {
				$query = "
					SELECT usuario.id_usuario
					FROM usuario 
					WHERE usuario.email LIKE trim('".$this->email."') 
					AND usuario.senha = '".$this->senha."'
					AND usuario.excluido IS NULL;
				";
				$dados = $this->bd->query($query);
				$idUsuario = $dados->fetch(PDO::FETCH_ASSOC);
				if($idUsuario>0) {
					$_SESSION['usuario'] = $usuario;
					header('Location: ../view/pages/index.php');
					exit();
				} else {
					$_SESSION['nao_autenticado'] = true;
					header('Location: ../view/pages/login.php');
					exit();
				}	
			}
		}

		public function preencherCamposModificacao(){
			if($this->idUsuario != ''){ 
			    $query = "
			                SELECT id_usuario, nome, email FROM usuario 
			                WHERE id_usuario=" . $this->idUsuario . ";
			        "; //fecha $query 
			    $dados = $this->bd->query($query);
			    $linha = $dados==''?'':$dados->fetch(PDO::FETCH_ASSOC);  
			    return $linha;
			}	
		}
		
		  

	}//fecha a classe		
?>
