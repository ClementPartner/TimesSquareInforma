<?php
	session_start();

    require_once "../../_funcoes/_php/funcoes_php.php";

	$tipo = validar_entrada($_REQUEST["tipo"]);

	if ($_POST["txtPalavra"] == $_SESSION["palavra"]){
		if ($tipo == 1) {
			header("location:../_fale-conosco/fale-conosco.php");
		}
		if ($tipo == 2) {
			header("location:../_login/login-entrar.php");
		}		
    }else{
        header("location:../../index.php");
    }
?>
