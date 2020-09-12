<?php
  require_once('menu.php');
  require_once('../../controller/configurations/ctr_carrega_modificacao_usuario.php');
?>

<!DOCTYPE html>
<html>
    <head>        
        <title>Cadastrar/Modificar Usuários</title>
        <script src="../js/backend/usuario.js"></script>
    </head>
    <body>
        
          <div class="col-sm-9 col-sm-offset-1">  
            <form class="form-horizontal">
           
                <input type="hidden" class="color-inputs" name="idUsuario" autofocus="" id="idUsuario" value="<?php echo isset($linha['id_usuario'])?$linha['id_usuario']:''; ?>" /> 

                <!-- Form Name -->
                <h4>Dados do usuário</h4>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="nome">Nome</label>  
                  <div class="col-md-7">
                    <input id="nome" name="nome" type="text" placeholder="Digite nome do usuário" class="form-control input-md" value="<?php echo isset($linha['nome'])?$linha['nome']:''; ?>">
                  
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="email">Email</label>  
                  <div class="col-md-7">
                    <input id="email" name="email" type="text" placeholder="Digite email do usuário" class="form-control input-md" value="<?php echo isset($linha['email'])?$linha['email']:''; ?>">
                    
                  </div>
                </div>

                <!-- Password input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="senha">Senha</label>
                  <div class="col-md-7">
                    <input id="senha" name="senha" type="password" placeholder="Digite senha" class="form-control input-md" value="<?php echo isset($linha['senha'])?$linha['senha']:''; ?>">
                    
                  </div>
                </div>

                <!-- Button -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="btnSalvar"></label>
                  <div class="col-md-4">
                    <button id="btnSalvar" name="btnSalvar" class="btn btn-primary" onclick="cad_mod_usuario();">Salvar</button>
                  </div>
                </div>               
            </form>
      </div>
    </body>
</html>
