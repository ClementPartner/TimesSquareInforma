<?php

$dataHora0 = date("Y-m-d H:i:s");
$dataHoraBrasil = strtotime("-3 hour", strtotime($dataHora0));

$data = date("Y-m-d", $dataHoraBrasil);
$hora = date("H", $dataHoraBrasil);

$horaInicialTab = $hora . ":00:00";

$_SESSION["gradeDataCriacao"] = $data;
$_SESSION["gradeHoraFinal"]   = $hora . ":59:59";

require_once "../../_bd/bd-config.php";
require_once "../../_bd/bd-connection.php";
require_once "../../_bd/bd-crud.php";

$where  = " WHERE DataInicial <= '$data'";
$where .= "   AND DataFinal   >= '$data'";
$where .= "   AND HoraInicial  = '$horaInicialTab' ";

$ordem  = "ORDER BY Id";

$totalRegistros = DBRead("grade", "COUNT(*)", $where, null, null);
$totalRegistros = $totalRegistros[0]["COUNT(*)"];

$_SESSION["gradeQtdeVideos"] = $totalRegistros;

$dados = DBRead("grade", "Diretorio, Video", $where, $ordem, null);

$_SESSION["gradeArraySohVideos"] = array();
$_SESSION["gradeArrayDirVideos"] = array();

for ($i = 0; $i < $totalRegistros; $i++) {
	$linha = $dados[$i]["Video"];
	$_SESSION["gradeArraySohVideos"][$i] = "$linha";

	$linha = $dados[$i]["Diretorio"] . $dados[$i]["Video"];
	$_SESSION["gradeArrayDirVideos"][$i] = "$linha";
}

$_SESSION["gradeImplodeSohVideos"] = implode(",", $_SESSION["gradeArraySohVideos"]);

$_SESSION["gradeImplodeDirVideos"] = implode(",", $_SESSION["gradeArrayDirVideos"]);

?>
