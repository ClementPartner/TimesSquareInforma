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

	if ((!isset($_SESSION["usuarioId"])) ||
		($_SESSION["usuarioId"] == NULL) ||
		(empty($_SESSION["usuarioId"]))  ||
		($_SESSION["usuarioId"] < 1)) {
		 $_SESSION['mensagem'] = "Usuário saiu !!!";
		header("Location: ../_login/login-entrar.php");
	}

    require_once "../../_funcoes/_php/funcoes_php.php";

	$id		  = isset(  $_SESSION['usuarioId']) ?
		validar_entrada($_SESSION['usuarioId']) : 0;
	$email    = isset(  $_SESSION['usuarioEmail']) ?
		validar_entrada($_SESSION['usuarioEmail']) : "***";
	$senha      = isset($_SESSION['usuarioSenha']) ?
		validar_entrada($_SESSION['usuarioSenha']) : "";
	$nome     = isset(  $_SESSION['usuarioNome'])  ?
		validar_entrada($_SESSION['usuarioNome'])  : "***";
	$ativo    = isset(  $_SESSION['usuarioAtivo']) ?
		validar_entrada($_SESSION['usuarioAtivo']) : "N";
	$nivel    = isset(  $_SESSION['usuarioNivelAcesso']) ?
		validar_entrada($_SESSION['usuarioNivelAcesso']) : 1;
    $tipo       = isset($_SESSION['usuarioTipoUsuario']) ?
		validar_entrada($_SESSION['usuarioTipoUsuario']) : "";
	$pessoa     = isset($_SESSION['usuarioTipoPessoa'])	 ?
		validar_entrada($_SESSION['usuarioTipoPessoa']) : "Fisica";
    $cpfcnpj    = isset($_SESSION['usuarioCPFCNPJ'])	 ?
		validar_entrada($_SESSION['usuarioCPFCNPJ']) : "";
    $atividade  = isset($_SESSION['usuarioAtividade'])	 ?
		validar_entrada($_SESSION['usuarioAtividade']) : "";
    $endereco   = isset($_SESSION['usuarioEndereco'])	 ?
		validar_entrada($_SESSION['usuarioEndereco']) : "";
    $telefone   = isset($_SESSION['usuarioTelefone'])	 ?
		validar_entrada($_SESSION['usuarioTelefone']) : "";
    $bloco	    = isset($_SESSION['usuarioBloco'])		 ?
		validar_entrada($_SESSION['usuarioBloco'])	  : "";
    $unidade    = isset($_SESSION['usuarioUnidade'])	 ?
		validar_entrada($_SESSION['usuarioUnidade'])  : "";
    $nascimento = isset($_SESSION['usuarioAniversario']) ?
		validar_entrada($_SESSION['usuarioAniversario']) : "2000-01-01";
    $cadastro 	= isset($_SESSION['usuarioCadastro'])	 ?
		validar_entrada($_SESSION['usuarioCadastro']) : date("Y-m-d");
    $ultAcesso  = isset($_SESSION['usuarioUltAcesso'])	 ?
		validar_entrada($_SESSION['usuarioUltAcesso']) : date("Y-m-d");

    $mensagem = isset(  $_SESSION['mensagem']) ?
        validar_entrada($_SESSION['mensagem']) : "";
	$_SESSION['mensagem'] = "";
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Moema Times Square - Alterar senha</title>

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
			<p class="linha-box-form">Sua senha</p>

			<form action="login-crud.php" method="post" onsubmit="return senhasIguais()">
                <input type="hidden" name="txtCrud"  			value="alterar">
				<input type="hidden" name="txtEmail" 			value="<?= $email; ?>">
				<input type="hidden" name="txtNome"  			value="<?= $nome;  ?>">
				<input type="hidden" name="txtAtivo" 			value="<?= $ativo; ?>">
				<input type="hidden" name="txtNivel" 			value="<?= $nivel; ?>">	
				<input type="hidden" name="txtTipoUsuario"		value="<?= $tipo; ?>">
				<input type="hidden" name="txtTipoPessoa"		value="<?= $pessoa; ?>">	
				<input type="hidden" name="txtCPFCNPJ"			value="<?= $cpfcnpj; ?>">	
				<input type="hidden" name="txtAtividade"		value="<?= $atividade; ?>">	
				<input type="hidden" name="txtEndereco"			value="<?= $endereco; ?>">	
				<input type="hidden" name="txtTelefone"			value="<?= $telefone; ?>">	
				<input type="hidden" name="txtBloco"			value="<?= $bloco; ?>">	
				<input type="hidden" name="txtUnidade"			value="<?= $unidade; ?>">	
				<input type="hidden" name="txtNascimento"		value="<?= $nascimento; ?>">	
				<input type="hidden" name="txtDataCadastro"		value="<?= $cadastro; ?>">	
				<input type="hidden" name="txtDataUltAcesso"	value="<?= $ultAcesso; ?>">	

				<span id="idMsg"><?php print $mensagem; ?></span>

				<p class="p-linha">Senha:<sup class="asteristico">*</sup></p>
				<input type="password" id="idSenha" name="txtSenha" class="texto-centro-16"
					size="10" minlength="8" maxlength="20"
					pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
					title="Deve ter no mínimo 8 caracteres, contendo pelo menos um número, uma letra maiúscula e uma minúscula."
					onclick="closeMsg()" onkeydown="closeMsg()"
					placeholder="Sua senha" autofocus required>

				<p class="p-linha">Confirmar senha:<sup class="asteristico">*</sup></p>
				<input type="password" id="idSenha2" name="txtSenha2" class="texto-centro-16"
					size="10" minlength="8" maxlength="20"
					pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
					title="Deve ter no mínimo 8 caracteres, contendo pelo menos um número, uma letra maiúscula e uma minúscula."
					placeholder="Redigite-a..." required>

				<span id="idDiferentes">Senhas diferentes! Redigite-as...</span>

                <div class="w3-center">
                    <div id="idDivValidacao">
                        <h3>A senha deve conter o seguinte:</h3>
                        <p> </p>
                        <p id="idMinuscula" class="invalida">Uma letra <b>minúscula</b></p>
                        <p id="idMaiuscula" class="invalida">Uma letra <b>Maiúscula</b></p>
                        <p id="idNumero"    class="invalida">Um  <b>número</b></p>
                        <p id="idTamanho"   class="invalida">Mínimo de <b>8 caracteres</b></p>
                        <p id="idIguais"    class="invalida invisivel">Senhas digitadas <b>iguais</b></p>
                    </div>
                </div>

				<input class="w3-button w3-ripple w3-border button-entrar"
					style="margin: 15px auto;" type="submit" value="Gravar" />

				<p> </p>
			</form>
		</div>

		<p> </p>

		<script src="../../_funcoes/_javascript/funcoes-nav-vertical.js"></script>
		<script src="../../_funcoes/_javascript/funcoes-senha.js"></script>

		<script>
			function closeMsg() {
				document.getElementById("idMsg").style.display = "none";
			}
		</script>

		<p> </p>
	</div>

	<a href="../_login/login-home.php" class="w3-ripple button-voltar">&laquo; Anterior</a>

</div>
</body>

</html>
