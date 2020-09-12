<?php
    include_once ('../class/class_usuario.php');

    if(isset($_POST['idUsuario']) && $_POST['delete'] == true ){
        $usuario = new Usuario($_POST['idUsuario']);
        $usuario->excluir();
    } else {
        $usuario = new Usuario();
        $usuario->listar();  
    }        
?>