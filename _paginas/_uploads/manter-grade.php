<?php
    session_start();

	if(!isset($_COOKIE["Moema"])) {
		setcookie("Moema", "", time() - 86400);
        session_unset();
        session_destroy();
		header("Location: ../_login/login-entrar.php");
	}
	else {
		if(count($_COOKIE) <= 0) {
			setcookie("Moema", "", time() - 86400);
			session_unset();
			session_destroy();
			header("Location: ../_login/login-entrar.php");
		}
	}
	/*------------------------------------------------------------*/

	if ((!isset($_SESSION["usuarioAtivo"])) ||
		($_SESSION["usuarioAtivo"] == NULL) ||
		($_SESSION["usuarioAtivo"] != "S")) {
		 $_SESSION['mensagem'] = "Usuário saiu !!!";
		header("Location: ../_login/login-entrar.php");
	}

    unset(
		$_SESSION["gradeDataInicial"],
		$_SESSION["gradeDataFinal"],
		$_SESSION["gradeHorario"],
		$_SESSION["gradeVideo"]
	);
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Moema Times Square - Manutenções</title>

	<link rel="stylesheet" type="text/css" href="../../_css/w3.css"/>
	<link rel="stylesheet" type="text/css" href="../../_css/estilo.css"/>
	<link rel="stylesheet" type="text/css" href="../../_css/login.css"/>
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

	<div id="titulo02">	<span>MANUTENÇÕES</span> </div>

	<div class="box-geral">
		<div class="box-form w3-center">
			<div class="login-container">
				<a href="upload.php"
					class="botao-home w3-ripple">UPLOADS DE ARQUIVOS</a><br>
				<a href="consultar-upload.php"
					class="botao-home w3-ripple">CONSULTAR ARQUIVOS</a><br>
				<a href="programar.php"
					class="botao-home w3-ripple">PROGRAMAR A GRADE</a><br>
				<a href="consultar-programar.php"
					class="botao-home w3-ripple">CONSULTAR A GRADE</a><br>
				<a href="consultar-play-list.php"
					class="botao-home w3-ripple">CONSULTAR A PLAY LIST</a><br>
			</div>
			<p> </p>
		</div>
	</div>

	<a href="../_login/login-home.php" class="w3-ripple button-voltar">&laquo; Anterior</a>

	<p> </p>

	<script src="../../_funcoes/_javascript/funcoes-nav-vertical.js"></script>
</div>
</body>

</html>
