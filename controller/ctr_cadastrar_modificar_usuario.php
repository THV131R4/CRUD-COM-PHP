<?php
	include_once ('../class/class_usuario.php');//classe usuario
	$usuario = new Usuario();
	$usuario->setId($_POST['idUsuario']);
	$usuario->setNome($_POST['nome']);
	$usuario->setEmail($_POST['email']);
	$usuario->setSenha(md5($_POST['senha']));
	if($_POST['idUsuario']==''){
		$usuario->cadastrar();	
	} else {
		$usuario->modificar();
	}
?>
