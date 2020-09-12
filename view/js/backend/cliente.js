function cad_mod_cliente() {
    idCliente = window.document.getElementById('idCliente').value;
    nome = window.document.getElementById('nome').value;
    cpf = window.document.getElementById('cpf').value;
    rg = window.document.getElementById('rg').value;
    dataCadastro = window.document.getElementById('dataCadastro').value;
    dataModificacao = window.document.getElementById('dataModificacao').value;
    usuarioCadastro = window.document.getElementById('usuarioCadastro').value;
    usuarioModificacao = window.document.getElementById('usuarioModificacao').value;
    dataNascimento = window.document.getElementById('dataNascimento').value;
    telefone = window.document.getElementById('telefone').value;
    localNascimento = window.document.getElementById('localNascimento').value;
   
    validarCampos (idCliente, 
        nome,
        cpf,
        rg,  
        dataCadastro,
        dataModificacao,
        usuarioCadastro,
        usuarioModificacao,
        dataNascimento,  
        telefone,
        localNascimento  
    );
}


function validarCampos(){

    if (nome==='' || nome === undefined ){
        alert('Prencha o nome do cliente!');
        document.getElementById("nome").focus();
        return false;
    }
/*  
    else if (cpf===''|| cpf === undefined){   
        alert("Prencha o cpf!");
        document.getElementById("cpf").focus();
        return false;
    } 

    // else if ((rg==='' || rg === undefined)){
    //     alert("Prencha a rg do cliente!");
    //     document.getElementById("rg").focus();
    //     return false;
    // }


    else if ((dataNascimento==='' || dataNascimento === undefined)){
        alert("Prencha a data de nascimento do cliente!");
        document.getElementById("dataNascimento").focus();
        return false;
    }


    else if ((localNascimento==='' || localNascimento === undefined)){
        alert("Prencha o local de nascimento cliente!");
        document.getElementById("localNascimento").focus();
        return false;
    }

    else if(localNascimento==='BA' && calcularIdade(dataNascimento)<18){
        alert('Cadastro recusado, idade inferior ao permitido!');
        return false;
    }

    else if(localNascimento==='SP' && rg===''){
        alert('Preencha RG do cliente!');
        return false;
    }
*/
    else {        
        let novoCliente = criaCliente(idCliente, nome, cpf, rg, 
            dataCadastro, dataModificacao, usuarioCadastro, usuarioModificacao,
             dataNascimento, telefone, localNascimento);
        let endereco = "../../controller/ctr_cadastrar_modificar_cliente.php";
        requisitarCadModCliente(endereco, novoCliente);
    }
}


function criaCliente(pIdCliente, pNome, pCpf, pRg, 
    pDataCadastro, pDataModificacao, pUsuarioCadastro, 
    pUsuarioModificacao, pDataNascimento, pTelefone, pLocalNascimento
    ){
    return {
        idCliente: pIdCliente,
        nome : pNome,
        cpf: pCpf,
        rg: pRg,
        dataCadastro: pDataCadastro,
        dataModificacao: pDataModificacao,
        usuarioCadastro: pUsuarioCadastro,
        usuarioModificacao: pUsuarioModificacao,
        dataNascimento: pDataNascimento,
        telefone: pTelefone,
        localNascimento: pLocalNascimento
    };
}


function requisitarCadModCliente(endereco, dados){
    $.ajax({
        type: "POST",
        url: endereco,
        data: dados,
        success: function resposta(plainObject, textStatus, jqXHR) {
            //alert('O procedimento foi um sucesso!');
            console.log(plainObject);
            //window.location.href = "../pages/lista_cliente.php";
        }
    });
};


function buscarClientes(){
    $.ajax({
        type: "POST",
        url: "../../controller/ctr_listar_excluir_cliente.php",
        success: function (plainObject) {
            let json = JSON.parse(plainObject); 
            clientes = json.cliente;
            listarClientes(clientes);
        }
    });
}


function listarClientes(clientesParaListar){
    let listagemClientes = "";
    for (let i = 0; i < clientesParaListar.length; i++) { 
        let cliente = clientesParaListar[i];    
        listagemClientes += '<tr>' ;
        listagemClientes += '<td >'+cliente.idCliente+'</td>';
        listagemClientes += '<td >'+cliente.nome+'</td>';
        listagemClientes += '<td >'+cliente.cpf+'</td>';
        listagemClientes += '<td >'+cliente.rg+'</td>';
        listagemClientes += '<td >'+cliente.dataNascimento+'</td>';
        listagemClientes += '<td >'+cliente.localNascimento+'</td>';
        listagemClientes += '<td >'+cliente.telefone+'</td>';
        // listagemClientes += '<td >'+cliente.excluido+'</td>';
        listagemClientes += '<td class="td-actions">';                            
        listagemClientes += '<a href="../pages/cad_mod_cliente.php?idCliente='+cliente.idCliente+'" title="Editar" class=""><img src="../images/pencil.svg" width="20px" heigth="20px"/></a>&nbsp;&nbsp;&nbsp;';
        // listagemClientes += '<a onclick="visualizar('+cliente.idCliente+')" href="#" title="Visualizar" >Detalhes </a>';
        listagemClientes += '<a title="Excluir" onclick="excluir('+cliente.idCliente+')" href="#" class=""><img src="../images/trash.svg" width="30px" heigth="30px"/></a>';                                    
        listagemClientes += ' </td>';
        listagemClientes += '</tr>';
    } 
    $("#lista").html(listagemClientes);
}


function visualizar(idCliente){
    $.ajax({
        type: "POST",
        url: "../../controller/ctrver_cliente.php",
        //data: {"idCliente": idCliente},
        data: idCliente,
        success: function resposta(plainObject, textStatus, jqXHR) {
                json = JSON.parse(plainObject); 
                let cliente = json;
                let modal = '';
                    modal +='<table>';
                            modal += '<td>' ;
                                modal += '<tr > Código: '+cliente.idCliente+'</tr> <br>' ;
                                modal += '<tr data-title="Name"> Nome: '+cliente.nome+'</tr><br>' ;
                                modal += '<tr > cpf: '+cliente.cpf+'</tr><br>' ;
                                modal += '<tr data-title="Name"> rg: '+cliente.rg+'</tr><br>' ;
                            modal += '</td>';
                    modal +='</table>';
                    $("#conteudo").html(modal);
        }
    });
}
              

function excluir(clienteExcluir){
    $.ajax({
        type: "POST",
        url: "../../controller/ctr_listar_excluir_cliente.php",
        data: "idCliente= "+ clienteExcluir +"&delete=true",
        success: function (plainObject) {
                alert('Cliente excluído com sucesso!');
        }
    }); 
    
    let posicaoCliente = -1;
    for(let i = 0; i < clientes.length;i++){
        let cliente = clientes[i];
        if(cliente.idCliente == clienteExcluir ){
            posicaoCliente = i;
            break;
        }
    }
    clientes.splice(posicaoCliente, 1);
    listarClientes(clientes);
}


function pesquisar(){
    
    let pesquisa = window.document.getElementById('textoPesquisa').value;
    let vlpesquisa =  $("input[name='vlpesquisa']:checked").val();
    //console.log(vlpesquisa);
    pesquisa = pesquisa.toString();

    let vetCliente = [];

    if (pesquisa != "" && pesquisa != undefined){
        if (vlpesquisa == 1) {
            for ( let i = 0; i < clientes.length; i++) { 
                let cliente = clientes[i];
                vl =  cliente.idCliente.toString().indexOf(pesquisa);
                if (vl != -1) {
                    vetCliente.push(cliente);
                }
            }    
        } else if (vlpesquisa == 2) {
            for ( let i = 0; i < clientes.length; i++) { 
                let cliente = clientes[i];
                vl = cliente.nome.toLowerCase().indexOf(pesquisa.toLowerCase());
                if (vl != -1){                    
                    vetCliente.push(cliente);
                } 
            }    
        }  else if (vlpesquisa == 3) {
            for ( let i = 0; i < clientes.length; i++) { 
                let cliente = clientes[i];
                vl =  cliente.cpf.toString().indexOf(pesquisa);
                if (vl != -1) {
                    vetCliente.push(cliente);
                }
            }    
        } else {
            for ( let i = 0; i < clientes.length; i++) { 
                let cliente = clientes[i];
                vl = cliente.rg.toLowerCase().indexOf(pesquisa.toLowerCase());
                if (vl != -1){
                    vetCliente.push(cliente);
                }
            }
        }
        if (vetCliente == ""){
            mensagem = '<tr><td>Nenhum cliente encontrado!</td><td><td/><td></td><td></td><tr>' ;
            $("#lista").html(mensagem);
        } else {
            listarClientes(vetCliente);
        }
    } else {     
        listarClientes(clientes);   
    }
}
