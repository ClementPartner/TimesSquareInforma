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

<body class="estilo-wine">
<div id="interface">
	<div class="w3-container w3-green">
		<div class="w3-row">
			<div  class="w3-quarter">
				<img id="logotipo" src="../../__cliente/_imagens/timessquare-bg.jpg"
					 alt="Logotipo">
			</div>
			
			<div class="w3-threequarter w3-text-white">
				<h1 class="w3-xlarge w3-center" 
					style="text-shadow:1px 2px 0 #00FF00">VERIFICAÇÃO:</h1>
		
				<a href="../../index.php" class="w3-right w3-button w3-ripple estilo-green
					w3-mobile w3-margin-top estilo-margin-leftright-4
					w3-border w3-round-xlarge w3-border-green">&laquo; Voltar</a>
			</div>
		</div>
	</div>

	<div style="margin-top: 16px;">
		<div class="w3-mobile" style="margin-left: 100px;
				min-width: 700px; background-color: black; padding: 24px 10px;
						">
			<p style="padding-left: 16px; font-size: 18px; margin: auto;"
				>Preencha com os caracteres do Captcha</p>

		</div>
	</div>

	<div style="margin-top: 32px; display: flex; justify-content: center;">
		<div style="width: 320px; background-color: #f5f5f5;">
			<p style="color: black; font-size: 24px; margin: 16px;
				border-bottom: 1px solid #ddd;">Captcha</p>
			<img style="display: block; margin-left: auto; margin-right: auto;" 
					src="captcha-montar.php?l=220&a=60&tf=30&ql=5">

			<form action="captcha-validar.php?tipo=<?php print $tipo; ?>"
				name="form" method="post" style="margin-top: 16px;">
				<input type="text" name="txtPalavra"
					size="15" maxlength="5" minlength="5"
					style="display: block; margin-left: auto; margin-right: auto;
						font-size: 24px;"
					placeholder="Digite o captcha" autofocus required><br>
				<input class="w3-button w3-ripple w3-border w3-round-xlarge" 
					style="display: block; margin-left: auto; margin-right: auto;
						font-size: 24px; background-color: black; color: white;"
					type="submit" value="Entrar" />
			</form>
			<p> </p>
		</div>
	</div>

	<a href="../../index.php" class="w3-button w3-ripple w3-mobile"
		style="display: block; margin-left: auto; margin-right: auto; margin-top: 16px;
			width: 150px; font-size: 24px; background-color: black; color: white;">&laquo; Anterior</a>

		<!------------------------------------------------------------------------
		<form action="captcha-validar.php?tipo=<?php print $tipo; ?>"
			name="form" method="post" class="w3-center estilo-green w3-mobile w3-padding
				w3-border w3-round-xlarge w3-border-green">
			<p class="w3-large w3-center w3-text-white">Preencha com os caracteres do Captcha</p>
			<img src="captcha-montar.php?l=150&a=50&tf=20&ql=5">
			<input type="text" name="txtPalavra"
				size="10" maxlength="5" minlength="5" autofocus required>
			<input class="w3-button w3-ripple w3-mobile estilo-margin-leftright-4
					w3-border w3-round-xlarge w3-border-green" 
				style="background-color: orange;" type="submit" value="Validar Captcha" />
		</form>
		------------------------------------------------------------------------>
		<p> </p>
</div>
</body>

</html>
