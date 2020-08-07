<?php
	session_start();

	date_default_timezone_set("America/Sao_Paulo");

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
	/*------------------------------------------------------------*/

    require_once "../../_bd/bd-config.php";
    require_once "../../_bd/bd-connection.php";
    require_once "../../_bd/bd-crud.php";

	/*-----------------------------------------------
		Deletar todos os registros cujas datas finais
		sejam anteriores a data atual.
	-----------------------------------------------*/

	$where = date("Y-m-d");
	$where = "WHERE DataFinal < '$where'";
	
	DBDelete("grade", $where);
	/*-----------------------------------------------*/

    $totalRegistros = DBRead("grade", "COUNT(*)");
    $totalRegistros = $totalRegistros[0]["COUNT(*)"];

    $dados = DBRead("grade", "*", null,
            "ORDER BY DataInicial, DataFinal, HoraInicial, HoraFinal, Video",
            null);
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Moema Times Square - Grade</title>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="../../_css/w3.css"/>
	<link rel="stylesheet" type="text/css" href="../../_css/estilo.css"/>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

	<style>
		table {
			font-family: Arial, Helvetica, sans-serif;
			border-collapse: collapse;
			width: 100%;
			border: 1px solid #a491a2;
		}

		th {
			color: black;
			background-color: #a491a2;
			border: 1px solid #a491a2;
			text-align: center;
			padding: 8px;
		}

		td {
			border: 1px solid #a491a2;
			text-align: left;
			padding: 8px;
		}

		tr:nth-child(even) {
			color: #000;
			background-color: #dddddd;
		}

		.w3-hoverable tbody tr:hover {
			color: white;
			background-color: #330066;
			cursor: pointer;
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

	<div id="titulo02">	<span>CONSULTA GRADE</span></div>

	<div class="box-geral">
		<div class="w3-responsive w3-center w3-text-white"
				style="background-color: black; padding: 0 10px; height: 330px; width: 100%;">

			<p> </p>

			<table id="myTable" class="w3-hoverable">
				<thead>
					<tr>
						<th>Data Inicial</th>
						<th>Data Final</th>
						<th>Hora Inicial</th>
						<th>Hora Final</th>
						<th>Vídeo</th>
					</tr>
				</thead>

				<tbody style="color: black; background-color: white;">
					<?php for (	$i = 0; $i < $totalRegistros; $i++) { ?>
					<tr onclick="LinhaClick(this)">
						<td style="display: none;"><?= $dados[$i]["Id"] ?></td>
						<td style="text-align: center; width: 110px;">
							<?= date_format(date_create($dados[$i]["DataInicial"]), "d/m/Y") ?></td>
						<td style="text-align: center; width: 110px;">
							<?= date_format(date_create($dados[$i]["DataFinal"]), "d/m/Y") ?></td>
						<td style="text-align: center; width: 110px;">
							<?= $dados[$i]["HoraInicial"] ?></td>
						<td style="text-align: center; width: 110px;">
							<?= $dados[$i]["HoraFinal"] ?></td>
						<td style="text-align: justify;"><?= $dados[$i]["Video"] ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>

		<p> </p>
	</div>

	<a id="idDeletar" href="#" class="glyphicon glyphicon-trash botao-lixo w3-ripple"
		style="font-size: 17px; width: auto;" onclick="Confirmacao()" role="button"></a>
 
	<a href="manter-grade.php" class="w3-ripple button-voltar"
		style="text-decoration: none;">&laquo; Anterior</a>

	<p> </p>

	<script src="../../_funcoes/_javascript/funcoes-deletar-programar.js"></script>
	<script src="../../_funcoes/_javascript/funcoes-nav-vertical.js"></script>

</div>
</body>

</html>
