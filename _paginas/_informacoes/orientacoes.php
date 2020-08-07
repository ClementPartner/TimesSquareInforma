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

    <title>Moema Times Square - Orientações</title>

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

	<span class="panel-2">Orientações</span>
	<div class="inf-panel-2">
	<div>
		<p>Seja bem vindo ao Condomínio Times Square, localizado na zona sul de São Paulo, bairro Planalto, mais conhecido por Moema, a 50 metros da estação Moema da linha 5 lilás do metrô. A conexão com a cidade é fácil e rápida.</p>

		<p class="sub-titulo"><strong>TELEFONES ÚTEIS</strong></p>

		<p> Recepção Adágio: 11 5053-2550<br>
			Recepção Mércure: 11 5053-2500<br>
			Recepção Wall Street: 11 5053-3500<br>
			Administração: 11 5053-2525<br>
			Manutenção: 11 5053-2631<br>
			Governança: 11 5053-2618<br>
			Restaurante Dell Arte: 11 5053-2574<br>
			Frans Café: 11 5053-2559<br>
			Estacionamento: 11 3105-7450<br>
			Bombeiros: 193<br>
			Policia Militar: 190</p>

		<p class="sub-titulo"><strong>LAVANDERIAS</strong></p>

		<p>Oferecemos dois tipos de serviços de lavanderia, uma selfservice, localizada no 1º subsolo da Torre Adágio, em frente aos elevadores (Adágio), diariamente das 6h às 23h, adquirindo kit individual com 2 fichas lavar e secar ao custo de $ 35,00, disponíveis na recepção do Adágio. A
			segunda opção é da lavanderia externa através de solicitação e preenchimento de formulário pela governança ramal 2618 que retira diariamente até as 11h, com entrega normal no dia seguinte ou de serviço expresso entregue no mesmo dia.</p>

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

		<p class="sub-titulo"><strong>SERVIÇO DE ROON SERVICE</strong></p>

		<p>Serviço disponível 24 horas, para condôminos, moradores, inquilinos e hospedes. Quando solicitado o serviço de room service, contatos com o
			restaurante pelos ramais 2573 ou 2574 avisar imediatamente após consumo , para que a equipe possa retirar a bandeja e ou as suas louças,
			para que não sejam colocados no chão do corredor.</p>
			
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

		<p class="sub-titulo"><strong>TRANSPORTE GRATUÍITO PARA O AEROPORTO CONGONHAS</strong></p>

		<p>Diariamente oferecemos transporte gratuito por Vans para os hospedes do Mércure Times Square, Mércure Privilege e Mércure Moema saída em
			frente ao condomínio para o aeroporto de Congonhas, nos seguintes horários: segundas às quartas das 9h às 20h, quintas e Sextas das 6h às
			17h. Serviço indisponível aos sábados, domingos e feriados.</p>

		<p class="sub-titulo"><strong>ARRUMAÇÃO</strong></p>

		<p>Está inclusa uma arrumação diária em todos os apartamentos das Torres Adágio e Mércure, sem horário determinado, feita conforme
			disponibilidade da governança entre 09h e 15h. A governança executará uma limpeza superficial e arrumação básica, não está inclusa limpeza
			pesada e profunda nos apartamentos, O condomínio não fornece roupa de cama (lençóis e fronhas), roupa de banho, produtos de higiene pessoal
			e limpeza da cozinha”.</p>

		<p class="sub-titulo"><strong>MUDANÇAS E REFORMAS - Wall Street</strong></p>

		<p>Os serviços de mudanças, reformas, entrega/recebimento de materiais/móveis, deverão ser comunicados a recepção do office através
			do e-mail <ins>wallstreet.recep@gmail.com</ins>, e deverão ser feitas nos seguintes horários: s egunda à sexta: das 19h às 22h, sábado: 7h às 15h – domingos e
			feriados sem operação.</p>

		<p class="sub-titulo"><strong>MUDANÇAS - Adágio e Mércure</strong></p>

		<p>As mudanças deverão ser comunicadas ao departamento de manutenção pelo ramal 2631 ou através das
			recepções Mércure e Adágio, devendo obedecer aos seguintes horários: segunda à sexta, das 9h às 17h. Aos finais de semana e feriados sem operação.</p>

		<p class="sub-titulo"><strong>REFORMAS - Adágio e Mércure</strong></p>

		<p>Qualquer reforma nos apartamentos, antes da execução, deve ser validada pelo Condomínio. O contato deve ser
			feito de segunda a sexta-feira, com o Coordenador de Manutenção, Subgerente ou Gerente Geral, através das recepções Mércure ou Adágio.</p>

		<p class="sub-titulo"><strong>RECLAMAÇÕES E SUGESTÕES</strong></p>

		<p class="ultima-linha-orientacoes">Lembramos que todas <ins>as reclamações e sugestões devem ser registradas</ins> nos livros de que 
			ficam nas recepções de cada torre do condomínio e/ou
			também pelo aplicativo INFORME em LINHA DIRETA DO SÍNDICO.</p>
	</div>
	</div>

	<p> </p>

	<a href="../_informacoes/informacoes.php" class="w3-ripple button-voltar">&laquo; Anterior</a>

	<script src="../../_funcoes/_javascript/funcoes-nav-vertical.js"></script>
	<script src="../../_funcoes/_javascript/funcoes-accordion.js"></script>

</div>
</body>

</html>
