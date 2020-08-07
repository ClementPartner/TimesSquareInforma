<?php
    require_once "../../_funcoes/_php/funcoes_php.php";

	$tipo = validar_entrada($_REQUEST["tipo"]);

	/*----------------------------------------------------------
	Se for usar verificação com captcha, usar o comando abaixo.
	------------------------------------------------------------

	header("location:captcha-digitar.php?tipo=$tipo");

	/*------------------------------------------------------*/

	/*--------------------------------------------------------
	Se não for usar verificação com captcha, usar o comando
			abaixo.
	--------------------------------------------------------*/
	if ($tipo == 1) {
		header("location:../_fale-conosco/fale-conosco.php");
	}
	if ($tipo == 2) {
		header("location:../_login/login-entrar.php");
	}		
?>
