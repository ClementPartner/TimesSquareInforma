function montarHref() {
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

	var montagem = "?data=" + ano + "-" + mes + "-" + dia + "&hora=" + hora;

	//ret = "../_grade/grade.php" + montagem;

	ret = "../_grade/grade.php";
	return ret;
}
