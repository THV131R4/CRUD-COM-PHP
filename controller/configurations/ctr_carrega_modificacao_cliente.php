<?php 
	include_once ('../../class/class_cliente.php');//classe cliente
	if(isset($_GET['idCliente'])){
		$cliente = new Cliente($_GET['idCliente']);
		$linha = $cliente->preencherCamposModificacao();	
	}	
?>