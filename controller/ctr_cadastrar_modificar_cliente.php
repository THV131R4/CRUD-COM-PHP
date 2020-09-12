<?php
	include_once ('../class/class_cliente.php');//classe cliente
	$cliente = new Cliente();
	$cliente->setId($_POST['idCliente']);
	$cliente->setNome($_POST['nome']);
	$cliente->setCpf($_POST['cpf']);
	$cliente->setRg($_POST['rg']);
	$cliente->setDataCadastro($_POST['dataCadastro']);
	$cliente->setDataModificacao($_POST['dataModificacao']);
	$cliente->setUsuarioCadastro($_POST['usuarioCadastro']);
	$cliente->setUsuarioModificacao($_POST['usuarioModificacao']);
	$cliente->setDataNascimento($_POST['dataNascimento']);
	$cliente->setLocalNascimento($_POST['localNascimento']);
	$cliente->setTelefone($_POST['telefone']);
	if($_POST['idCliente']==''){
		$cliente->cadastrar();	
	} else {
		$cliente->modificar();
	}
?>
