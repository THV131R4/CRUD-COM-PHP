<?php
  require_once('menu.php');
?>

<!DOCTYPE html>
<html>
    <head>        
        <title>Cadastrar/Modificar Clientes</title>
        <script src="../js/backend/cliente.js"></script>
    </head>
    <body>
        
          <div class="col-sm-9 col-sm-offset-1">  
            <form class="form-horizontal">
           
                <input type="hidden" class="color-inputs" name="idCliente" autofocus="" id="idCliente" value="<?php echo isset($linha['id_cliente'])?$linha['id_cliente']:''; ?>" /> 

                <input type="hidden" class="color-inputs" name="usuarioCadastro" autofocus="" id="usuarioCadastro" value="<?php echo isset($linha['usuario_cadastro'])?$linha['usuario_cadastro']:'0'; ?>" /> 

                 <input type="hidden" class="color-inputs" name="usuarioModificacao" autofocus="" id="usuarioModificacao" 
                 value="<?php 
                 echo 0;
                    //echo $_SESSION['idUsuario']; 
                 ?>" /> 

                <!-- Form Name -->
                <h4>Dados do cliente</h4>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="nome">Nome</label>  
                  <div class="col-md-7">
                    <input id="nome" name="nome" type="text" placeholder="Digite nome do cliente" class="form-control input-md" value="<?php echo isset($linha['nome'])?$linha['nome']:'asd'; ?>">
                  </div>
             
                  <label class="col-md-4 control-label" for="cpf">CPF</label>  
                  <div class="col-md-7">
                    <input id="cpf" name="cpf" type="number" max="99999999999" placeholder="Digite cpf do cliente" class="form-control input-md" value="<?php echo isset($linha['cpf'])?$linha['cpf']:''; ?>">
                  
                  </div>
             
                  <label class="col-md-4 control-label" for="RG">RG</label>  
                  <div class="col-md-7">
                    <input id="rg" name="RG" type="number" max="999999999" placeholder="Digite RG do cliente" class="form-control input-md" value="<?php echo isset($linha['RG'])?$linha['RG']:''; ?>">
                  
                  </div>
             
                  <label class="col-md-4 control-label" for="dataNascimento">Data de Nascimento</label>  
                  <div class="col-md-7">
                    <input id="dataNascimento" name="dataNascimento" type="date" placeholder="Digite dataNascimento do cliente" class="form-control input-md" value="<?php echo isset($linha['dataNascimento'])?$linha['dataNascimento']:''; ?>">

                  </div>
                

            <!--     <div class="form-group">
                  <label class="col-md-4 control-label" for="usuarioModificacao">Usuário que fez última modificação</label>  
                  <div class="col-md-7">
                    <input id="usuarioModificacao" name="usuarioModificacao" type="text" placeholder="Digite usuarioModificacao do cliente" class="form-control input-md" value="<?php //echo isset($linha['usuarioModificacao'])?$linha['usuarioModificacao']:''; ?>"> -->
                
                  <label class="col-md-4 control-label" for="telefone">Telefone (s):</label>  
                  <div class="col-md-7">
                    <input id="telefone" name="telefone" type="number" placeholder="Digite telefone do cliente" class="form-control input-md" value="<?php echo isset($linha['telefone'])?$linha['telefone']:''; ?>">                  
                  </div>

                  <label class="col-md-4 control-label" for="localNascimento">Local de Nascimento </label>  
                  <div class="col-md-7">
                    <input id="localNascimento" name="localNascimento" type="text" placeholder="Digite localNascimento do cliente" class="form-control input-md" value="<?php echo isset($linha['localNascimento'])?$linha['localNascimento']:''; ?>">                  
                  </div>
                
                  
                  <label class="col-md-4 control-label" for="dataCadastro">Data de cadastro</label>  
                  <div class="col-md-7">
                    <input readonly="" id="dataCadastro" name="dataCadastro" type="text" class="form-control input-md"  value="<?php echo isset($linha['dataCadastro'])?$linha['dataCadastro']:date('Y-m-d H:i:s'); ?>">
                  
                  </div>
             
                  <label class="col-md-4 control-label" for="localNascimento">Última modificação</label>  
                  <div class="col-md-7">
                    <input readonly="" id="dataModificacao" name="dataModificacao" type="text" placeholder="Digite dataModificacao do cliente" class="form-control input-md" value="<?php echo isset($linha['dataModificacao'])?$linha['dataModificacao']:date('Y-m-d H:i:s'); ?>">                  
                  </div>
                
                             
                <!-- Button -->
                  <label class="col-md-4 control-label" for="btnSalvar"></label>
                  <div class="col-md-4">
                    <button id="btnSalvar" name="btnSalvar" class="btn btn-primary" type="button" onclick="cad_mod_cliente();">Salvar</button>
                  </div>
                               
            </form>
      </div>
    </body>
</html>
