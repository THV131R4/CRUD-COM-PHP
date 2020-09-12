<?php
    include_once ('../class/class_usuario.php');
    //ini_set( 'display_errors', 0 );
    if(isset($_POST['idUsuario']) && $_POST['delete'] == true ){
        $usuario = new Usuario($_POST['idUsuario']);
        $usuario->excluir();
    } else {
        $usuario = new Usuario();
        $usuario->listar();  
    }        
?>