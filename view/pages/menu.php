<?php 
//  require_once('../../controller/configurations/ctr_verificar_login.php');
?>

<head>
  <meta charset="utf-8">
  <script src="../frameworks/bootstrap4/js/bootstrap.min.js"></script>
  <script src="../frameworks/jquery.js"></script>
  <link href="../css/menu.css" rel="stylesheet">
  <link href="../frameworks/bootstrap4/css/bootstrap.min.css" rel="stylesheet">
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
</head>

<body>
<div  class="container-fluid">
  <div class="row">
    <div class="col-sm-3">
      <div class="nav-side-menu">
        <div class="brand">Sistema Teste - Thiago Vieira</div>
        <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>
        <div class="menu-list">
          <ul id="menu-content" class="menu-content collapse out">
            <li onclick="location.href='cad_mod_usuario.php'">
              <i class="fa fa-pencil fa-lg"></i> Cadastro de Usuário
            </li>

            <li onclick="location.href='cad_mod_cliente.php'">
              <i class="fa fa-pencil fa-lg"></i> Cadastro de Cliente
            </li>
             
            <li onclick="location.href='lista_usuario.php'">
              <i class="fa fa-align-justify fa-lg"></i> Lista de Usuário
            </li>

            <li onclick="location.href='lista_cliente.php'">
              <i class="fa fa-align-justify fa-lg"></i> Lista de Cliente
            </li>

            <li onclick="location.href='logout.php'">
              <i class="fa fa-power-off fa-lg"></i> Sair do sistema
            </li>
           
          </ul>  
        </div>
      </div>
    </div>
  </div>
</div>

</body>
  