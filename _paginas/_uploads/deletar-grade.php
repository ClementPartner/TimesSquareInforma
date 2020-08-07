<?php
		require_once "../../_bd/bd-config.php";
		require_once "../../_bd/bd-connection.php";
		require_once "../../_bd/bd-crud.php";

	$where = $_REQUEST["reg"];
	$where = "WHERE Id = $where";

	DBDelete("grade", "$where");
?>

<script>
    window.setTimeout("history.back(-1)", 200); // 200 milisegundos.
</script>
