function cad_mod_usuario() {
    idUsuario = window.document.getElementById('idUsuario').value;
    nome = window.document.getElementById('nome').value;
    email = window.document.getElementById('email').value;
    senha = window.document.getElementById('senha').value;
   
    validarCampos (idUsuario, 
        nome,
        email,
        senha  
    );
}


function validarCampos(){

    if (nome ==='' || nome === undefined ){
        alert('Prencha o nome do usuario!');
        document.getElementById("nome").focus();
        return false;
    }
  
    else if (email ===''|| email === undefined){   
        alert("Prencha o email!");
        document.getElementById("email").focus();
        return false;
    } 

    else if ((senha ==='' || senha === undefined) && (idUsuario ==='' || idUsuario === undefined)){
        alert("Prencha a senha da usuario!");
        document.getElementById("senha").focus();
        return false;
    }

    else {        
        let novoUsuario = criaUsuario(idUsuario, nome, email, senha);
        let endereco = "../../controller/ctr_cadastrar_modificar_usuario.php";
        requisitarCadModUsuario(endereco, novoUsuario);
    }
}


function criaUsuario(pIdUsuario, pNome, pEmail, pSenha){
    return {
        idUsuario: pIdUsuario,
        nome : pNome,
        email: pEmail,
        senha: pSenha
    };
}


function requisitarCadModUsuario(endereco, dados){
    $.ajax({
        type: "POST",
        url: endereco,
        data: dados,
        success: function resposta(plainObject, textStatus, jqXHR) {
            //console.log(plainObject);
            alert('O procedimento foi um sucesso!');
            window.location.href = "../pages/lista_usuario.php";
        }
    });
};


function buscarUsuarios(){
    $.ajax({
        type: "POST",
        url: "../../controller/ctr_listar_excluir_usuario.php",
        success: function (plainObject) {
            console.log(plainObject);
            let json = JSON.parse(plainObject); 
            usuarios = json.usuario;
            listarUsuarios(usuarios);
        }
    });
}


function listarUsuarios(usuariosParaListar){
    let listagemUsuarios = "";
    for (let i = 0; i < usuariosParaListar.length; i++) { 
        let usuario = usuariosParaListar[i];    
        listagemUsuarios += '<tr>' ;
        listagemUsuarios += '<td >'+usuario.idUsuario+'</td>';
        listagemUsuarios += '<td >'+usuario.nome+'</td>';
        listagemUsuarios += '<td >'+usuario.email+'</td>';
        // listagemUsuarios += '<td >'+usuario.excluido+'</td>';
        listagemUsuarios += '<td class="td-actions">';                            
        listagemUsuarios += '<a href="../pages/cad_mod_usuario.php?idUsuario='+usuario.idUsuario+'" title="Editar" class=""><img src="../images/pencil.svg" width="20px" heigth="20px"/></a>&nbsp;&nbsp;&nbsp;';
        // listagemUsuarios += '<a onclick="visualizar('+usuario.idUsuario+')" href="#" title="Visualizar" >Detalhes </a>';
        listagemUsuarios += '<a title="Excluir" onclick="excluir('+usuario.idUsuario+')" href="#" class=""><img src="../images/trash.svg" width="30px" heigth="30px"/></a>';                                    
        listagemUsuarios += ' </td>';
        listagemUsuarios += '</tr>';
    } 
    $("#lista").html(listagemUsuarios);
}


function visualizar(idUsuario){
    $.ajax({
        type: "POST",
        url: "../../controller/ctrver_usuario.php",
        //data: {"idUsuario": idUsuario},
        data: idUsuario,
        success: function resposta(plainObject, textStatus, jqXHR) {
                //console.log(plainObject);
                json = JSON.parse(plainObject); 
                let usuario = json;
                let modal = '';
                    modal +='<table>';
                    modal += '<td>' ;
                    modal += '<tr > Código: '+usuario.idUsuario+'</tr> <br>' ;
                    modal += '<tr data-title="Name"> Nome: '+usuario.nome+'</tr><br>' ;
                    modal += '<tr > email: '+usuario.email+'</tr><br>' ;
                    modal += '<tr data-title="Name"> senha: '+usuario.senha+'</tr><br>' ;
                    modal += '</td>';
                    modal +='</table>';
                    $("#conteudo").html(modal);
        }
    });
}
              

function excluir(usuarioExcluir){
    $.ajax({
        type: "POST",
        url: "../../controller/ctr_listar_excluir_usuario.php",
        data: "idUsuario= "+ usuarioExcluir +"&delete=true",
        success: function (plainObject) {
            //console.log(plainObject);
            alert('Usuario excluído com sucesso!');
        }
    }); 
    
    let posicaoUsuario = -1;
    for(let i = 0; i < usuarios.length;i++){
        let usuario = usuarios[i];
        if(usuario.idUsuario == usuarioExcluir ){
            posicaoUsuario = i;
            break;
        }
    }
    
    usuarios.splice(posicaoUsuario, 1);
    listarUsuarios(usuarios);
}


function pesquisar(){
    
    let pesquisa = window.document.getElementById('textoPesquisa').value;
    let vlpesquisa =  $("input[name='vlpesquisa']:checked").val();
    //console.log(vlpesquisa);
    pesquisa = pesquisa.toString();

    let vetUsuario = [];

    if (pesquisa != "" && pesquisa != undefined){
        if (vlpesquisa == 1) {
            for ( let i = 0; i < usuarios.length; i++) { 
                let usuario = usuarios[i];
                vl =  usuario.idUsuario.toString().indexOf(pesquisa);
                if (vl != -1) {
                    vetUsuario.push(usuario);
                }
            }    
        } else if (vlpesquisa == 2) {
            for ( let i = 0; i < usuarios.length; i++) { 
                let usuario = usuarios[i];
                vl = usuario.nome.toLowerCase().indexOf(pesquisa.toLowerCase());
                if (vl != -1){                    
                    vetUsuario.push(usuario);
                } 
            }    
        }  else if (vlpesquisa == 3) {
            for ( let i = 0; i < usuarios.length; i++) { 
                let usuario = usuarios[i];
                vl =  usuario.email.toString().indexOf(pesquisa);
                if (vl != -1) {
                    vetUsuario.push(usuario);
                }
            }    
        } else {
            for ( let i = 0; i < usuarios.length; i++) { 
                let usuario = usuarios[i];
                vl = usuario.senha.toLowerCase().indexOf(pesquisa.toLowerCase());
                if (vl != -1){
                    vetUsuario.push(usuario);
                }
            }
        }
        if (vetUsuario == ""){
            mensagem = '<tr><td>Nenhum usuario encontrado!</td><td><td/><td></td><td></td><tr>' ;
            $("#lista").html(mensagem);
        } else {
            listarUsuarios(vetUsuario);
        }
    } else {     
        listarUsuarios(usuarios);   
    }
}

