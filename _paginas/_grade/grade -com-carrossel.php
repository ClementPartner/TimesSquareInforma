<?php
session_start();

	require_once "grade-carregar-da-tabela.php";
	require_once "grade-criar-arq-para-mostrar.php";

$_SESSION["gradeLoopVideos"] = 1;
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Moema Times Square - Grade</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../_css/w3.css"/>
	<link rel="stylesheet" type="text/css" href="../../_css/estilo.css"/>
	<link rel="stylesheet" type="text/css" href="../../_css/carrossel.css"/>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body style="background-color: black;">
	<div id="myCarousel" class="carousel carousel-fade"
		data-ride="carousel" data-interval="10000" data-wrap="true"
		style="max-width: 1200px; max-height: 700px; margin: auto;">
<!--- /// Voltar para 60 seg. acima --->
		<div>
			<!--- /// style="display: none;" --->
			<span id="idGradeDataCriacao">
				<?php echo $_SESSION["gradeDataCriacao"]; ?></span>
			<span id="idGradeHoraFinal"  >
				<?php echo $_SESSION["gradeHoraFinal"]; ?></span>
			<span id="idGradeQtdeVideos" >
				<?php echo $_SESSION["gradeQtdeVideos"]; ?></span>

			<span id="idGradeLoopVideos" >
				<?php echo $_SESSION["gradeLoopVideos"]; ?></span>

			<span id="idJsDataHora"      ></span>

<!--- /// retirar o span abaixo. --->
			<span id="idGradeSrcVideos" >
				</span>
		</div>

		<!-- Indicadores -->
		<ol class="carousel-indicators" style="display: none;">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
		</ol>

		<!--Slides-->
		<div id="idCarrossel-inner" class="carousel-inner">
			<?php 
			//	if (!$_SESSION["gradeJaVista"]) {
			//		$_SESSION["gradeJaVista"] = true;
				 require_once "grade-mostrar-carrossel.php";
			// } else { 
			//		date_default_timezone_set("America/Sao_Paulo");
			//		echo date("d/m/Y H:i:s");
			//	}
			?>
		</div>

		<a class="left carousel-control" href="#myCarousel" data-slide="prev"></a>

		<a class="right carousel-control" href="#myCarousel" data-slide="next"></a>
	</div>

	<script>
		$(document).ready(function(){
			$("#myCarousel").carousel("cycle");
			var vid = document.getElementById("idV1");
				vid.play();
		});
			
	</script> 

	<script src="../../_funcoes/_javascript/funcoes-grade.js"></script>

</body>

</html>
