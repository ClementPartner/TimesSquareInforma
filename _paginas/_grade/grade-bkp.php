<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Moema Times Square - Grade</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../_css/w3.css"/>
	<link rel="stylesheet" type="text/css" href="../../_css/estilo.css"/>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body style="background-color: black;">
	<div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel" data-interval="10000"
		style="max-width: 1200px; max-height: 700px; margin: auto;">

		<!-- Indicadores -->
		<ol class="carousel-indicators" style="display: none;">
			<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
			<li data-target="#myCarousel" data-slide-to="1"></li>
			<li data-target="#myCarousel" data-slide-to="2"></li>
		</ol>

		<!--Slides-->
		<div class="carousel-inner">
			<!--- Não esquecer que a 1ª tem que ser "active" !!! --->
			<div class="item active">
				<video class="video-fluid" autoplay loop muted style="width: 100%; height: auto;">
					<source src="https://mdbootstrap.com/img/video/Agua-natural.mp4" type="video/mp4" />
				</video>
			</div>

			<div class="item">
				<video class="video-fluid" autoplay loop muted style="width: 100%; height: auto;">
					<source src="https://mdbootstrap.com/img/video/Tropical.mp4" type="video/mp4" />
				</video>
			</div>
		</div>
		<!--/.Slides-->

		<!-- Left and right controls -->
		<a class="left carousel-control" href="#myCarousel" data-slide="prev">
			<!--- <span class="glyphicon glyphicon-chevron-left"></span>
			<span class="sr-only">Previous</span> --->
		</a>
		<a class="right carousel-control" href="#myCarousel" data-slide="next">
			<!--- <span class="glyphicon glyphicon-chevron-right"></span>
			<span class="sr-only">Next</span> --->
		</a>
		
		<!--- /// fazer botão para abrir tela cheia do browser. --->
	</div>
</body>

</html>
