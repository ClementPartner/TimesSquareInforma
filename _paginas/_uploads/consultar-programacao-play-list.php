<?php
session_start();

require_once "../../_funcoes/_php/funcoes_php.php";

$data = validar_entrada($_REQUEST["dia"]);

$_SESSION["dataConsultar"] = $data;
?>

<script>
    window.setTimeout("history.back(-1)", 100); // 100 milisegundos.
</script>
