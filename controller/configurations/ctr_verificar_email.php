<?php
	include_once ('../class/class_usuario.php');//classe usuario
	
	$usuario = new Usuario();
	$usuario->setEmail($_POST['email']);
	$usuario->verificarEmailExistente();
?>
