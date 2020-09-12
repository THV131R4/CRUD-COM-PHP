<?php
	require_once('class_bd.php');
	
	class Cliente {
		public $db,
			   $idCliente,
		 	   $nome,
			   $cpf,
			   $rg,
			   $dataCadastro,
			   $dataModificacao,
			   $usuarioCadastro,
			   $usuarioModificacao,
			   $dataNascimento,
			   $telefone,
			   $localNascimento;


		public function __construct($idCliente="", 
			    $nome="",
			    $cpf="",
			    $rg="",
			    $dataCadastro="",
			   	$dataModificacao="",
			   	$usuarioCadastro="",
			   	$usuarioModificacao="",
			   	$dataNascimento="",
			   	$telefone="",
			   	$localNascimento=""
		){//abre o construtor da classe Cliente
				$this->bd = new BD(); //cria objeto bd da classe BD para conectar ao banco
            	$this->idCliente = $idCliente; 
            	$this->nome = $nome; 
            	$this->cpf = $cpf; 
            	$this->rg = $rg;
            	$this->dataCadastro=$dataCadastro;
				$this->dataModificacao=$dataModificacao;
				$this->usuarioCadastro=$usuarioCadastro;
				$this->usuarioModificacao=$usuarioModificacao;
				$this->dataNascimento=$dataNascimento;
				$this->telefone=$telefone;
				$this->localNascimento=$localNascimento; 

		}//fecha construtor 

		function getId() { 
			return $this->idCliente; 
		}

		function setId($idCliente) {
			$this->idCliente = $idCliente; 
		} 

		function getNome() { 
			return $this->nome; 
		}

		function setNome($nome) {
			$this->nome = $nome; 
		} 
		
		function getCpf() { 
			return $this->cpf; 
		}
		
		function setCpf($cpf) { 
			$this->cpf = $cpf; 
		}
		
		function getRg() { 
			return $this->rg; 
		}
		
		function setRg($rg) { 
			$this->rg = $rg; 
		}


		function getDataCadastro() {
		    return $this->dataCadastro;
		}

		function setDataCadastro($dataCadastro) {
		    $this->dataCadastro = $dataCadastro;
		}

		function getDataModificacao() {
		    return $this->dataModificacao;
		}

		function setDataModificacao($dataModificacao) {
		    $this->dataModificacao = $dataModificacao;
		}

		function getUsuarioCadastro() {
		    return $this->usuarioCadastro;
		}

		function setUsuarioCadastro($usuarioCadastro) {
		    $this->usuarioCadastro = $usuarioCadastro;
		}

		function getUsuarioModificacao() {
		    return $this->usuarioModificacao;
		}

		function setUsuarioModificacao($usuarioModificacao) {
		    $this->usuarioModificacao = $usuarioModificacao;
		}

		function getDataNascimento() {
		    return $this->dataNascimento;
		}

		function setDataNascimento($dataNascimento) {
		    $this->dataNascimento = $dataNascimento;
		}

		function getTelefone() {
		    return $this->telefone;
		}

		function setTelefone($telefone) {
		    $this->telefone = $telefone;
		}

		function getLocalNascimento() {
		    return $this->localNascimento;
		}

		function setLocalNascimento($localNascimento) {
		    $this->localNascimento = $localNascimento;
		}

			
		public function cadastrar() {
			$query = "
						INSERT INTO cliente (
							nome, 
							cpf, 
							rg,
							data_cadastro,
							data_modificacao,
							usuario_cadastro,	
							usuario_modificacao,
							data_nascimento,
							telefone,
							local_nascimento
						) 
						VALUES (							 
							'".addslashes($this->nome)."', 
							'".addslashes($this->cpf)."', 
							'".addslashes($this->rg)."',
							'".addslashes($this->dataCadastro)."',
							'".addslashes($this->dataModificacao)."',
							'".addslashes($this->usuarioCadastro)."',
							'".addslashes($this->usuarioModificacao)."',
							'".addslashes($this->dataNascimento)."',
							'".addslashes($this->telefone)."',
							'".addslashes($this->localNascimento)."'
						);	
			";
			$this->bd->query($query);
		}//fecha cadastrar

 
		public function modificar() {	
			$query = "
					UPDATE  cliente 
					SET
						nome = '".addslashes($this->nome)."', 
						cpf ='".addslashes($this->cpf)."', 
						rg ='".addslashes($this->rg)."',
						data_modificacao ='".addslashes($this->dataModificacao)."',
						usuario_modificacao ='".addslashes($this->usuarioModificacao)."',;
						data_nascimento ='".addslashes($this->dataNascimento)."',
						telefone ='".addslashes($this->telefone)."',
						local_nascimento ='".addslashes($this->localNascimento)."'
					WHERE  
						id_cliente ='".$this->idCliente."'
					;
			";//fecha $query	
		
			//echo($query);
			$this->bd->query($query);
			//header("Location: page.php");
		}//fecha modificar

	
	   public function excluir() {
	   		$query = "
	   			UPDATE cliente
	   			SET excluido = 1
	   			WHERE id_cliente='".$this->idCliente."';
	   		";
			$this->bd->query($query);
		}//fecha excluir


		public function listar(){
			$query = "
				SELECT id_cliente, 
						nome, 
						cpf, 
						rg,
						data_cadastro,
						data_modificacao,
						usuario_cadastro,	
						usuario_modificacao,
						data_nascimento,
						telefone,
						local_nascimento 
				FROM cliente;
			";
			$clientes = $this->bd->query($query);  
	        $json = '
	            {"cliente":[
	        ';

	        while ($linha = $clientes->fetch(PDO::FETCH_ASSOC)) {
	            $json .= '  {"idCliente":"' . $linha['id_cliente'] . '",
					"nome":"' . $linha['nome'] . '", 
					"cpf":"' . $linha['cpf'] . '", 
					"rg":"' . $linha['rg'] . '",
					"data_modificacao":"' . $linha['dataModificacao'] . '",
					"usuario_modificacao":"' . $linha['usuarioModificacao'] . '",;
					"data_nascimento":"' . $linha['dataNascimento'] . '",
					"telefone":"' . $linha['telefone'] . '",
					"local_nascimento":"' . $linha['localNascimento'] . '" 
	            },';
	        }// FECHA while    

	        $json = substr($json, 1, -1);
	        $json .= "]}";//fecha json
	        echo $json; 
		}
		

		public function preencherCamposModificacao(){
			if($this->idCliente != ''){ 
			    $query = "
			                SELECT id_cliente, 
			                	nome, 
								cpf, 
								rg,
								data_modificacao,	
								usuario_modificacao,
								data_nascimento,
								telefone,
								local_nascimento 
							FROM cliente 
			                WHERE id_cliente=" . $this->idCliente . ";
			        "; //fecha $query 
			    $dados = $this->bd->query($query);
			    $linha = $dados==''?'':$dados->fetch(PDO::FETCH_ASSOC);  
			    return $linha;
			}	
		}
	}//fecha a classe		
?>
