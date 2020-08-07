<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Moema Times Square - Grade</title>

	<link rel="stylesheet" type="text/css" href="../../_css/w3.css"/>
	<link rel="stylesheet" type="text/css" href="../../_css/estilo.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body class="imagem-fundo">

<div id="interface">
	<div id="titulo01">
		<span>TIMES SQUARE INFORME</span>

		<div id="idSidepanel" class="sidepanel">
			<a href="../_captcha/captcha-usar.php?tipo=2" class="item">LOGIN</a>
			<a href="../_informacoes/informacoes.php" class="item">INFORMAÇÕES</a>
			<a href="../_negocios/negocios.php" class="item">NEGÓCIOS E OPORTUNIDADES</a>
			<a href="../_servicos/servicos.php" class="item">SERVIÇOS</a>
			<a href="../_captcha/captcha-usar.php?tipo=1" class="item last-item">FALE CONOSCO</a>
		</div>

		<button id="btnOpenNav" onclick="openNav()">☰</button> 
	</div>

	<div id="titulo02">	<span>NEGÓCIOS E OPORTUNIDADES</span> </div>

	<div style="max-width: 900px; max-height: 600px; margin-top: 10px;">
		<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="10000">

			<!-- Indicadores -->
			<ol class="carousel-indicators">
				<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
				<li data-target="#myCarousel" data-slide-to="1"></li>
				<li data-target="#myCarousel" data-slide-to="2"></li>
				<li data-target="#myCarousel" data-slide-to="3"></li>
			</ol>

			<!--Slides-->
			<div class="carousel-inner">
				<div class="item active">
					<img src="../../__cliente/_imagens/_grade/anuncio-restaurante.jpg" alt="Negócios"
						width="300" height="auto" style="margin: auto;">
				</div>

				<div class="item">
					<img src="../../__cliente/_imagens/_grade/anuncio-padaria.jpg" alt="Negócios"
						width="300" height="auto" style="margin: auto;">
				</div>

				<div class="item">
					<img src="../../__cliente/_imagens/_grade/anuncio-pet.jpg" alt="Negócios"
						width="300" height="auto" style="margin: auto;">
				</div>

				<div class="item">
					<video class="video-fluid" autoplay loop muted style="width: 100%; height: auto;">
						<source src="https://mdbootstrap.com/img/video/Agua-natural.mp4" type="video/mp4" />
					</video>
				</div>
			</div>

			<!-- Left and right controls -->
			<a class="left carousel-control" href="#myCarousel" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="right carousel-control" href="#myCarousel" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>
	</div>

	<a href="../_negocios/negocios.php" class="w3-ripple button-voltar"
		style="text-decoration: none;">&laquo; Anterior</a>

	<p> </p>

	<script src="../../_funcoes/_javascript/funcoes-nav-vertical.js"></script>

</div>
</body>

</html>
