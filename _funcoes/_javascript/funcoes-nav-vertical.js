function openNav() {
	var nav = document.getElementById("btnOpenNav");
	var tam = document.getElementById("idSidepanel");
	
	if (nav.innerHTML == "X") {
		nav.innerHTML = "☰";
		tam.style.width  = "0";
	} else {
		nav.innerHTML = "X";
		// tam.style.width  = "350px";
		tam.style.width  = "900px";
	}
}

function dropFunction() {
	var myDD = document.getElementById("idDropdown");

	myDD.classList.toggle("show");

	if (myDD.style.display == "block") {
		myDD.style.display = "none";
	} else {
		myDD.style.display = "block";
	}

	myDD.style.transition = "0.5s";
}

function alertaMenu() {
	alert("Favor se logar através do menu LOGIN !!!");
}

function alertaReparoEmergencial() {
	alert("Mensagem a ser definida !!!");
}
