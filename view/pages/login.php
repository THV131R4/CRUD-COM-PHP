 <?php
	session_start();
?> 
<html>
	<head>
		<meta charset="utf-8">
		<title>Login</title>
		<link href="../css/bootstrap4/css/bootstrap.min.css" rel="stylesheet">	
	</head>
	<body>
		<div id="conteudo">
			<div id="cardLogin">
				<form action="../../controller/ctr_login.php" method="POST" id="formulario" onsubmit="validarFormulario(); return false;">
					<fieldset>

					<!-- Form Name -->
					<legend>Teste TEL - Thiago Vieira</legend>

					<!-- Text input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="email">Email</label>  
					  <div class="col-md-4">
					  <input id="email" name="email" type="text" placeholder="Email" class="form-control input-md" onkeypress="esconderDivAlerta()">
					   
					  </div>
					</div>

					<!-- Password input-->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="senha">Senha</label>
					  <div class="col-md-4">
					    <input id="senha" name="senha" type="password" placeholder="Senha" class="form-control input-md" onkeypress="esconderDivAlerta()">
					    
					  </div>
					</div>

					<!-- Button -->
					<div class="form-group">
					  <label class="col-md-4 control-label" for="btnAcessar"></label>
					  <div class="col-md-4">
					    <button id="btnAcessar" name="btnAcessar" class="btn btn-primary">Entrar</button>
					  </div>
					</div>

					</fieldset>
					</form>

				<!-- <form action="../../controller/ctr_login.php" method="POST" id="formulario" onsubmit="validarFormulario(); return false;">
			        <label class="labelPgLogin" for="email">EMAIL </label>
			        <input type="text" id="email" class="inputPgLogin" name="email" title="Preencha seu usuário aqui" onkeypress="esconderDivAlerta()">
			        <br>
			    	<label class="labelPgLogin" for="senha">SENHA</label>
			        <input type="password" id="senha" class="inputPgLogin" name="senha" title="Preencha sua senha aqui" onkeypress="esconderDivAlerta()">
			        <br>
			        <input id="btnAcessar" type="submit" value="Acessar" >
			    </form> -->
			</div>
			<div id="alertaErro">
				<?php
		            if(isset($_SESSION['nao_autenticado'])){
		            	echo '<div id="alertaLoginIncorreto">
		                  <p>Email ou senha inválidos.</p>
		                </div>';
		            }
		            unset($_SESSION['nao_autenticado']);
		        ?>
	    	</div>
		</div>
		<script type="text/javascript" src="../js/jquery-3.1.1.min.js"></script>
		<script type="text/javascript" src="../js/backend/login.js"></script>
		
	</body>
</html>