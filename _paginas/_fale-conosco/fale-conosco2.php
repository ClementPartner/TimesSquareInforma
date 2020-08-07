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
    }
	/*------------------------------------------------------------*/

    require_once "../../_funcoes/_php/funcoes_php.php";
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Moema Times Square - Fale conosco</title>

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

	<div id="titulo02">	<span>FALE CONOSCO</span> </div>

	<div style="margin-top: 16px;">
		<p class="preencher-captcha">Deixe a sua mensagem</p>
		<p class="preencher-nada"></p>
	</div>

	<div class="box-geral">
		<div class="box-form">
			<p class="linha-box-form">Mensagem</p>

			<form action="../_email/fale-conosco-Email.php" method="post" oninput="urgente();">
				<input type="hidden" name="txtOrigemMsg" value="Fale Conosco">

				<?php if (!empty($_SESSION["emailEnviado"])) { ?>
					<p id="idMsg" class="email-enviado w3-center">
						<?php echo $_SESSION["emailEnviado"]; ?></p>
					<?php $_SESSION["emailEnviado"] = ""; ?>
				<?php } ?>

				<p class="p-linha">Nome:<sup class="asteristico">*</sup></p>
				<input type="text" name="txtNome" id="idNome" class="texto-centro-16"
					size="40" maxlength="50" minlength="3"
					onclick="closeMsg()" onkeydown="closeMsg()"
					placeholder="Nome completo" autofocus required />

				<p class="p-linha">E-mail:<sup class="asteristico">*</sup></p>
				<input type="email" name="txtEmail" id="idEmail" class="texto-centro-16"
					size="32" maxlength="100" minlength="8"
					placeholder="Entre com um e-mail válido" required />

				<p class="p-linha">Celular:<sup class="asteristico">*</sup></p>
				<input type="text" name="txtTelefone" id="idTelefone" class="texto-centro-16"
					size="16" minlength="9" maxlength="16"
					onkeydown="javascript: formatarTelefone(this);"
					placeholder="(00) 00000-0000" required>

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

	<a href="../../index.php" class="w3-ripple button-voltar">&laquo; Anterior</a>

	<script>
		function closeMsg() {
			document.getElementById("idMsg").style.display = "none";
		}
	</script>

	<script src="../../_funcoes/_javascript/funcoes-telefone.js"></script>
	<script src="../../_funcoes/_javascript/funcoes-nav-vertical.js"></script>

</div>
</body>

</html>
