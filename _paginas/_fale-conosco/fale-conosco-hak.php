<?php
    session_start();

    if(!isset($_COOKIE["Moema"])) {
		setcookie("Moema", "", time() - 86400);
		
		header("location:../../index.php");
	}
	else {
		if(count($_COOKIE) <= 0) {
			setcookie("Moema", "", time() - 86400);
		
			header("location:../../index.php");			
		}
	}
	/*-------------------------------------------*/

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

<body class="estilo-wine">
<div id="interface">
	<div class="w3-container estilo-green">
		<div class="w3-row">
			<div  class="w3-quarter">
				<img id="logotipo" src="../../__cliente/_imagens/timessquare-bg.jpg"
					 alt="Logotipo do Moema Times Square">
			</div>
			
			<div class="w3-threequarter w3-text-white">
				<h1 class="w3-xlarge" 
					style="text-shadow:1px 2px 0 #00FF00">FALE CONOSCO:</h1>
		
				<a href="../../index.php" class="w3-right w3-button w3-ripple estilo-green
					w3-mobile w3-margin-top estilo-margin-leftright-4
					w3-border w3-round-xlarge w3-border-green">Voltar</a>
			</div>
		</div>

        <form id="formContato" class="w3-responsive w3-mobile"
			action="../_email/fale-conosco-Email.php" method="post" oninput="urgente();">

            <input type="hidden" name="txtOrigemMsg" value="Fale Conosco">

			<?php if (!empty($_SESSION["emailEnviado"])) { ?>
				<p class="email-enviado w3-center"><?php echo $_SESSION["emailEnviado"]; ?></p>
				<?php $_SESSION["emailEnviado"] = ""; ?>
			<?php } ?>

            <fieldset><legend>Formulário de contato</legend>
                <p><label for="idNome">Nome:<sup class="asteristico">*</sup> </label>
					<input type="text" name="txtNome" id="idNome"
						size="40" maxlength="50" minlength="3"
						placeholder="Nome completo" autofocus required></p>

                <p><label for="idEmail">E-mail:<sup class="asteristico">*</sup> </label>
                    <input type="email" name="txtEmail" id="idEmail"
                        size="32" maxlength="100" minlength="8"
                        placeholder="Entre com um e-mail válido" required></p>

                <p><label for="idTelefone">Celular:<sup class="asteristico">*</sup> </label>
                    <input type="text" name="txtTelefone" id="idTelefone"
						size="16" minlength="9" maxlength="16"
						onkeydown="javascript: formatarTelefone(this);"
						placeholder="(00) 00000-0000" required></p>

                <p><label for="idUrg">Grau de Urgência: </label>
					<output for="txtUrg" name="OutUrg" id="idOutUrg">1</output></p>
                <p>Mín <input type="range" name="txtUrg" id="idUrg"
                        min="0" max="10" step="1" value="1"> Máx </p>

                <p><label>Mensagem:<sup class="asteristico">*</sup> </label></p>
                <p><textarea name="txtMsg" rows="5" cols="30"
                        maxlength="1000" required
                        placeholder="Mensagem (até 1000 caracteres)"></textarea></p>
            </fieldset>

            <input class="enviar" style="padding-left:10px;" type="image" name="btnEnviar"
					src="../../__cliente/_imagens/botao-enviar.png">
        </form>
		<p> </p>

		<script src="../../_funcoes/_javascript/funcoes-telefone.js"></script>

	</div>
</div>
</body>

</html>
