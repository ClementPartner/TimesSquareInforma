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
	/*------------------------------------------------------------*/

	if ((!isset($_SESSION["usuarioAtivo"])) ||
		($_SESSION["usuarioAtivo"] == NULL) ||
		($_SESSION["usuarioAtivo"] != "S")) {
		 $_SESSION['mensagem'] = "Usuário saiu !!!";
		header("Location: ../_login/login-entrar.php");
	}

	//------------------------------------------------------
	$origem = isset($_REQUEST["origem"]) ? ($_REQUEST["origem"]) : 0;

	if (($origem != 1) && ($origem != 2)) {
		$_SESSION['mensagem'] = "Sem origem !!!";
		header("Location: ../_login/login-sair.php");
	}

	if ($origem == 1) {
		$titulo = "Fale Conosco";
		$tabela = "faleconosco";
	}

	if ($origem == 2) {
		$titulo = "Requisições";
		$tabela = "requisicao";
	}
	//------------------------------------------------------

    if (isset($_REQUEST["envio"])) {
        $enviado = "Assunto resolvido com sucesso !!!";
    }
    else {
        $enviado = "";
    }

	$usuarioNome = isset($_SESSION["usuarioNome"]) ? $_SESSION["usuarioNome"] : "*******";	
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

	<title>Moema Times Square - <?= $titulo; ?></title>

	<link rel="stylesheet" type="text/css" href="../../_css/estilo.css"/>
	<link rel="stylesheet" type="text/css" href="../../_css/w3.css"/>
	
    <?php
        require_once "../../_bd/bd-config.php";
        require_once "../../_bd/bd-connection.php";
        require_once "../../_bd/bd-crud.php";

		require_once "../../_funcoes/_php/funcoes_php.php";

		$selecionado = validar_entrada(isset($_REQUEST["id"]) ? $_REQUEST["id"] : 0);
		
        $dados = DBRead($tabela, "*", "WHERE Id = {$selecionado}");
	?>	
</head>

<body class="imagem-fundo">

<div id="interface">
	<div id="titulo01">
		<span>TIMES SQUARE INFORME</span>

		<div id="idSidepanel" class="sidepanel">
			<a href="../_captcha/captcha-usar.php?tipo=2" class="item">LOGIN</a>
			<a href="#" class="item" onclick="alertaMenu()">INFORMAÇÕES</a>
			<a href="../_negocios/negocios.php" class="item">NEGÓCIOS E OPORTUNIDADES</a>
			<a href="#" class="item" onclick="alertaMenu()">SERVIÇOS</a>
			<a href="../_captcha/captcha-usar.php?tipo=1" class="item last-item">FALE CONOSCO</a>
		</div>

		<button id="btnOpenNav" onclick="openNav()">☰</button> 
	</div>

	<div class="box-geral">
		<div class="box-form w3-center" style="color: white; background-color: black;">
			<p><b>Data : </b><?php print $dados[0]["DataCriacao"]; ?>  </p>
			<p><b>Urgência : </b><?php print $dados[0]["Urgencia"]; ?> </p>
			<p><b>Telefone : </b><?php print $dados[0]["Telefone"]; ?> </p>

			<p class="w3-mobile estilo-margin-leftright-4"><b>Nome : </b><?php print $dados[0]["Nome"]; ?>
			<p><b>Email : </b><?php print $dados[0]["Email"]; ?></p>

			<p class="w3-mobile estilo-margin-leftright-4"><b>Mensagem : </b><?php print $dados[0]["Mensagem"]; ?><p>

			<p style="border-bottom: solid 2px red"> </p>

			<form action="fale-conosco-resolvido.php" method="post">
				<?php if ($enviado != "") { ?>
					<p class="email-enviado estilo-margin-leftright-8"><?php echo $enviado ?></p>
				<?php } else { ?>
					<?php echo $enviado ?>
				<?php } ?>

				<input type="hidden" name="txtOrigem" id="idOrigem" 
					value="<?= $origem; ?>">
				<input type="hidden" name="txtTabela" id="idTabela" 
					value='<?= $tabela; ?>'>

				<input type="hidden" name="txtId" id="idId" 
					value='<?= $dados[0]["Id"]; ?>'>
				<input type="hidden" name="txtQuando" id="idQuando"
					value="<?= date('d/m/Y'); ?>">

                <p><label class="w3-mobile estilo-margin-leftright-4" for="idQuem">Quem : </label>
					<input type="text" name="txtQuem" id="idQuem"
						value="<?php print $usuarioNome; ?>"
						size="30" maxlength="100" minlength="5"
						placeholder="Nome de quem resolveu" autofocus required></p>
                <p><label class="w3-mobile estilo-margin-leftright-4" for="idSituacao">Situação : </label><br>
					<input type="text" name="txtSituacao" id="idSituacao"
						value="Resolvido"
                        size="20" maxlength="20" minlength="5"
                        placeholder="Aberto ou Resolvido?" required></p>
                <p><label class="w3-mobile estilo-margin-leftright-4" for="idAtitude">Atitude : </label>
					<input type="text" name="txtAtitude" id="idAtitude"
                        size="30" maxlength="200" minlength="10"
                        placeholder="Qual a atitude tomada" required></p>
                <p><label class="w3-mobile estilo-margin-leftright-4" for="idComo">Como : </label>
					<input type="text" name="txtComo" id="idComo"
                        size="30" maxlength="500" minlength="10"
                        placeholder="Como foi resolvido" required></p>

				<input type="submit" name="btnEnviar" value="Enviar"
					class="w3-button w3-ripple estilo-green
						w3-margin-top estilo-margin-leftright-4
						w3-border w3-round-xlarge w3-border-green">

				<p> </p>
			</form>
		</div>

		<p> </p>
	</div>

	<a href="fale-conosco-acessar.php?origem=<?= $origem; ?>"
		class="w3-ripple button-voltar">&laquo; Anterior</a>

	<p> </p>

	<script src="../../_funcoes/_javascript/funcoes-nav-vertical.js"></script>

</div>
</body>

</html>
