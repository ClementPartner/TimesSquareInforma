<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Moema Times Square - Negócios</title>

	<link rel="stylesheet" type="text/css" href="../../_css/w3.css"/>
	<link rel="stylesheet" type="text/css" href="../../_css/estilo.css"/>
	<link rel="stylesheet" type="text/css" href="../../_css/login.css"/>
	
	<script>
		function fullwin() {
			window.open("../_grade/grade.php","","fullscreen,scrollbars");
		}
	</script>

</head>

<body class="imagem-fundo" onload="fazerGrade();">

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
		<div class="box-form w3-center">
			<div class="login-container">
				<a href="../_consultas/consulta-usuarios.php"
					class="botao-home w3-ripple">MURAL DE CONDÔMINOS</a><br>
				<a href="../_grade/grade.php" target="_blank" onclick="this.href=montarHref()"
					class="botao-home w3-ripple">TV TIMES</a><br>	
				<a href="https://g1.globo.com/" target="_blank"
					class="botao-home w3-ripple">ÚLTIMAS NOTÍCIAS</a><br>	
				<a href="https://www.prefeitura.sp.gov.br/cidade/secretarias/cultura/" target="_blank"
					class="botao-home w3-ripple">LINHA DA CULTURA</a><br>			
				<a href="https://www.homerefill.com.br/" target="_blank"
					class="botao-home w3-ripple">COMPRAS DE SUPERMERCADO</a><br>
				<a href="https://www.youtube.com/playlist?list=PLGlJMXraLv-teLX_EuMZlrGSABaLEfXKu" target="_blank"
					class="botao-home w3-ripple">EVENTOS DO CONDOMÍNIO</a><br>
			</div>

			<p> </p>
		</div>
	</div>

	<a href="../_login/login-home.php" class="w3-ripple button-voltar">&laquo; Anterior</a>

	<p> </p>

	<script src="../../_funcoes/_javascript/funcoes-nav-vertical.js"></script>
	<script src="../../_funcoes/_javascript/funcoes-negocios.js"></script>

</div>
</body>

</html>
