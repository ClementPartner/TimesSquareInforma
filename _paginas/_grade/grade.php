<?php
session_start();

	require_once "grade-carregar-da-tabela.php";

$_SESSION["gradeLoopVideos"] = 1;
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Moema Times Square - Grade</title>

	<link rel="stylesheet" type="text/css" href="../../_css/w3.css"/>
	<link rel="stylesheet" type="text/css" href="../../_css/estilo.css"/>
	<link rel="stylesheet" type="text/css" href="../../_css/carrossel.css"/>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body style="background-color: black;">
	<div>
		<span id="idGradeDuracao"     style="display: none;">60</span>
		<span id="idGradeDataCriacao" style="display: none;">
			<?php echo $_SESSION["gradeDataCriacao"]; ?></span>
		<span id="idGradeHoraFinal"   style="display: none;">
			<?php echo $_SESSION["gradeHoraFinal"]; ?></span>
		<span id="idGradeQtdeVideos"  style="display: none;">
			<?php echo $_SESSION["gradeQtdeVideos"]; ?></span>

		<span id="idGradeLoopVideos"  style="display: none;">
			<?php echo $_SESSION["gradeLoopVideos"]; ?></span>

		<span id="idJsDataHora"       style="display: none;"></span>

		<span id="idGradeSrcVideos"   style="display: none;">
			<?php echo $_SESSION["gradeImplodeSohVideos"]; ?></span>
	</div>

	<div style='width: 1200px; height: 700px; margin: auto;'>
		<video id='idVideo' class='video-fluid' loop style='width: 100%; height: auto;'
			src='../../__cliente/_videos/how-it-feels.mp4' type='video/mp4'></video>
	</div>

	<script src="../../_funcoes/_javascript/funcoes-grade.js"></script>

</body>

</html>
