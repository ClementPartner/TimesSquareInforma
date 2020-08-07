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
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Moema Times Square - Serviços</title>

	<link rel="stylesheet" type="text/css" href="../../_css/w3.css"/>
    <link rel="stylesheet" type="text/css" href="../../_css/estilo.css"/>
    <link rel="stylesheet" type="text/css" href="../../_css/fale-conosco.css"/>

    <script>
        function urgente() {
            var urg = parseInt(document.getElementById('idUrg').value);
            document.getElementById('idOutUrg').value = urg;
        }
    </script>
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

	<div id="titulo02">	<span>SERVIÇOS</span> </div>

	<div class="box-geral">
		<div class="box-form">
			<p class="linha-box-form">Requisição</p>
			<form action="../_email/fale-conosco-Email.php" method="post" oninput="urgente();">
				<input type="hidden" name="txtOrigemMsg" value="Servicos">
				<input type="hidden" name="txtNome"
					value="<?= $_SESSION['usuarioNome']; ?>">
				<input type="hidden" name="txtEmail"
					value="<?= $_SESSION['usuarioEmail']; ?>">

				<?php if (!empty($_SESSION["emailEnviado"])) { ?>
					<p id="idMsg" class="email-enviado w3-center">
						<?php echo $_SESSION["emailEnviado"]; ?></p>
					<?php $_SESSION["emailEnviado"] = ""; ?>
				<?php } ?>

				<p class="p-linha">Tipo de serviço:<sup class="asteristico">*</sup></p>
				<select id="idRequisicao" name="txtRequisicao" size="8" class="texto-centro-16"
					onclick="closeMsg()" onkeydown="closeMsg()" autofocus required>
					<option value="2ª Via do boleto" selected>2ª via do boleto</option>
					<option value="Reserva de Sala">Reserva de Sala</option>
					<option value="Mudança - Adagio">Mudança - Adagio</option>
					<option value="Mudança - Mercure">Mudança - Mercure</option>
					<option value="Mudança - Wall Street">Mudança - Wall Street</option>
					<option value="Reforma - Adagio">Reforma - Adagio</option>
					<option value="Reforma - Mercure">Reforma - Mercure</option>
					<option value="Reforma - Wall Street">Reforma - Wall Street</option>
				</select><br>

				<p class="p-linha">Grau de Urgência:
					<output for="txtUrg" name="OutUrg" id="idOutUrg">1</output></p>
				<input type="range" name="txtUrg" id="idUrg" class="texto-centro-16"
					min="0" max="10" step="1" value="1" />

				<p class="p-linha">Mensagem:<sup class="asteristico">*</sup></p>
				<textarea name="txtMsg" rows="5" cols="30" class="texto-centro-16"
                        maxlength="1000" required
                        placeholder="Mensagem (até 1000 caracteres)"></textarea>

				<input class="w3-button w3-ripple w3-border button-entrar"
					style="margin: 15px auto;" type="submit" value="Enviar" />
			</form>
			<p> </p>
		</div>
	</div>

	<a href="telefones.php?tipo=1" class="botao-reparo w3-ripple" style="margin-top: 20px;">
		RESTAURANTE</a><br>
	<a href="telefones.php?tipo=2" class="botao-reparo w3-ripple">
		ESTACIONAMENTO</a><br>
	<a href="telefones.php?tipo=3" class="botao-reparo w3-ripple">
		FRAN´S CAFÉ</a><br>
	<a href="telefones.php?tipo=4" class="botao-reparo w3-ripple">
		SALÃO DE BELEZA</a><br>

	<a href="reparos-emergenciais.php" class="botao-reparo w3-ripple">
		REPAROS EMERGENCIAIS</a><br>					

	<a href="../_login/login-home.php" class="w3-ripple button-voltar">&laquo; Anterior</a>

	<script>
		function closeMsg() {
			document.getElementById("idMsg").style.display = "none";
		}
	</script>

	<script src="../../_funcoes/_javascript/funcoes-nav-vertical.js"></script>

</div>
</body>

</html>
