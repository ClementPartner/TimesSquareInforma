<?php
    session_start();

	/*------------------------------------------------------------*/

	if ((isset($_SESSION["usuarioAtivo"])) &&
		($_SESSION["usuarioAtivo"] == "S")) {
		header("Location: ../_login/login-home.php");
	}

	/*------------------------------------------------------------*/

	if(!isset($_COOKIE["MTSLembrar"])) {
		$lembrarUser = "";
	} else {
		$lembrarUser = $_COOKIE["MTSLembrar"];
	}

	if (!empty($lembrarUser)) {
		$lembrarClass = "lembrarse";
	} else {
		$lembrarClass = "naolembrarse";
	}
	/*------------------------------------------------------------*/

    require_once "../../_funcoes/_php/funcoes_php.php";

    $mensagem = isset(  $_SESSION['mensagem']) ?
        validar_entrada($_SESSION['mensagem']) : "";
    $_SESSION['mensagem'] = "";

	/*------------------------------------------------------------*/

	$_SESSION["usuarioEmail"] = "";

	if (empty($_SESSION["novoUsuario"]) && empty($_SESSION["senhaErrada"])) {
		$_SESSION["usuarioEmail"] = $lembrarUser;
		$txtEmail = $lembrarUser;
	}

	if (!empty($_SESSION["novoUsuario"])) {
		$_SESSION["usuarioEmail"] = $_SESSION["novoUsuario"];
		$txtEmail = $_SESSION["novoUsuario"];
		$lembrarClass = "naolembrarse";
	}

	if (!empty($_SESSION["senhaErrada"])) {
		$_SESSION["usuarioEmail"] = $_SESSION["senhaErrada"];
		$txtEmail = $_SESSION["senhaErrada"];
	}
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Moema Times Square - Login</title>

	<link rel="stylesheet" type="text/css" href="../../_css/w3.css"/>
    <link rel="stylesheet" type="text/css" href="../../_css/estilo.css"/>
    <link rel="stylesheet" type="text/css" href="../../_css/login.css">
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

	<div id="titulo02">	<span>ENTRAR</span> </div>

	<div class="box-geral">
		<div class="box-form">
			<p class="linha-box-form">Login</p>

			<form action="login-validar.php" method="post">

                <input type="hidden" name="txtLembrar" id="idTxtLembrar"
					value="<?= $lembrarClass; ?>">

				<p class="p-linha">Email:<sup class="asteristico">*</sup></p>
				<input type="email" id="idEmail" name="txtEmail" class="texto-centro-16"
						value="<?= $txtEmail; ?>"
					onclick="closeMsg()" onkeydown="closeMsg()"
					size="50" minlength="8" maxlength="100"
					placeholder="Digite seu email" autofocus required>

				<p class="p-linha">Senha:<sup class="asteristico">*</sup></p>
				<input type="password" id="idSenha" name="txtSenha" class="texto-centro-16"
					size="15" minlength="8" maxlength="20"
					placeholder="Sua senha" required>

				<?php if($lembrarClass == "lembrarse") { ?>
					<a href="#" id="idLembrar" class="<?= $lembrarClass; ?>"
						onclick="altLembrar()"> Lembrar de mim</a>
				<?php } else { ?>
					<a href="#" id="idLembrar" class="<?= $lembrarClass; ?>"
						onclick="altLembrar()"> Não lembrar de mim</a>
				<?php } ?>

				<?php if(!empty($mensagem)) { ?>
					<p id="idMsg" class="mensagem w3-center"><?= $mensagem; ?>
						<?php $mensagem = ""; ?>
						<?php if(!empty($_SESSION["novoUsuario"])) { ?>
							<br><a class="incluir-usuario w3-center"
								href="#" onclick="alertaIncluir()">Incluir ?</a>
							<?php $_SESSION["novoUsuario"] = ""; ?>
						<?php } ?>

						<?php if (!empty($_SESSION["senhaErrada"])) { ?>
							<br><a class="incluir-usuario w3-center"
								href="login-enviar-senha.php?tipo=2">Enviar nova senha ?</a>
							<?php $_SESSION["senhaErrada"] = ""; ?>
						<?php } ?>
					</p>
				<?php } else { ?>
					<?php $mensagem = ""; 
						  $_SESSION["novoUsuario"] = "";
						  $_SESSION["senhaErrada"] = ""; ?>
				<?php } ?>

				<input class="w3-button w3-ripple w3-border button-entrar" 
					type="submit" value="Entrar" />
			</form>

			<p> </p>
		</div>
	</div>

	<a href="../../index.php" class="w3-ripple button-voltar">&laquo; Anterior</a>

	<p> </p>

	<script>
		function closeMsg() {
			document.getElementById("idMsg").style.display = "none";
		}

		function alertaIncluir() {
			alert("Favor solicitar a sua inclusão\n\natravés do menu FALE CONOSCO !!!");
		}
	</script>

	<script src="../../_funcoes/_javascript/funcoes-nav-vertical.js"></script>
	<script src="../../_funcoes/_javascript/funcoes-lembrar.js"></script>

</div>
</body>

</html>
