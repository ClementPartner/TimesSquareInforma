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

	<div id="titulo02">	<span>CRIAR LOGIN</span> </div>

	<div class="box-geral">
		<div class="box-form">
			<p class="linha-box-form">Dados</p>
			<form action="login-crud.php" method="post" onsubmit="return validarSenhasCPFCNPJ()">

                <input type="hidden" name="txtCrud"  value="alterar">
				<input type="hidden" name="txtAtivo" value="S">
                <input type="hidden" name="txtNivel" value="1">

				<span id="idMsg"><?php print $mensagem; ?></span>

				<p class="p-linha">Email:<sup class="asteristico">*</sup></p>
				<input type="email" id="idEmail" name="txtEmail" class="texto-centro-16"
					size="50" minlength="8" maxlength="100"
					value="<?= $_SESSION['usuarioEmail']; ?>"
					placeholder="Entre com seu email" required readonly>

				<p class="p-linha">Nome:<sup class="asteristico">*</sup></p>
                <input type="text" id="idNome" name="txtNome" class="texto-centro-16"
                    size="30" minlength="10" maxlength="50"
					onclick="closeMsg()" onkeydown="closeMsg()"
                    placeholder="Nome completo" autofocus required>

				<p class="p-linha">Senha:<sup class="asteristico">*</sup></p>
				<input type="password" id="idSenha" name="txtSenha" class="texto-centro-16"
					size="10" minlength="8" maxlength="20"
					pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
					title="Deve ter no mínimo 8 caracteres, contendo pelo menos um número, uma letra maiúscula e uma minúscula."
					onclick="closeMsg()" onkeydown="closeMsg()"
					placeholder="Sua senha" required>

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

				<p class="p-linha">Tipo:<sup class="asteristico">*</sup></p>				
				<select id="idTipoUsuario" name="txtTipoUsuario" class="texto-centro-16"
					 size="4" required>
						<option value="Empresa" selected>Empresa</option>
						<option value="Inquilino">Inquilino</option>
						<option value="Hospede">Hospede</option>
						<option value="Morador">Morador</option>
				</select>

				<p class="p-linha">Unidade:<sup class="asteristico">*</sup></p>
				<select id="idBloco" name="txtBloco" class="texto-centro-16"
					size="3" required>
						<option value="Mercure" selected>Mercure</option>
						<option value="Adagio">Adagio</option>
						<option value="Wall Street">Wall Street</option>
				</select>

                <input type="text" id="idUnidade" name="txtUnidade" class="texto-centro-16"
                    size="20" minlength="2" maxlength="20" style="margin-top: 8px;"
                    placeholder="Unidade que ocupa" required>

				<p class="p-linha">Tipo de Pessoa:<sup class="asteristico">*</sup></p>
				<select id="idTipoPessoa" name="txtTipoPessoa" size="3" class="texto-centro-16"
					onchange="mostrarCPFCNPJ()" required>
						<option value="Fisica" selected>Fisica</option>
						<option value="Juridica">Juridica</option>
						<option value="Passaporte">Passaporte</option>
				</select>

				<p id="idTextoCPFCNPJ" class="p-linha">CPF:<sup class="asteristico">*</sup></p>
                <input type="text" id="idCPFCNPJ" name="txtCPFCNPJ" class="texto-centro-16"
                    size="20" minlength="10" maxlength="18"
					onkeydown="javascript: formatarCPFCNPJ(this);"
					   onblur="javascript: testarCPFCNPJ();"
                    placeholder="CPF / CNPJ" required>

				<p class="p-linha">Data de aniversário:<sup class="asteristico">*</sup></p>
                <input type="date" id="idNascimento" name="txtNascimento" class="texto-centro-16"
                    size="10" minlength="8" maxlength="10"
					min="1900-01-01" max="2010-12-31"
                    placeholder="dd/mm/aaaa" required>

				<p class="p-linha">Atividade:</p>
                <input type="text" id="idAtividade" name="txtAtividade" class="texto-centro-16"
                    size="30" minlength="5" maxlength="200"
                    placeholder="Atividade profissional">

				<p class="p-linha">Endereço:</p>
                <input type="text" id="idEndereco" name="txtEndereco" class="texto-centro-16"
                    size="30" minlength="10" maxlength="200"
                    placeholder="Endereço completo">

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
			function validarSenhasCPFCNPJ() {
				if (! senhasIguais()) {
					return false;
				}
				
				if (! testarCPFCNPJ()) {
					alert("CPF / CNPJ inválido !!! Redigite-o...");
					document.getElementById("idCPFCNPJ").focus();
					return false;
				} else {
					return true;
				}
			}			

			function closeMsg() {
				document.getElementById("idMsg").style.display = "none";
			}
		</script>

		<script src="../../_funcoes/_javascript/funcoes-nav-vertical.js"></script>
		<script src="../../_funcoes/_javascript/funcoes-senha.js"></script>
		<script src="../../_funcoes/_javascript/funcoes-cpf-cnpj.js"></script>
		<script src="../../_funcoes/_javascript/funcoes-telefone.js"></script>

		<p> </p>
	</div>

	<a href="../_login/login-sair.php" class="w3-ripple button-voltar">&laquo; Anterior</a>

</div>
</body>

</html>
