/*---------------------------------------------------------*/
// onkeydown="javascript: funcMascara( this, mascaraCPF );"

var tipoPessoa = document.getElementById("idTipoPessoa");

function mostrarCPFCNPJ() {
	if (tipoPessoa.value == "Fisica") {
		document.getElementById("idTextoCPFCNPJ").innerHTML = "CPF<sup class='asteristico'>*</sup>";
	}

	if (tipoPessoa.value == "Juridica") {
		document.getElementById("idTextoCPFCNPJ").innerHTML = "CNPJ<sup class='asteristico'>*</sup>"; 
	}

	if (tipoPessoa.value == "Passaporte") {
		document.getElementById("idTextoCPFCNPJ").innerHTML = "Passaporte"; 
	}
}

function formatarCPFCNPJ(objeto) {
	if (tipoPessoa.value == "Fisica") {
		funcMascara(objeto, mascaraCPF);
	}

	if (tipoPessoa.value == "Juridica") {
		funcMascara(objeto, mascaraCNPJ);
	}
}

function funcMascara(objeto, mascara) {
	obj  = objeto;
	masc = mascara;
	setTimeout("funcMascaraEx()", 1);
}

function funcMascaraEx() {
	obj.value = masc(obj.value);
}

function mascaraCPF(cpf) {
	if (cpf.length > 14) {
		cpf = cpf.substr(0, 14);
	}

	cpf = cpf.replace(/\D/g, "");
	cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
	cpf = cpf.replace(/(\d{3})(\d)/, "$1.$2");
	cpf = cpf.replace(/(\d{3})(\d{1,2})$/, "$1-$2");
	return cpf
}

function mascaraCNPJ(cnpj) {
	cnpj = cnpj.replace(/\D/g, "");
	cnpj = cnpj.replace(/(\d{2})(\d)/, "$1.$2");
	cnpj = cnpj.replace(/(\d{3})(\d)/, "$1.$2");
	cnpj = cnpj.replace(/(\d{3})(\d)/, "$1/$2");
	cnpj = cnpj.replace(/(\d{4})(\d{1,2})$/, "$1-$2");
	return cnpj
}

function testarCPFCNPJ() {
	textoCPFCNPJ = document.getElementById("idCPFCNPJ").value;
	
	if (tipoPessoa.value == "Fisica") {
		return testarCPF(textoCPFCNPJ);
	}

	if (tipoPessoa.value == "Juridica") {
		return testarCNPJ(textoCPFCNPJ);
	}

	if (tipoPessoa.value == "Passaporte") {
		return true;
	}
}

function testarCPF(strCPF) {

	strCPF = strCPF.replace(/[^\d]+/g,'');
	
	if (strCPF == '') return false;	

	if (strCPF.length != 11 ||
		strCPF == "00000000000" ||
		strCPF == "11111111111" ||	
		strCPF == "22222222222" ||	
		strCPF == "33333333333" ||	
		strCPF == "44444444444" ||	
		strCPF == "55555555555" ||	
		strCPF == "66666666666" ||	
		strCPF == "77777777777" ||	
		strCPF == "88888888888" ||	
		strCPF == "99999999999") 
			return false;

	soma = 0;
     
	for (i=1; i<=9; i++)
		soma = soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);

	Resto = (soma * 10) % 11;
   
	if ((Resto == 10) || (Resto == 11))
		Resto = 0;

	if (Resto != parseInt(strCPF.substring(9, 10)))
		return false;
   
	soma = 0;

	for (i = 1; i <= 10; i++)
		soma = soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);

	Resto = (soma * 10) % 11;
   
	if ((Resto == 10) || (Resto == 11))
		Resto = 0;

	if (Resto != parseInt(strCPF.substring(10, 11)))
		return false;

	return true;
}

function testarCNPJ(strCNPJ) {
 
    strCNPJ = strCNPJ.replace(/[^\d]+/g,'');
	
    if(strCNPJ == '') return false;
     
    if (strCNPJ.length != 14 ||
        strCNPJ == "00000000000000" || 
        strCNPJ == "11111111111111" || 
        strCNPJ == "22222222222222" || 
        strCNPJ == "33333333333333" || 
        strCNPJ == "44444444444444" || 
        strCNPJ == "55555555555555" || 
        strCNPJ == "66666666666666" || 
        strCNPJ == "77777777777777" || 
        strCNPJ == "88888888888888" || 
        strCNPJ == "99999999999999")
			return false;
         
    // Valida DVs
    tamanho = strCNPJ.length - 2;
    numeros = strCNPJ.substring(0, tamanho);
    digitos = strCNPJ.substring(tamanho);

	soma = 0;

    pos = tamanho - 7;
    for (i = tamanho; i >= 1 ; i--) {
		soma += numeros.charAt(tamanho - i) * pos--;
		if (pos < 2)
			pos = 9;
    }

    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;

    if (resultado != digitos.charAt(0))
        return false;
		
    tamanho = tamanho + 1;
    numeros = strCNPJ.substring(0, tamanho);

    soma = 0;

    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
          pos = 9;
    }

    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;

    if (resultado != digitos.charAt(1))
        return false;
           
    return true;
}
