<?php
    session_start();

	//Incluir a conexão com banco de dados.
    require_once "../../_bd/bd-config.php";
    require_once "../../_bd/bd-connection.php";
    require_once "../../_bd/bd-crud.php";

    require_once "../../_funcoes/_php/funcoes_php.php";

	$_SESSION["whereLike"] = null;

	$_SESSION["aPartirDoRegistro"] = 0;
    $_SESSION["totalRegistros"] = 0;

    $pesquisar = (isset($_REQUEST["txtPesquisar"])) ? $_REQUEST["txtPesquisar"] : "";
	
	$pesquisar = DBEscape(validar_entrada($pesquisar));

	if (!empty($pesquisar)) {
		$_SESSION["whereLike"] = " AND Atividade LIKE '%$pesquisar%'";
	}
?>
			
<script>
    window.setTimeout("history.back(-1)", 100); // 100 milisegundos.
</script>
