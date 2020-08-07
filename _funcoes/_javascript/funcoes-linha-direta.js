function closeMsg() {
	document.getElementById("idMsg").style.display = "none";
}

function anexarFoto() {
	var x = document.getElementById("idAnexarFoto");
		x.style.display = "none";

		x = document.getElementById("idArqsFotos");
		x.style.display = "block";
}

function VerFoto() {
	var x = document.getElementById("idArqsFotos");
	var txt  = "";
	var foto = "";
	var qtde = 0;

	if ('files' in x) {
		if (x.files.length == 0) {
			txt = "Selecione uma foto.";
			x.style.display = "block";
		} else {
			if (x.files.length > 5) {
				qtde = 5;
			} else {
				qtde = x.files.length;
			}
			
			for (var i = 0; i < qtde; i++) {
				txt += "<br><strong>" + (i+1) + ". file</strong><br>";
				var file = x.files[i];

				if ('name' in file) {
					txt  += "name: " + file.name + "<br>";
					foto += file.name + "<br>";
				}

				if ('size' in file) {
					txt += "size: " + file.size + " bytes <br>";
				}
			}
			
			x.style.display = "none";
		}
	} else {
		x.style.display = "block";
		if (x.value == "") {
			txt += "Selecione uma foto.";
		} else {
			txt += "Propriedade não suportada no seu browser!";
			txt += "<br>Caminho da foto selecionada: " + x.value; // If the browser does not support the files property, it will return the path of the selected file instead. 
		}
	}

	//document.getElementById("idMsgAnexo").innerHTML = "Anexar foto " + txt;
	var msg = document.getElementById("idMsgAnexo");
		msg.innerHTML = "Anexar até 5 foto(s): <br>" + foto;
		msg.style.display = "block";

	document.getElementById("idFoto").value	= foto;
}
