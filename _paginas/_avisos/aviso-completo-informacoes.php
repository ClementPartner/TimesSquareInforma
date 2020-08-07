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

    require_once "../../_funcoes/_php/funcoes_php.php";

	$id = validar_entrada($_REQUEST["id"]);
	
	//Incluir a conexão com banco de dados.
	require_once "../../_bd/bd-config.php";
	require_once "../../_bd/bd-connection.php";
	require_once "../../_bd/bd-crud.php";
	
	/* Buscar na tabela aviso o último aviso cadastrado.
	--------------------------------------------------*/
	$dados = DBRead("aviso", "Id, Titulo, Descricao, Data, Link1, Link2, Link3, Link4", 
				" WHERE Id = $id ", "ORDER BY Id DESC", "LIMIT 2");

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Moema Times Square - Aviso</title>

	<link rel="stylesheet" type="text/css" href="../../_css/w3.css"/>
	<link rel="stylesheet" type="text/css" href="../../_css/estilo.css"/>
	<link rel="stylesheet" type="text/css" href="../../_css/login.css"/>

    <link rel="stylesheet" type="text/css" href="../../_css/avisos-pop-up.css"/>

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

	<div id="titulo02">	<span>AVISO</span> </div>

	<div class="box-geral">
		<div class="aviso-completo-container">
			<p class="aviso2">Aviso !</p>
			<p class="aviso-titulo2"><?php print $dados[0]["Titulo"]; ?></p>
			<p class="aviso-descricao"><?php print $dados[0]["Descricao"]; ?></p>
		</div>
	</div>

	<p> </p>

	<a href="../_informacoes/avisos-urgentes.php" class="w3-ripple button-voltar">&laquo; Anterior</a>

	<script src="../../_funcoes/_javascript/funcoes-nav-vertical.js"></script>
</body>
</html>
