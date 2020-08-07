<?php
    require_once "../../_funcoes/_php/funcoes_php.php";

	$tipo = validar_entrada($_REQUEST["tipo"]);
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Moema Times Square - Captcha</title>

	<link rel="stylesheet" type="text/css" href="../../_css/w3.css"/>
    <link rel="stylesheet" type="text/css" href="../../_css/estilo.css"/>
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

	<div id="titulo02">	<span>ENTRAR</span> </div>

	<div style="margin-top: 16px;">
		<p class="preencher-captcha">Preencha com os caracteres do Captcha</p>
		<p class="preencher-nada"></p>
	</div>

	<div class="box-geral">
		<div class="box-form">
			<p class="linha-box-form">Captcha</p>
			<img class="imagem-captcha" src="captcha-montar.php?l=220&a=60&tf=30&ql=5">

			<form action="captcha-validar.php?tipo=<?php print $tipo; ?>"
				name="form" method="post" style="margin-top: 16px;">
				<input type="text" name="txtPalavra" class="texto-centro-24"
					size="15" maxlength="5" minlength="5"
					placeholder="Digite o captcha" autofocus required><br>
				<input class="w3-button w3-ripple w3-border button-entrar"
					type="submit" value="Entrar" />
			</form>
			<p> </p>
		</div>
	</div>

	<a href="../../index.php" class="w3-ripple button-voltar">&laquo; Anterior</a>

	<p> </p>

	<script src="../../_funcoes/_javascript/funcoes-nav-vertical.js"></script>

</div>
</body>

</html>
