<?php
	require_once "../../_funcoes/_php/funcoes_php.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$id       = validar_entrada($_REQUEST["txtId"]);
		$quando   = validar_entrada($_REQUEST["txtQuando"]);
		$quem     = validar_entrada($_REQUEST["txtQuem"]);
		$situacao = validar_entrada($_REQUEST["txtSituacao"]);
		$atitude  = validar_entrada($_REQUEST["txtAtitude"]);
		$como     = validar_entrada($_REQUEST["txtComo"]);
		$tabela   = validar_entrada($_REQUEST["txtTabela"]);
		$origem   = validar_entrada($_REQUEST["txtOrigem"]);
	} else {
		$id       = 0;
		$quando   = "";
		$quem     = "";
		$situacao = "";
		$atitude  = "";
		$como     = "";
		$tabela   = "";
		$origem   = "";
	}

	if (!empty($quem) && !empty($situacao)) {

		require_once "../../_bd/bd-config.php";
        require_once "../../_bd/bd-connection.php";
        require_once "../../_bd/bd-crud.php";

		$registro = array(
			"ResolvidoQuando"  => date("Y-m-d"),
			"ResolvidoQuem"    => $quem,
            "Situacao"         => $situacao,
			"ResolvidoAtitude" => $atitude,
			"ResolvidoComo"    => $como
		);

		DBUpdate($tabela, $registro, " WHERE Id = {$id}");

		header("location:fale-conosco-editar.php?envio=enviado&origem=$origem");
	}
?>
