var idDeletar = document.getElementById("idDeletar");
	idDeletar.style.display = "none";

var quemDeletar = "";

function LinhaClick(x) {
	linha = document.getElementById("myTable").rows[x.rowIndex];

	quemDeletar = linha.cells[0].innerHTML;

	mostrar = linha.cells[1].innerHTML + " a "    + 
			  linha.cells[2].innerHTML + ", das " +
			  linha.cells[3].innerHTML + " às "   +
			  linha.cells[4].innerHTML + ", "     +
			  linha.cells[5].innerHTML;
	idDeletar.innerHTML = " <" + mostrar + "?";
	idDeletar.style.display = "block";
}

function Confirmacao() {
	var resposta = confirm("Deseja remover essa programação?");

	if (resposta == true) {
		idDeletar.href = "deletar-grade.php?reg=" + quemDeletar;
	}

	idDeletar.style.display = "none";
}
