function altLembrar() {
	var idLembrar  = document.getElementById("idLembrar");
	var txtLembrar = document.getElementById("idTxtLembrar");

	if (idLembrar.classList.contains("naolembrarse")) {
		idLembrar.innerHTML = " Lembrar de mim";
		idLembrar.classList.remove("naolembrarse");
		idLembrar.classList.add("lembrarse");
		txtLembrar.value = "lembrarse";
	} else {
		idLembrar.innerHTML = " Não lembrar de mim";
		idLembrar.classList.remove("lembrarse");
		idLembrar.classList.add("naolembrarse");
        txtLembrar.value = "naolembrarse";
	}
}
