<?php
    session_start();

	if(!isset($_COOKIE["Moema"])) {
		setcookie("Moema", "", time() - 86400);
        session_unset();
        session_destroy();
		header("Location: ../_login/login-entrar.php");
	}
	else {
		if(count($_COOKIE) <= 0) {
			setcookie("Moema", "", time() - 86400);
			session_unset();
			session_destroy();
			header("Location: ../_login/login-entrar.php");
		}
	}
	/*------------------------------------------------------------*/

	if ((!isset($_SESSION["usuarioAtivo"])) ||
		($_SESSION["usuarioAtivo"] == NULL) ||
		($_SESSION["usuarioAtivo"] != "S")) {
		 $_SESSION['mensagem'] = "Usuário saiu !!!";
		header("Location: ../_login/login-entrar.php");
	}
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Moema Times Square - Documentos</title>

	<link rel="stylesheet" type="text/css" href="../../_css/w3.css"/>
    <link rel="stylesheet" type="text/css" href="../../_css/estilo.css"/>
    <link rel="stylesheet" type="text/css" href="../../_css/informacoes.css"/>
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

	<div id="titulo02">	<span>INFORMAÇÕES</span> </div>

	<button class="accordion">Avisos urgentes</button>
	<div class="inf-panel">
		<object width="100%" height="500"
			data="../../__cliente/_documentos/_avisos-urgentes/timessquare-report.jpg"></object>
	</div>

	<button class="accordion">Orientações</button>
	<div class="inf-panel">
		<p><strong>Solicitamos a todos as seguintes observações:</strong></p>

		<p class="sub-titulo"><strong>DESCARTE DE LIXO NOS CORREDORES</strong></p>

		<p>As bases de serviços e corredores de nossos andares são rotas de fuga, e acessos às 
			escadas de emergência. Portanto, <ins>é terminantemente proibido</ins> descarte de lixo 
			nestas áreas, tanto no chão, deixar bandejas, sacolas, sacos, caixas nos halls tanto de 
			serviços como social. Pedimos que o lixo que não for descartado durante a arrumação 
			da nossa equipe seja levado diretamente às lixeiras próximas dos elevadores nos 
			subsolos. Favor, orientem seus prestadores de serviços.</p>
		<p>Quando solicitado o serviço de room service, <ins>façam contato com o restaurante pelos 
			ramais 2573 ou 2574 imediatamente após consumo</ins>, para que a equipe possa retirar a 
			bandeja e ou as suas louças, para que não sejam colocados no chão do corredor.</p>

		<p class="sub-titulo"><strong>OBRAS E MELHORIAS</strong></p>

		<p>Pedimos desculpas pelos transtornos, mas sua atenção é necessária para às  nossas obras 
			e melhorias, conforme aprovadas em nossa Assembléia Geral.</p>
		<p>A partir de 1º de Julho iniciaremos a substituição da tubulação de incêndio, nos 
			subsolos. Para isto, pedimos a compreensão dos senhores, pois será necessária a 
			interdição gradativa das vagas de garagem, conforme a obra demandar. Faremos o possível 
			para minimizarmos o desconforto em relação a isto.</p>
		<p>Quando iniciarem as interferências nos andares, os senhores serão individualmente 
			contatados para programação.</p>
		<p>O projeto de Acessibilidade e Paisagismo da praça foi finalizado, e estamos em processo 
			de orçamentos para aprovação do Conselho Consultivo. Estimamos que a obra deva iniciar 
			em meados de setembro.</p>
			
		<p class="sub-titulo"><strong>GARAGEM E ESTACIONAMENTO</strong></p>

		<p>✔ Conforme Convenção Condominial, capitulo I, parágrafo segundo: não há pré definição 
			de vaga de estacionamento por unidade, as vagas são em locais indeterminados, desde que 
			existam vagas disponíveis;</p>
		<p>✔ Esclarecemos que os veículos de hóspedes e avulsos ficam exclusivamente no 1º 
			Subsolo. A cancela nem mesmo é habilitada para acesso ao 2º piso;</p>
		<p>✔ Para evitarmos acidentes e garantirmos a segurança de todos, pets soltos são proibidos 
			nas garagens. Inclusive porque há tratamento rigoroso contra pragas nestes pisos, e o 
			pet pode ingerir alguma substancia nociva à sua saúde;</p>
		<p>✔ É importante o respeito às mãos definidas de circulação nos subsolos, bem como o limite 
			de velocidade de 10km/h, conforme sinalizações expostas;</p>
		<p>✔ Diversas vagas são presas, portanto, é importante que a chave seja entregue ao manobrista, 
			sempre que o veículo for estacionado em vagas sinalizadas para tal – com a demarcação 
			vermelha no piso;</p>
		<p>✔ Também é muito importante que sejam respeitas as linhas delimitadoras de cada vaga, 
			permitindo adequado uso do espaço;</p>

		<p class="sub-titulo"><strong>RECADASTRAMENTO DE ACESSO A GARAGEM</strong></p>

		<p>A Plenty Park, administradora do estacionamento do Condomínio está atualizando o cadastro 
			dos veículos, devido a troca de sistema de acesso. <ins>Pedimos, a todos  que ainda não 
			fizeram, que façam o recadastramento, em qualquer guichê da Plenty</ins> – no térreo ou 
			subsolos, evitando problemas de acesso com o novo sistema.</p>

		<p class="sub-titulo"><strong>OS PETS NAS TORRES MÉRCURE E ADÁGIO</strong></p>

		<p>Todo condômino tem o direito de usar e fruir de sua unidade autônoma condicionado ao 
			respeito das normas de boa vizinhança, de forma que não causar dano ou incômodo aos 
			demais condôminos e desde que não a use de forma nociva ou perigosa ao sossego, 
			salubridade e a segurança dos demais condôminos (Artigos 10º e 19º da Lei 4591/64 e 
			Art. 1.335 do Código Civil). Ou seja, manter animais em unidades condominiais é exercício 
			regular do direito de propriedade (Artigo 1228 e seguintes do Código Civil).</p>
		<p><strong>Que regras devem ser consideradas no Condomínio?</strong></p>
		<p>A principal é o bom senso.</p>
		<p>Colocamos abaixo alguns importantes detalhamentos para segurança e boa convivência:</p>
		<p>- É proibido deixar o animal desacompanhado de um responsável, solto no apartamento, 
			quando o mesmo for arrumado pela camareira. Neste caso, a arrumação não poderá ser 
			feita;</p>
		<p>- Os tutores devem recolher os dejetos dos pets, em qualquer local, incluindo gramados, 
			terra ou canteiros das praças;</p>
		<p>- A presença de um animal de estimação, não pode comprometer a segurança dos outros 
			moradores ou pets. </p>
		<p>Recomendamos, por exemplo, que o uso do elevador com outras pessoas ou pets seja evitado. 
			Caso não seja possível, que o pet seja colocado no colo.</p>
		<p>Cães agressivos ou de comportamento instável devem usar focinheira. É proibido circular 
			com o pet sem coleira ou com guias longas, em qualquer local de uso comum do prédio, 
			como por exemplo, nos corredores dos andares, calçadas, praça, piscina, recepções, 
			garagens (Art. 10 da Lei Nº 4.591/64 e Art. 1.277, Art. 1.335 e Art. 1.336, IV da Lei 
			Nº 10.406/02);</p>
		<p>- Todos os condôminos têm direito ao descanso. Um pet também não pode quebrar essa regra 
			com frequência, em momentos inoportunos, por exemplo, em desacordo à "lei do silêncio".</p>
		<p>- Se um bichinho tem doenças transmissíveis ou problemas de saúde que eventualmente levem 
			outros animais e pessoas a também adoecerem, sua circulação nas áreas internas pode ser 
			impedida.</p>
		<p>- Para manutenção devida dos equipamentos, é importante que não sejam utilizadas as 
			máquinas de lavar ou secar roupas, quando as mesmas estiverem com pelos dos pets.</p>

		<p class="sub-titulo"><strong>OS PETS NA TORRE WALL STREET</strong></p>

		<p>Por tratar-se de uma torre estritamente comercial, e em acordo à Convenção Condominial e 
			Regulamento Interno do Condomínio, é proibida a circulação e a presença de animais de 
			estimação, de qualquer porte, raça ou espécie, nas dependências da torre Wall Street.</p>
		<p>Certos da compreensão e apoio para manutenção do direito e bem estar de todos, seguimos 
			à inteira disposição para eventuais dúvidas.</p>

		<p class="sub-titulo"><strong>RECLAMAÇÕES E SUGESTÕES</strong></p>

		<p>Lembramos que todas <ins>as reclamações e sugestões devem ser registradas</ins> nos livros de que 
			ficam nas recepções de cada torre do condomínio. </p>
	</div>

	<button class="accordion">Atas das Assembléias</button>
	<div class="inf-panel">
		<div class="inf-navbar">
			<a href="../../__cliente/_documentos/_atas/AtaAGO-2019-03-26.pdf" target="_blank"
				class="w3-button w3-ripple">AGO 26/03/2019</a>
			<a href="../../__cliente/_documentos/_atas/AtaAGE-2018-12-04.pdf" target="_blank"
				class="w3-button w3-ripple">AGE 04/12/2018</a>
			<a href="../../__cliente/_documentos/_atas/AtaAGO-2018-03-21.pdf" target="_blank"
				class="w3-button w3-ripple">AGO 21/03/2018</a>
			<a href="../../__cliente/_documentos/_atas/AtaAGO-2017-03-28.pdf" target="_blank"
				class="w3-button w3-ripple">AGO 28/03/2017</a>
			<a href="../../__cliente/_documentos/_atas/AtaAGO-2016-03-22.pdf" target="_blank"
				class="w3-button w3-ripple">AGO 22/03/2016</a>
			<a href="../../__cliente/_documentos/_atas/AtaAGE-2015-10-22.pdf" target="_blank"
				class="w3-button w3-ripple">AGE 22/10/2015</a>
			<a href="../../__cliente/_documentos/_atas/AtaAGO-2015-03-26.pdf" target="_blank"
				class="w3-button w3-ripple">AGO 26/03/2015</a>
		</div>
	</div>

	<p> </p>

	<a href="../_informacoes/informacoes.php" class="w3-ripple button-voltar">&laquo; Anterior</a>

	<script src="../../_funcoes/_javascript/funcoes-nav-vertical.js"></script>
	<script src="../../_funcoes/_javascript/funcoes-accordion.js"></script>

</div>
</body>

</html>
