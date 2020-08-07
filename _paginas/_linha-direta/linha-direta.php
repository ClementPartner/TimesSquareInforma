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

    <title>Moema Times Square - Linha Direta</title>

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

	<div id="titulo02">	<span>LINHA DIRETA COM O SÍNDICO</span> </div>

	<div class="box-geral">
		<div class="box-form">
			<p class="linha-box-form">Solicitação</p>
			<form action="../_email/fale-conosco-Email.php" method="post" oninput="urgente();"
					 enctype="multipart/form-data">

				<input type="hidden" name="txtOrigemMsg" value="Linha Direta">
				<input type="hidden" name="txtNome"
					value="<?= $_SESSION['usuarioNome']; ?>">
				<input type="hidden" name="txtEmail"
					value="<?= $_SESSION['usuarioEmail']; ?>">
				<input type="hidden" name="txtFoto" id="idFoto">

				<?php if (!empty($_SESSION["emailEnviado"])) { ?>
					<p id="idMsg" class="email-enviado w3-center">
						<?php echo $_SESSION["emailEnviado"]; ?></p>
					<?php $_SESSION["emailEnviado"] = ""; ?>
				<?php } ?>

				<p class="p-linha">Tipo de solicitação:<sup class="asteristico">*</sup></p>
				<select id="idRequisicao" name="txtRequisicao" size="3" class="texto-centro-16"
					onclick="closeMsg()" onkeydown="closeMsg()" autofocus required>
					<option value="Reclamação" selected>Reclamação</option>
					<option value="Sugestão">Sugestão</option>
					<option value="Outra solicitação">Outra solicitação</option>
					<option value="Enquetes">Enquetes</option>
				</select><br>

				<p class="p-linha">Grau de Urgência:
					<output for="txtUrg" name="OutUrg" id="idOutUrg">1</output></p>
				<input type="range" name="txtUrg" id="idUrg" class="texto-centro-16"
					onclick="closeMsg()" onkeydown="closeMsg()"
					min="0" max="10" step="1" value="1" />

				<p class="p-linha">Mensagem:<sup class="asteristico">*</sup></p>
				<textarea name="txtMsg" rows="5" cols="30" class="texto-centro-16"
					onclick="closeMsg()" onkeydown="closeMsg()"
					placeholder="Mensagem (até 1000 caracteres)"
                    maxlength="1000" required></textarea>

				<p id="idMsgAnexo" class="w3-center">Foto anexa:</p>

				<input type="button" id="idAnexarFoto" href="#" class="botao-anexar-foto w3-ripple"
					onclick="anexarFoto()" value="Anexar até 5 fotos">					

				<input type="file" id="idArqsFotos" name="txtArqsFotos[]" class="texto-centro-24"
					multiple accept="image/*" onchange="VerFoto()"><br>

				<input class="w3-button w3-ripple w3-border button-entrar"
					style="margin: 15px auto;" type="submit" value="Enviar" />
			</form>
			<p> </p>
		</div>
	</div>

	<a href="../_login/login-home.php" class="w3-ripple button-voltar">&laquo; Anterior</a>

	<script src="../../_funcoes/_javascript/funcoes-nav-vertical.js"></script>
	<script src="../../_funcoes/_javascript/funcoes-linha-direta.js"></script>

</div>
</body>

</html>
