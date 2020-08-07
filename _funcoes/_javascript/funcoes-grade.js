$(document).ready(function(){
/*-------------
	var vid = document.getElementById("idVideo");
		vid.oncanplay = function() {
		vid.play();}
--------------*/

	alterarSrcDaEntrada();

	var duracao = document.getElementById("idGradeDuracao").innerHTML;
		duracao = parseInt(duracao) * 1000;

//	var myVar = setTimeout(myTimeout, duracao);
	var myVar = setInterval(myIntervalo, duracao);
});

function alterarSrcDaEntrada() {
	var arr = document.getElementById("idGradeSrcVideos").innerHTML;
	arrayVideos = arr.split(",");
	document.getElementById("idVideo").src = "../../__cliente/_videos/" + arrayVideos[0];
	document.getElementById("idVideo").load();
	document.getElementById("idVideo").play();
}

function myTimeout() {
// alert("agora é o timeout.");
}

function myIntervalo() {
	var loop = document.getElementById("idGradeLoopVideos").innerHTML;
	var qtde = document.getElementById("idGradeQtdeVideos").innerHTML;

	var numLoop = parseInt(loop);
	var numQtde = parseInt(qtde);

	var vid = document.getElementById("idVideo");
		vid.pause();

	numLoop += 1;
	
	if (numLoop > numQtde) {
		numLoop = 1;
		document.getElementById("idGradeLoopVideos").innerHTML = numLoop;
		VerDataHoraGrade();
	} else {
		document.getElementById("idGradeLoopVideos").innerHTML = numLoop;
		document.getElementById("idJsDataHora").innerHTML = "2019/01/01 00:00:00";
	}
	
	var arr = document.getElementById("idGradeSrcVideos").innerHTML;
	arrayVideos = arr.split(",");

	document.getElementById("idVideo").src = "../../__cliente/_videos/" + arrayVideos[numLoop - 1];
	document.getElementById("idVideo").load();
	document.getElementById("idVideo").play();
}

/* Injetar a data e hora do browser para comparação.
-----------------------------------------------------------------*/
function DataHoraCompleta() {
	var d    = new Date();
	var dia  = d.getDate();
	var mes  = d.getMonth() + 1;
	var ano  = d.getFullYear();
	var hora = d.getHours();
	var min  = d.getMinutes();
	var seg  = d.getSeconds();

	if (mes < 10) {
		mes = "0" + mes;
	}

	if (dia < 10) {
		dia = "0" + dia;
	}
	
	var ret = ano + "/" + mes + "/" + dia + " " + hora + ":" + min + ":" + seg;

	return ret;	
}

/* Comparar as datas e horas de criação da grade com a do browser.
-----------------------------------------------------------------*/
function VerDataHoraGrade() {
	document.getElementById("idJsDataHora").innerHTML = DataHoraCompleta();

	var dataHoraJs  = document.getElementById("idJsDataHora").innerHTML.trim();
	var dataCriacao = document.getElementById("idGradeDataCriacao").innerHTML.trim();
	var horaFinal   = document.getElementById("idGradeHoraFinal").innerHTML.trim();
  
	var anoJs  = dataHoraJs.substr(0, 4);
	var mesJs  = dataHoraJs.substr(5, 2);
	var diaJs  = dataHoraJs.substr(8, 2);
	var dataJs = anoJs + mesJs + diaJs;

	var horaJs = dataHoraJs.substr(11, 2) + ":59:59";

	var anoCri = dataCriacao.substr(0, 4);
	var mesCri = dataCriacao.substr(5, 2);
	var diaCri = dataCriacao.substr(8, 2);
	var dataCri = anoCri + mesCri + diaCri;

	if (dataJs > dataCri) {
		recarregarHttp();	
	} else if (dataJs == dataCri) {
		if (horaJs > horaFinal) {
			recarregarHttp();
		}
	}
}

/* Carga das novas $_SESSION´s. */
function recarregarHttp() {
	var d    = new Date();
	var dia  = d.getDate();
	var mes  = d.getMonth() + 1;
	var ano  = d.getFullYear();
	var hora = d.getHours();
	var min  = d.getMinutes();
	var seg  = d.getSeconds();

	if (mes < 10) {
		mes = "0" + mes;
	}

	if (dia < 10) {
		dia = "0" + dia;
	}

	var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				retorno = this.responseText;
			}
		};
		xhttp.open("GET", "grade-recarregar-http.php", false);
		xhttp.send();

	/*-----------------------------
	var xhttp = new XMLHttpRequest();
		xhttp.open("GET", "grade-carregar-da-tabela.php", false);
		xhttp.send();
		document.getElementById("idGradeQtdeVideos").innerHTML = xhttp.responseText;
	-------------------------------*/

	var p = retorno.indexOf(";");
	document.getElementById("idGradeQtdeVideos").innerHTML  = retorno.substr(0, p);
	document.getElementById("idGradeDataCriacao").innerHTML = retorno.substr(p + 1, 10);

		p = retorno.indexOf(";", 10);
	document.getElementById("idGradeHoraFinal").innerHTML   = retorno.substr(p + 1, 8);

		p = retorno.lastIndexOf(";");
	document.getElementById("idGradeSrcVideos").innerHTML   = retorno.substr(p + 1);
//	novosVideos = retorno.substr(p + 1);
//	arrayVideos = novosVideos.split(",");

	location.reload();
}
