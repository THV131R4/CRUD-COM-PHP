<?php 
	include_once ('../../class/class_usuario.php');//classe usuario
	if(isset($_GET['idUsuario'])){
		$usuario = new Usuario($_GET['idUsuario']);
		$linha = $usuario->preencherCamposModificacao();	
	}	
?>