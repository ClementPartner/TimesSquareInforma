var idMsg = document.getElementById("idMsg");

function closeMsg() {
	idMsg.style.display = "none";
}

function LinhaClick(x) {
	qualArq = document.getElementById("myTable").rows[x.rowIndex].cells[0].innerHTML;
	idVideo = document.getElementById("idVideo");
	idVideo.value = qualArq;
}

function videoFuncao() {
	var input, filtro, tabela, tr, td, i;

	input = document.getElementById("idVideo");
	filtro = input.value.toUpperCase();

	tabela = document.getElementById("myTable");
	tr = tabela.getElementsByTagName("tr");

	for (i = 0; i < tr.length; i++) {
		td = tr[i].getElementsByTagName("td")[0];

		if (td) {
			txtValue = td.textContent || td.innerText;

			if (txtValue.toUpperCase().indexOf(filtro) > -1) {
				tr[i].style.display = "";
			} else {
				tr[i].style.display = "none";
			}
		}
	}
}

function validarForm() {
	var dataInicial = document.getElementById("idDataInicial");
	var dataFinal   = document.getElementById("idDataFinal");
	var dataHoje    = document.getElementById("idHoje");

	if (dataFinal.value < dataInicial.value) {
		alert("Data Final não pode ser anterior a Data Inicial !!! Redigite-as ...");
		return false;
	}

	if (dataFinal.value < dataHoje.value) {
		alert("Data Final não pode ser anterior a Data Atual !!! Redigite-a ...");
		return false;
	}

	var options = document.getElementById("idHorario").getElementsByTagName("option");
	var selOpt  = false;

	for(var i = 0; i < options.length; i++){
		if (options[i].selected) {
			//alert(options[i].value);
			selOpt = true;
		}
	}
	
	if (!selOpt) {
		alert("Nenhum horário foi selecionado !!! Selecione-o(s) ...");
		return false;
	}

	var idVideo   = document.getElementById("idVideo");
	var txtVideo  = idVideo.value.toUpperCase();
	var tabela    = document.getElementById("myTable");
	var tr        = tabela.getElementsByTagName("tr");
	var td, i;

	for (i = 0; i < tr.length; i++) {
		td = tr[i].getElementsByTagName("td")[0];

		if (td) {
			tdValue = td.textContent || td.innerText;

			if (tdValue.toUpperCase() == txtVideo) {
				return true;
			}
		}
	}

	var msg = "Nome do vídeo está errado !!! Redigite-o ... \n\rOu selecione algum existente na tabela !!!"; 
	alert(msg);
	return false;
}
