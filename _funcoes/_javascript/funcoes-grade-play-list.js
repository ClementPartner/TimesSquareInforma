function consultarDia() {
	var dataInicial = document.getElementById("idDataInicial").value;
	
	idLupa.href = "consultar-programacao-play-list.php?dia=" + dataInicial;
}

function LinhaClick(x) {
	qualHora = document.getElementById("myTable").rows[x.rowIndex].cells[0].innerHTML;
	
	id = document.getElementById("idVideoHora");
	id.innerHTML = "Video(s) - " + qualHora;

	var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				retorno = this.responseText;
			}
		};
		xhttp.open("GET", "consultar-play-list-recarregar-http.php?hora=" + qualHora, false);
		xhttp.send();

	location.reload();
}
