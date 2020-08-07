$("#myCarousel").on('slide.bs.carousel', function () {
	var loop = document.getElementById("idGradeLoopVideos").innerHTML;
	var qtde = document.getElementById("idGradeQtdeVideos").innerHTML;

	var numLoop = parseInt(loop);
	var numQtde = parseInt(qtde);

	var qualVideo = "idV" + numLoop;
	var vid       = document.getElementById(qualVideo);
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
});

$("#myCarousel").on('slid.bs.carousel', function () {
	var loop = document.getElementById("idGradeLoopVideos").innerHTML;
	var qtde = document.getElementById("idGradeQtdeVideos").innerHTML;

	var numLoop = parseInt(loop);
	var numQtde = parseInt(qtde);

	var qualVideo = "idV" + numLoop;
	var vid       = document.getElementById(qualVideo);
		vid.load();
		vid.play();
});

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

///
		$("#myCarousel").carousel("pause");

		AlterarSrcVideo();

///
		$("#myCarousel").carousel("cycle");
		
	} else if (dataJs == dataCri) {
		if (horaJs > horaFinal) {
///
			$("#myCarousel").carousel("pause");
			AlterarSrcVideo();

///
			$("#myCarousel").carousel("cycle");
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
	novosVideos = retorno.substr(p + 1);
}

/* Alterar os src´s dos idVideo, para novo(s) conteúdo(s).
--------------------------------------------------------*/
function AlterarSrcVideo() {
	var qtde = document.getElementById("idGradeQtdeVideos").innerHTML;
	var numQtde = parseInt(qtde);

	RemoverNohCompleto(numQtde);

	recarregarHttp();

	var qtde = document.getElementById("idGradeQtdeVideos").innerHTML;
	var numQtde = parseInt(qtde);

	arrayVideos = novosVideos.split(",");

	IncluirNohCompleto(numQtde);

///
alert("forcei o carrossel no bootstrap");

///
	$("#myCarousel").carousel(0);
	$("#myCarousel").carousel("cycle");
	
}

function RemoverNohCompleto(numQtde) {
	<!---	<div id="looping">
	<!---  		<ul>
	<!--- 			<li>1</li>
	<!--- 			<li>2</li>
	<!--- 			<li>3</li>
	<!--- 		</ul>
	<!--- 	</div>
	<!----------------------->

	var  x = 1;
	for (x = 1; x <= numQtde; x++) {
		var quem = "idVideo" + x;

		// Removendo um nó a partir do pai.
		var node = document.getElementById(quem);
		if (node.parentNode) {
			node.parentNode.removeChild(node);
		}
	}

	document.getElementById("idGradeQtdeVideos").innerHTML = 1;
}

function IncluirNohCompleto(numQtde) {

	for (x = 1; x <= numQtde; x++) {
		var quem = "idVideo" + x;

		/*----------------------------------------
			DIV´s
		----------------------------------------*/
		var div  = document.createElement("DIV");
			div.setAttribute("id", quem);
			if (x == 1) {
				div.setAttribute("class", "item active"); // item active.
			} else {
				div.setAttribute("class", "item"); // item active.
			}

		document.getElementById("idCarrossel-inner").appendChild(div);
		//------------------------------------------------------------

		/*----------------------------------------
			Vídeos
		----------------------------------------*/
		var vid = document.createElement("VIDEO");
			vid.setAttribute("class", "video-fluid"); 
			vid.setAttribute("style", "width: 100%; height: auto;");		
			vid.muted    = false;
			vid.loop     = true;
			vid.autoplay = false;

///
			if (x == 1) {
				vid.autoplay = false;
			}

		var p  = parseInt(x) - 1;
			mv = arrayVideos[p];

		var src = document.createElement("SOURCE");
			src.setAttribute("src", mv);
			src.setAttribute("type", "video/mp4");

		vid.appendChild(src);

		document.getElementById(quem).appendChild(vid);

		//------------------------------------------------------------
	}

	document.getElementById("idGradeQtdeVideos").innerHTML = (parseInt(x) - 1);

	/*=== Exemplos ================================================
	----------------------------------------------
		DIV´s
	----------------------------------------------
	var div  = document.createElement("DIV");
		div.setAttribute("id", quem);
		if (x == 1) {
			div.setAttribute("class", "item active"); // item active.
		} else {
			div.setAttribute("class", "item"); // item active.
		}

	document.getElementById("idCarrossel-inner").appendChild(div);
	---------------------------------------------------------------

	------------------------------------------
		Imagens
	------------------------------------------
	var img = document.createElement("IMG");
	//  img.setAttribute("id", quem);
	//  img.setAttribute("alt", "foto 1");
		img.setAttribute("class", "w3-animate-left w3-image"); 
		img.setAttribute("style", "width:100%; max-height:420px;");

		img.setAttribute("src", "../../__cliente/_videos/" + src);
	//  img.setAttribute("width", "100%");
	//  img.setAttribute("height", "420");

	document.getElementById(quem).appendChild(img);
	--------------------------------------------------------------

	------------------------------------------
		Vídeos
	------------------------------------------
	var vid = document.createElement("VIDEO");
	//	vid.setAttribute("id", qqvid);
		vid.setAttribute("class", "video-fluid"); 
		vid.setAttribute("style", "width: 100%; height: auto;");
		vid.autoplay = true;
		vid.loop     = true;
		vid.muted    = true;

	var src = document.createElement("SOURCE");
		src.setAttribute("src", "../../__cliente/_videos/" + mp);
		src.setAttribute("type", "video/mp4");

	vid.appendChild(src);

	document.getElementById(quem).appendChild(vid);
	--------------------------------------------------------------
	============================================================*/
}
