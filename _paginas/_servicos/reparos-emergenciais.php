<?php
    session_start();

    require_once "../../_funcoes/_php/funcoes_php.php";
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Moema Times Square - Serviços</title>

	<link rel="stylesheet" type="text/css" href="../../_css/w3.css"/>
    <link rel="stylesheet" type="text/css" href="../../_css/estilo.css"/>
    <link rel="stylesheet" type="text/css" href="../../_css/informacoes.css"/>
	
	<style>
	p a {
		text-decoration: none;
	}

	p a:hover {
		color: blue;
		text-decoration: underline;
	}
	</style>
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

	<div id="titulo02">	<span>REPAROS EMERGENCIAIS</span> </div>

	<span class="panel-2">Contatos</span>
	<div class="inf-panel-2">
		<div>
			<p>Lista de prestadores de serviços:</p>
			<p><strong>Atenção:</strong> A lista a seguir é apenas uma opção que criamos para atender as solicitações de condôminos, obedecendo ao critério de atendimento e qualidade de serviço.</p>
			<p>O Condomínio não se responsabiliza pelo serviço prestado e nem pela sua contratação, que é de inteira responsabilidade e opção do contratante, assim também como os preços, as condições de pagamento, prazos e entregas.</p>
			<p>Sugerimos que o serviço não seja pago antecipado e que os pagamentos sejam de acordo com as suas entregas, evitando assim maiores problemas.</p>
			<p>Independente disto, as reclamações podem e devem ser feitas para nossa avaliação do prestador, pelo aplicativo na LINHA DIRETA COM O SÍNDICO.</p>

			<p><strong>Marcenaria:</strong><br>
				LHD Ind. de móveis: Alessandro Silva: <a href="tel:+551732438300">(17) 3243-8300</a> / cel <a href="tel:+5517991392780">(17) 99139-2780</a>.<br>
				Marceneiro Barbosa: <a href="tel:+5511996469356">(11) 99646-9356.</a></p>
			<p><strong>Reformas em geral:</strong><br>
				Vertente Eng. Constr.: André: <a href="tel:+551150727132">(11) 5072-7132</a>.</p>
			<p><strong>Pintores:</strong><br>
				Glauber:  <a href="tel:+5511982968189">(11) 98296-8189</a>.<br>
				Severino: <a href="tel:+5511982968189">(11) 98296-8189</a>.<br>
                Carlos:   <a href="tel:+5511945468854">(11) 94546-8854</a>.</p>
			<p><strong>Piso Laminado:</strong><br>
				Toc de Classe Decorações: <a href="tel:+551120981212">(11) 2098-1212</a> / <a href="tel:+551127691693">(11) 2769-1693</a> / cel. <a href="tel:+5511996979390">(11) 99697-9390</a>.</p>
			<p><strong>Ar Condicionado:</strong><br>
				Bless Climatização Serv. de Manutenção:  Janaina: <a href="tel:+551150445353">(11) 5044-5353</a>.<br>
				Cabral Ar Condicionado: Cabral: <a href="tel:+5511980531835">(11) 98053-1835</a>.</p>
			<p><strong>Reparos em geral:</strong><br>
				Pintura gesso, hidráulica, pisos, elétrica e telefonia: Carlos: <a href="tel:+5511945468854">(11) 94546-8854</a>.</p>
		</div>
	</div>

	<a href="../_servicos/servicos.php" class="w3-ripple button-voltar">&laquo; Anterior</a>

	<script src="../../_funcoes/_javascript/funcoes-nav-vertical.js"></script>

</div>
</body>

</html>
