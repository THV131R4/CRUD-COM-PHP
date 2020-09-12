<?php
	include('../class/class_usuario.php');
	session_start();
	  
	$usuario = new Usuario();
	$usuario->setEmail($_POST['email']);
	$usuario->setSenha(md5($_POST['senha']));
	$usuario->verificarLogin();	
?>