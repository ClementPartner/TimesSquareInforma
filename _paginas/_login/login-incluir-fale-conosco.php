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

	if ((!isset($_SESSION["usuarioEmail"])) ||
		($_SESSION["usuarioEmail"] == NULL) ||
		(empty($_SESSION["usuarioEmail"]))  ||
		($_SESSION["usuarioEmail"] == " ")) {
		 $_SESSION['mensagem'] = "Usuário saiu !!!";
		header("Location: ../_login/login-entrar.php");
	}

    require_once "../../_funcoes/_php/funcoes_php.php";

    $mensagem = isset(  $_SESSION['mensagem']) ?
        validar_entrada($_SESSION['mensagem']) : "";
    $_SESSION['mensagem'] = "";
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1">

    <title>Moema Times Square - Incluir usuário</title>

    <link rel="stylesheet" type="text/css" href="../../_css/login.css">
	<link rel="stylesheet" type="text/css" href="../../_css/w3.css"/>
	<link rel="stylesheet" type="text/css" href="../../_css/estilo.css"/>
	<link rel="stylesheet" type="text/css" href="../../_css/validar-senha.css"/>
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

	<div id="titulo02">	<span>LOGIN</span> </div>

	<div class="box-geral">
		<div class="box-form">
			<p class="linha-box-form">Novo Login</p>
			<form action="login-enviar-senha.php?tipo=1" method="post">

                <input type="hidden" name="txtCrud"  value="incluir">
				<input type="hidden" name="txtAtivo" value="S">
                <input type="hidden" name="txtNivel" value="1">

				<span id="idMsg"><?php print $mensagem; ?></span>

				<p class="p-linha">Nome:<sup class="asteristico">*</sup></p>
                <input type="text" id="idNome" name="txtNome" class="texto-centro-16"
                    size="30" minlength="10" maxlength="50"
					onclick="closeMsg()" onkeydown="closeMsg()"
                    placeholder="Nome completo" autofocus required>

				<p class="p-linha">Email:<sup class="asteristico">*</sup></p>
				<input type="email" id="idEmail" name="txtEmail" class="texto-centro-16"
					size="50" minlength="8" maxlength="100"
					onclick="closeMsg()" onkeydown="closeMsg()"
					placeholder="Entre com o email" required>

				<p class="p-linha">Celular:<sup class="asteristico">*</sup></p>
                <input type="text" id="idTelefone" name="txtTelefone" class="texto-centro-16"
                    size="16" minlength="9" maxlength="16"
					onkeydown="javascript: formatarTelefone(this);"
                    placeholder="(00) 00000-0000" required>

				<input class="w3-button w3-ripple w3-border button-entrar"
					style="margin: 15px auto;" type="submit" value="Gravar" />

				<p> </p>
			</form>
		</div>

		<p> </p>

		<script>		
			function closeMsg() {
				document.getElementById("idMsg").style.display = "none";
			}
		</script>

		<script src="../../_funcoes/_javascript/funcoes-nav-vertical.js"></script>
		<script src="../../_funcoes/_javascript/funcoes-telefone.js"></script>

		<p> </p>
	</div>

	<a href="../_login/login-home.php" class="w3-ripple button-voltar">&laquo; Anterior</a>

</div>
</body>

</html>
