<?php
define('DB_HOST'        , "localhost");
define('DB_USER'        , "sa");
define('DB_PASSWORD'    , "devmedia");
define('DB_NAME'        , "devmedia");
define('DB_DRIVER'      , "sqlsrv");

require_once "class_bd.php";

try{

    $Conexao    = Conexao::getConnection();
    $query      = $Conexao->query("SELECT nome, preco, quantidade FROM produto");
    $produtos   = $query->fetchAll();

 }catch(Exception $e){

    echo $e->getMessage();
    exit;

 }

?>
<!DOCTYPE html>
<html>
<head>
  <title>Conexão PDO SQL Server</title>
</head>
<body>
  <form>
        <table border=1>
            <tr>
               <td>Nome</td>
               <td>Preço</td>
               <td>Quantidade</td>
            </tr>
            <?php
               foreach($produtos as $produto) {
            ?>
            <tr>
                <td><?php echo $produto['nome']; ?></td>
                <td>R$ <?php echo $produto['preco']; ?></td>
                <td><?php echo $produto['quantidade']; ?></td>
            </tr>
            <?php
               }
            ?>
        </table>
    </form>
</body>
</html>