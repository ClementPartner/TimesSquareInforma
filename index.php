<?php
    if(!isset($_SESSION)) {
        session_start();

        $mensagem = isset($_SESSION['mensagem']) ?
            htmlspecialchars(strip_tags($_SESSION['mensagem'])) : "";
        unset($_SESSION['mensagem']);

        if(!isset($_SESSION["REMOTE_ADDR"])) {
            $_SESSION["REMOTE_ADDR"] = $_SERVER["REMOTE_ADDR"];
        }
        elseif($_SESSION["REMOTE_ADDR"] != $_SERVER["REMOTE_ADDR"]){
            session_unset();
            session_destroy();
        }
    }
    else {
        $mensagem = isset($_SESSION['mensagem']) ?
            htmlspecialchars(strip_tags($_SESSION['mensagem'])) : "";
        unset($_SESSION['mensagem']);
        session_unset();
        session_destroy();
		
        session_start();
    }
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Moema Times Square</title>

	<link rel="stylesheet" type="text/css" href="_css/w3.css"/>
	<link rel="stylesheet" type="text/css" href="_css/estilo.css"/>
</head>

<body class="imagem-fundo">
<div id="interface">
	<div id="titulo01">
		<span>TIMES SQUARE INFORME</span>

		<div id="idSidepanel" class="sidepanel" style="width: 900px;">
			<a href="_paginas/_captcha/captcha-usar.php?tipo=2" class="item">LOGIN</a>
			<a href="_paginas/_informacoes/informacoes.php" class="item">INFORMAÇÕES</a>
			<a href="_paginas/_negocios/negocios.php" class="item">NEGÓCIOS E OPORTUNIDADES</a>
			<a href="_paginas/_servicos/servicos.php" class="item">SERVIÇOS</a>
			<a href="_paginas/_captcha/captcha-usar.php?tipo=1" class="item last-item">FALE CONOSCO</a>
		</div>

		<button id="btnOpenNav" onclick="openNav()">X</button> 
	</div>

	<script src="../../_funcoes/_javascript/funcoes-nav-vertical.js"></script>
</div>
</body>
</html>
