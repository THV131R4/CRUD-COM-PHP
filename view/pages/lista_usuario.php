<?php
    require_once('menu.php');
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Consultar usuários</title>
        <script src="../js/backend/usuario.js"></script>
    </head>

    <body onload="buscarUsuarios()">
        <div class="col-sm-9 col-sm-offset-1">
            <div class="span7"> 
            <form  method='post'>
                <h4>Lista de usuários</h4>
                
                <div class="form-group">
                    <b>Filtrar por:</b>
                    <label class="col-md-4 control-label" for="vlpesquisa"></label>
                    <div class="col-md-4"> 
                        <label class="radio-inline" for="vlpesquisa-0">
                            <input type="radio" name="vlpesquisa" id="vlpesquisa-0" value="1" checked="checked">Código
                        </label> 
                        <label class="radio-inline" for="vlpesquisa-1">
                          <input type="radio" name="vlpesquisa" id="vlpesquisa-1" value="2">
                          Nome
                        </label> 
                        <label class="radio-inline" for="vlpesquisa-2">
                          <input type="radio" name="vlpesquisa" id="vlpesquisa-2" value="3">
                          Email
                        </label>
                    </div>
                    <input id="textoPesquisa" class="col-md-7" placeholder="Pesquisar usuario..." type='text' onkeyup="pesquisar()"/> 
                </div>

                 
                <div class="widget stacked widget-table action-table">
                    
                    <div class="widget-header">
                        <i class="icon-th-list"></i>
                        
                    </div> <!-- /widget-header -->
                
                    <div class="widget-content">    
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Código</th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th class="td-actions">Opções</th>
                                </tr>
                            </thead>
                            <tbody id="lista">
                            
                            </tbody>
                        </table>
                    </div> <!-- /widget-content -->
                </div><!-- /span7 -->
            </div>   

        </form>
    </div>
</div>
    </body>
</html>