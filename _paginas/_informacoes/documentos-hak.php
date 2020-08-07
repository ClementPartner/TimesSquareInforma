<?php
    session_start();

	if(!isset($_COOKIE["Moema"])) {
		setcookie("Moema", "", time() - 86400);
		header("location:../../index.php");
	}
	else {
		if(count($_COOKIE) <= 0) {
			setcookie("Moema", "", time() - 86400);
			header("location:../../index.php");			
		}
	}
	/*------------------------------------------------------------*/

	if ((!isset($_SESSION["usuarioAtivo"])) ||
		($_SESSION["usuarioAtivo"] == NULL) ||
		($_SESSION["usuarioAtivo"] != "S")) {
		 $_SESSION['mensagem'] = "Usuário saiu !!!";
		header("Location: ../_login/login-entrar.php");
	}

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Moema Times Square - Documentos</title>

	<link rel="stylesheet" type="text/css" href="../../_css/w3.css"/>
    <link rel="stylesheet" type="text/css" href="../../_css/estilo.css"/>
    <link rel="stylesheet" type="text/css" href="../../_css/informacoes.css"/>
</head>

<body class="imagem-fundo">
<div id="interface">
	<div id="titulo01">
		<span>TIMES SQUARE INFORME</span>

		<div id="idSidepanel" class="sidepanel">
			<a href="../_captcha/captcha-usar.php?tipo=2" class="item">LOGIN</a>
			<a href="../_informacoes/informacoes.php" class="item">INFORMAÇÕES</a>
			<a href="../_negocios/negocios.php" class="item">NEGÓCIOS E OPORTUNIDADES</a>
			<a href="../_servicos/servicos.php" class="item">SERVIÇOS</a>
			<a href="../_captcha/captcha-usar.php?tipo=1" class="item last-item">FALE CONOSCO</a>
		</div>

		<button id="btnOpenNav" onclick="openNav()">☰</button> 
	</div>

	<div id="titulo02">	<span>INFORMAÇÕES</span> </div>

	<button class="accordion">Atas</button>
	<div class="inf-panel">
		<div class="inf-navbar">
			<a href="../../__cliente/_documentos/_atas/AtaAGO-2019-03-26.pdf"
				class="w3-bar-item w3-button w3-ripple
					w3-margin-top w3-margin-bottom estilo-margin-leftright-4
					w3-border w3-round-xlarge w3-border-green">AGO 26/03/2019</a>
			<a href="../../__cliente/_documentos/_atas/AtaAGO-2018-03-21.pdf"
				class="w3-bar-item w3-button w3-ripple
					w3-margin-top w3-margin-bottom estilo-margin-leftright-4
					w3-border w3-round-xlarge w3-border-green">AGO 21/03/2018</a>
			<a href="../../__cliente/_documentos/_atas/AtaAGO-2017-03-28.pdf"
				class="w3-bar-item w3-button w3-ripple
					w3-margin-top w3-margin-bottom estilo-margin-leftright-4
					w3-border w3-round-xlarge w3-border-green">AGO 28/03/2017</a>
		</div>
	</div>

	<button class="accordion">Avisos gerais</button>
	<div class="inf-panel">
		<object width="100%" height="500" data="../../__cliente/_documentos/_avisos/timessquare-report.jpg"></object>
	</div>

	<button class="accordion">Avisos urgentes</button>
	<div class="inf-panel">
		<object width="100%" height="500" data="../../__cliente/_imagens/moematimessquare4.jpg"></object>
	</div>

	<button class="accordion">Orientações</button>
	<div class="inf-panel">
		<p>Ata da Assembléia Geral Ordinária</p>
		<object width="100%" height="500" data="../../__cliente/_documentos/_atas/AtaAGO-2019-03-26.pdf"></object>
	</div>

	<p> </p>

	<a href="../_login/login-home.php" class="w3-ripple button-voltar">&laquo; Anterior</a>

	<script src="../../_funcoes/_javascript/funcoes-nav-vertical.js"></script>
	<script src="../../_funcoes/_javascript/funcoes-accordion.js"></script>

</div>
</body>

</html>
