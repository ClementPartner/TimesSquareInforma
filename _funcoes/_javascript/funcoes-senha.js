var alterada  = document.getElementById("idMsg");

var validacao = document.getElementById("idDivValidacao");

var diferente = document.getElementById("idDiferentes");

var senha1    = document.getElementById("idSenha");
var minuscula = document.getElementById("idMinuscula");
var maiuscula = document.getElementById("idMaiuscula");
var numero    = document.getElementById("idNumero");
var tamanho   = document.getElementById("idTamanho");
var iguais    = document.getElementById("idIguais");

var senha2    = document.getElementById("idSenha2");

var diferentes = document.getElementById("idDiferentes");

var login     = document.getElementById("idEmail");

	validacao.style.display = "block";

// Quando clicar no campo Senha mostrar a mensagem.
senha1.onfocus = function() {
	diferente.style.display = "none";
	validacao.style.display = "block";
}

// Quando clicar fora do campo Senha, sumir com a mensagem.
senha1.onblur = function() {
	validacao.style.display = "none";
}
	
// Quando começar a digitar alguma coisa no campo Senha.
senha1.onkeyup = function() {
	alterada.style.display = "none";

	// Validar letras minúsculas.
	var minusculas = /[a-z]/g;
	if(senha1.value.match(minusculas)) {  
		minuscula.classList.remove("invalida");
		minuscula.classList.add("valida");
	} else {
		minuscula.classList.remove("valida");
		minuscula.classList.add("invalida");
	}
 
	// Validar letras maiúsculas.
	var maiusculas = /[A-Z]/g;
	if(senha1.value.match(maiusculas)) {  
		maiuscula.classList.remove("invalida");
		maiuscula.classList.add("valida");
	} else {
		maiuscula.classList.remove("valida");
		maiuscula.classList.add("invalida");
	}

	// Validar números.
	var numeros = /[0-9]/g;
	if(senha1.value.match(numeros)) {  
		numero.classList.remove("invalida");
		numero.classList.add("valida");
	} else {
		numero.classList.remove("valida");
		numero.classList.add("invalida");
	}
  
	// Validar tamanho.
	if(senha1.value.length >= 8) {
		tamanho.classList.remove("invalida");
		tamanho.classList.add("valida");
	} else {
		tamanho.classList.remove("valida");
		tamanho.classList.add("invalida");
	}
}
	
senha2.onfocus = function() {
	diferente.style.display = "none";
	alterada.style.display = "none";
	iguais.classList.remove("invisivel");
	iguais.classList.add("visivel");
	validacao.style.display = "block";
}
	
// Quando clicar fora do campo Senha, sumir com a mensagem.
senha2.onblur = function() {
	iguais.classList.remove("visivel");
	iguais.classList.add("invisivel");
	validacao.style.display = "none";
		
	if (senha1.value == senha2.value) {
		diferente.style.display = "none";
	} else {
		diferente.style.display = "block";
	}					
}

// Quando começar a digitar alguma coisa no campo Senha2.
senha2.onkeyup = function() {
	if (senha1.value == senha2.value) {
		iguais.classList.remove("invalida");
		iguais.classList.add("valida");
	} else {
		iguais.classList.remove("valida");
		iguais.classList.add("invalida");
	}
}
	
function senhasIguais() {
	var s1 = document.getElementById("idSenha");
	var s2 = document.getElementById("idSenha2");
		
	if (s1.value == s2.value) {
		return true;
	} else {			
		alert("Senhas não são iguais !!! Redigite-as...");
		document.getElementById("idSenha").focus();
		return false;
	}
}

// Quando clicar no campo Email apagar a mensagem de senhas diferentes.
login.onfocus = function() {
	diferente.style.display = "none";
}
