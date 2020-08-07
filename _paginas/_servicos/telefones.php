<?php
    require_once "../../_funcoes/_php/funcoes_php.php";

	$tipo = validar_entrada($_REQUEST["tipo"]);

	$titulo02 = "";
	$telefone = "";
	$linkcall = "";

	if ($tipo == 1) {
		$titulo02 = "DELL ART RISTORANTE";
		$telefone = "(11) 5054-0046";
		$linkcall = "tel:+551150540046";
	}
	if ($tipo == 2) {
		$titulo02 = "PLENTY ESTACIONAMENTO";
		$telefone = "(11) 3105-7450";
		$linkcall = "tel:+551131057450";
	}
	if ($tipo == 3) {
		$titulo02 = "FRAN´S CAFÉ";
		$telefone = "(11) 5053-2559";
		$linkcall = "tel:+551150532559";
	}
	if ($tipo == 4) {
		$titulo02 = "CIDA ALMEIDA STUDIO BEAUTY VISAGISTA";
		$telefone = "(11) 5052-8061";
		$linkcall = "tel:+551150528061";
	}
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Moema Times Square - Serviços</title>

	<link rel="stylesheet" type="text/css" href="../../_css/w3.css"/>
    <link rel="stylesheet" type="text/css" href="../../_css/estilo.css"/>
    <link rel="stylesheet" type="text/css" href="../../_css/informacoes.css"/>
	
	<style>
	p a {
		text-decoration: none;
	}

	p a:hover {
		color: blue;
		text-decoration: underline;
	}
	</style>
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

	<div id="titulo02">	<span><?php echo $titulo02; ?></span> </div>

	<p class="telefone">
		<a href="<?php echo $linkcall; ?>"><?php echo $telefone; ?></a></p>

	<a href="servicos.php" class="w3-ripple button-voltar">&laquo; Anterior</a>

	<script src="../../_funcoes/_javascript/funcoes-nav-vertical.js"></script>

</div>
</body>

</html>
