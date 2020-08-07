<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Moema Times Square - Grade</title>

	<link rel="stylesheet" type="text/css" href="../../_css/w3.css"/>
	<link rel="stylesheet" type="text/css" href="../../_css/estilo.css"/>
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

	<div class="box-geral">
		<div class="w3-container"
				style="max-width:500px; height:420px; margin:auto;">
			<img class="mySlides w3-animate-left w3-image" style="width:100%; max-height:420px;"
				src="../../__cliente/_imagens/_grade/anuncio-restaurante.jpg">
			<img class="mySlides w3-animate-left w3-image" style="width:100%; max-height:420px;"
				src="../../__cliente/_imagens/_grade/anuncio-padaria.jpg">
			<img class="mySlides w3-animate-left w3-image" style="width:100%; max-height:420px;"
				src="../../__cliente/_imagens/_grade/anuncio-pet.jpg">
		</div>
	</div>

	<a href="../_negocios/negocios.php" class="w3-ripple button-voltar">&laquo; Anterior</a>

	<p> </p>

	<script>
		var myIndex = 0;
		carrossel();

		function carrossel() {
			var i;
			var x = document.getElementsByClassName("mySlides");

			for (i = 0; i < x.length; i++) {
				x[i].style.display = "none";  
			}

			myIndex++;
	
			if (myIndex > x.length) {
				myIndex = 1
			}

			x[myIndex - 1].style.display = "block";  

			setTimeout(carrossel, 10000);    
		}
	</script>

	<script src="../../_funcoes/_javascript/funcoes-nav-vertical.js"></script>

</div>
</body>

</html>
