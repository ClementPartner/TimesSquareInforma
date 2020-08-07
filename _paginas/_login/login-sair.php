<?php
    session_start();

    unset(
        $_SESSION['usuarioId'],
		$_SESSION['usuarioEmail'],
        $_SESSION['usuarioSenha'],
		$_SESSION['usuarioNome'],
		$_SESSION['usuarioAtivo'],
		$_SESSION['usuarioNivelAcesso']
	);

    unset(
		$_SESSION["avisoId"],
		$_SESSION["avisoTitulo"],
		$_SESSION["avisoDescricao"],
		$_SESSION["avisoData"],
		$_SESSION["avisoLink1"],
		$_SESSION["avisoLink2"],
		$_SESSION["avisoLink3"],
		$_SESSION["avisoLink4"]
	);

    //session_unset(); // Remover todas as variáveis da Sessão.
    //session_destroy(); // Destruir a session.

	header("Location: login-entrar.php");
?>
