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
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Moema Times Square - Aviso</title>

	<link rel="stylesheet" type="text/css" href="../../_css/w3.css"/>
	<link rel="stylesheet" type="text/css" href="../../_css/estilo.css"/>
	<link rel="stylesheet" type="text/css" href="../../_css/login.css"/>

    <link rel="stylesheet" type="text/css" href="../../_css/avisos-pop-up.css"/>

</head>

<body class="imagem-fundo">
<div id="interface">
	<div id="titulo01">
		<span>TIMES SQUARE INFORME</span>
	</div>

	<div id="titulo02">	<span>AVISO</span> </div>

<div class="box-geral">
	<div class="aviso-completo-container">
		<p class="aviso2">Aviso !</p>
		<p class="aviso-titulo2"><?php print $_SESSION["avisoTitulo"]; ?></p>
		<p class="aviso-descricao"><?php print $_SESSION["avisoDescricao"]; ?></p>

		<div class="aviso-galeria">
			<img class="aviso-imagem" src="<?php echo $_SESSION["avisoLink1"]; ?>">
			<img class="aviso-imagem" src="<?php echo $_SESSION["avisoLink2"]; ?>">
			<img class="aviso-imagem" src="<?php echo $_SESSION["avisoLink3"]; ?>">
			<img class="aviso-imagem" src="<?php echo $_SESSION["avisoLink4"]; ?>">
		</div>
	</div>
</div>

<a href="../_login/login-home.php" class="w3-ripple button-voltar">&laquo; Anterior</a>

</body>
</html>
