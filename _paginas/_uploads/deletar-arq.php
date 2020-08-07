<?php
$dir = $_REQUEST["dir"];
$arq = $_REQUEST["arq"];

require_once "../../_bd/bd-config.php";
require_once "../../_bd/bd-connection.php";
require_once "../../_bd/bd-crud.php";

/*-----------------------------------------------
	Deletar todos os registros cujos Videos
	sejam = ao $arq enviado.
-----------------------------------------------*/

$where = "WHERE Video = '$arq'";
	
$deletou = DBDelete("grade", $where);
/*-----------------------------------------------*/

if ($deletou) {
	unlink($dir . $arq);
}
?>

<script>
    window.setTimeout("history.back(-1)", 200); // 200 milisegundos.
</script>
