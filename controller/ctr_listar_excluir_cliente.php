<?php
    include_once ('../class/class_cliente.php');

    if(isset($_POST['idCliente']) && $_POST['delete'] == true ){
        $cliente = new Cliente($_POST['idCliente']);
        $cliente->excluir();
    } else {
        $cliente = new Cliente();
        $cliente->listar();  
    }        
?>