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

	/****************************************************************
		Rotina para a verificar se há algum aviso a ser mostrado
		quando o usuário entrar corretamente.
	****************************************************************/

	$abrir = "";

	if (isset($_SESSION['usuarioLeuAviso']) && (!$_SESSION['usuarioLeuAviso'])) {

		//Incluir a conexão com banco de dados.
		require_once "../../_bd/bd-config.php";
		require_once "../../_bd/bd-connection.php";
		require_once "../../_bd/bd-crud.php";

		$abrir = "openPopUp()";
	
		/* Buscar na tabela aviso o último aviso cadastrado.
		--------------------------------------------------*/
		$dados = DBRead("aviso", "Id, Titulo, Descricao, Data, Link1, Link2, Link3, Link4", 
						null, "ORDER BY Id DESC", "LIMIT 2");

		if($dados){
			$_SESSION["avisoId"] 		= $dados[0]["Id"];
			$_SESSION["avisoTitulo"] 	= $dados[0]["Titulo"];
			$_SESSION["avisoDescricao"] = $dados[0]["Descricao"];
			$_SESSION["avisoData"] 		= date_format(date_create($dados[0]["Data"]), "d/m/Y");
			$_SESSION["avisoLink1"]		= $dados[0]["Link1"];
			$_SESSION["avisoLink2"]		= $dados[0]["Link2"];
			$_SESSION["avisoLink3"]		= $dados[0]["Link3"];
			$_SESSION["avisoLink4"]		= $dados[0]["Link4"];
		} else {
			$_SESSION["avisoId"] 		= 0;
			$_SESSION["avisoTitulo"] 	= "";
			$_SESSION["avisoDescricao"] = "";
			$_SESSION["avisoData"] 		= date_format(date_create("1900-01-01"), "d/m/Y");
			$_SESSION["avisoLink1"]		= "";
			$_SESSION["avisoLink2"]		= "";
			$_SESSION["avisoLink3"]		= "";
			$_SESSION["avisoLink4"]		= "";

			$abrir = "";
		}

		/* Buscar na tabela usuário_aviso o $_SESSION['usuarioId'].
		---------------------------------------------------------*/
		$_SESSION['usuarioLeuAviso'] = true;

		$usuarioId = $_SESSION['usuarioId'];

		$dados = DBRead("usuario", "Aviso, Data_Aviso", "WHERE Id = $usuarioId");

		if (($dados) && (!empty($abrir))) {
			/* Se não existir, zerar o valor.
			-------------------------------*/
			if (empty($dados[0]["Aviso"])) {
				$dados[0]["Aviso"] = 0;
			}

			/* Verificar se o usuário já leu o aviso.
			---------------------------------------*/
			if ($dados[0]["Aviso"] >= $_SESSION["avisoId"]) {
				$abrir = "";
			} else {
				$dados = array(
					"Aviso"   	 => $_SESSION["avisoId"],
					"Data_Aviso" => date("Y-m-d")
				);
				DBUpdate("usuario", $dados, "WHERE Id = $usuarioId");
			}
		} else {
			$dados = array(
				"Aviso"   => $_SESSION["avisoId"],
				"Data"    => date("Y-m-d")
			);
			DBCreate("usuario", $dados);
		}
	}

	$_SESSION["whereLike"] = null;

	$_SESSION["aPartirDoRegistro"] = 0;
    $_SESSION["totalRegistros"] = 0;
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Moema Times Square - Login</title>

	<link rel="stylesheet" type="text/css" href="../../_css/w3.css"/>
	<link rel="stylesheet" type="text/css" href="../../_css/estilo.css"/>
	<link rel="stylesheet" type="text/css" href="../../_css/login.css"/>

    <link rel="stylesheet" type="text/css" href="../../_css/avisos-pop-up.css"/>

</head>

<body class="imagem-fundo" onload="<?php echo $abrir; ?>" >

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

		<div id="myPopUp" class="pop-up-overlay">
			<div class="pop-up-overlay-content">
				<span class="aviso">Aviso !</span>
				<a href="javascript:void(0)" class="closebtn" onclick="closePopUp()">&times;</a>
				<p class="aviso-titulo"><?php print $_SESSION["avisoTitulo"]; ?></p>
				<p class="aviso-data"><?php echo $_SESSION["avisoData"]; ?></p>
				<a href="../_avisos/aviso-completo.php" class="botao-mais" style="color: blue;">[+]</a>
			</div>
		</div>

		<button id="btnOpenNav" onclick="openNav()">☰</button> 
	</div>

	<div id="titulo02">	<span>ACESSAR</span> </div>

	<div class="box-geral">
		<div class="box-form w3-center">
			<?php if ($_SESSION['usuarioNivelAcesso'] >= 1) { ?>
				<div class="login-container">
					<a href="../_informacoes/informacoes.php"
						class="botao-home w3-ripple">INFORMAÇÕES</a><br>					
					<a href="../_negocios/negocios.php"
						class="botao-home w3-ripple">NEGÓCIOS E OPORTUNIDADES</a><br>	
					<a href="../_servicos/servicos.php"
						class="botao-home w3-ripple">SERVIÇOS</a><br>	
					<a href="../_linha-direta/linha-direta.php"
						class="botao-home w3-ripple">LINHA DIRETA COM O SÍNDICO</a><br>			
				</div>
			<?php } ?>

			<div class="login-cadastro">
				<a href="login-alterar-senha.php"
					class="botao-home w3-ripple">ALTERAR SENHA</a><br>

				<?php if ($_SESSION['usuarioNivelAcesso'] >= 1) { ?>
					<a href="login-alterar-usuario.php"
						class="botao-home w3-ripple">ALTERAR CADASTRO</a><br>					
				<?php } ?>
			</div>

			<?php if ($_SESSION['usuarioNivelAcesso'] == 0) { ?>
				<div class="login-nivel5">
					<a href="../_uploads/manter-grade.php"
						class="botao-nivel5 w3-ripple">MANUTENÇÃO DA GRADE</a><br>
				</div>
			<?php } ?>

			<?php if ($_SESSION['usuarioNivelAcesso'] >= 5) { ?>
				<div class="login-nivel5">
					<a href="login-incluir-fale-conosco.php"
						class="botao-nivel5 w3-ripple">INCLUIR USUÁRIO</a><br>
					<a href="../_uploads/manter-grade.php"
						class="botao-nivel5 w3-ripple">MANUTENÇÃO DA GRADE</a><br>

					<?php if ($_SESSION['usuarioNivelAcesso'] >= 7) { ?>
						<a href="../_fale-conosco/fale-conosco-acessar.php?origem=1"
							class="botao-home w3-ripple">Ver email´s: Fale Conosco</a><br>					
						<a href="../_fale-conosco/fale-conosco-acessar.php?origem=2"
							class="botao-home w3-ripple">Ver email´s: Requisições</a><br>		
					<?php } ?>
				</div>
			<?php } ?>

			<p> </p>
		</div>
	</div>

	<a href="login-sair.php" class="w3-ripple button-voltar">&laquo; Anterior</a>

	<p> </p>

	<script src="../../_funcoes/_javascript/funcoes-nav-vertical.js"></script>
	<script src="../../_funcoes/_javascript/funcoes-pop-up.js"></script>

</div>
</body>

</html>
