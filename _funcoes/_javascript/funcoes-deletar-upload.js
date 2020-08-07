var idDeletar = document.getElementById("idDeletar");
idDeletar.style.display = "none";

var quemDeletar = "";
var diretorioDeletar = "";

function LinhaClick(x) {
	quemDeletar = document.getElementById("myTable").rows[x.rowIndex].cells[1].innerHTML;
	diretorioDeletar = document.getElementById("idDiretorio").value;
	idDeletar.innerHTML = " " + quemDeletar + "?";
	idDeletar.style.display = "block";
}

function Confirmacao() {
	var resposta = confirm("Deseja remover esse vídeo?");

	if (resposta == true) {
		idDeletar.href = "deletar-arq.php?dir=" + diretorioDeletar + "&arq=" + quemDeletar;
	}

	idDeletar.style.display = "none";
}
