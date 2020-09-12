function esconderDivAlerta(){
	document.getElementById('alertaLoginIncorreto').style.display = "none";	
}

function validarFormulario() {
	let email = window.document.getElementById('email').value;
	let senha = window.document.getElementById('senha').value;
	if(email ==="" || email === undefined ){
		let mensagem = '<div id="alertaLoginIncorreto"><p>Preencha o campo Email.</p></div>';
		//$("#alertaErro").append(mensagem);
		window.document.getElementById("alertaErro").innerHTML = mensagem;
		return false;
	} 

	if(senha ==="" || senha === undefined ){
		let mensagem = '<div id="alertaLoginIncorreto"><p>Preencha o campo Senha.</p></div>';
		//$("#alertaErro").append(mensagem);
		//window.document.getElementById("idListaAlunos").innerHTML = htmlListaAlunos;
    	window.document.getElementById("alertaErro").innerHTML = mensagem;
		return false;
	}
	form.submit();
}
