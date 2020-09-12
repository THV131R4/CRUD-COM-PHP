<?php
include_once ('../class/class_usuario.php');
require_once ('../class/class_bd.php');
ini_set( 'display_errors', 0 );
 
$id_usuario = $_POST['id_usuario'];

$query = "
            SELECT * FROM usuario WHERE id_usuario= '".$id_usuario."'; 
 ";//faz a consulta no banco de dados

$query = $bd->query($query);

$usuario = $query->fetch(PDO::FETCH_ASSOC);
$json = '{           
            "id_usuario":"' . $usuario['id_usuario'] . '",
            "nome":"' . $usuario['nome'] . '",
            "cnpj":"' . $usuario['cnpj'] . '",
            "cidade":"' . $usuario['cidade'] . '"';
    
        $json .= '}';//fecha json
        $listagem = $json; 
echo $listagem;  
 ?>