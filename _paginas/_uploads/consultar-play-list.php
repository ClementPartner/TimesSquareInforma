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

	if (!isset($_SESSION["dataConsultar"])) {
		$_SESSION["dataConsultar"] = date("Y-m-d");
	}

	if (!isset($_SESSION["horaConsultar"])) {
		$_SESSION["horaConsultar"] = "08:00:00";
	}
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
		
		.botao-pesquisar {
			color: white;
			background-color: #a491a2;
			padding: 8px;
			font-size: 24px;
			border: 1px solid #a491a2;
			margin-top: 10px;
		}
		
		.botao-pesquisar:hover, .botao-pesquisar:focus {
			color: white;
			background-color: blue;
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

	<div id="titulo02">	<span>CONSULTA PLAY LIST</span></div>

	<div style="max-width: 680px; height: 400px; margin: 10px auto 0;">
		<div class="w3-left" style="margin-top: 10px; width: 350px; max-height: 375px;">
			<div style="margin: 0 auto; width: 230px;">
				<div class="w3-responsive w3-center w3-text-white"
					style="background-color: #330066; padding: 10px;">
						<div class="w3-left" style="font-size: 20px;">
							Data: <input type="date" id="idDataInicial" name="txtDataInicial"
									class="texto-centro-16" style="width: 130px; color: black;"
									size="10" minlength="10" maxlength="10"
									value="<?php echo $_SESSION["dataConsultar"]; ?>"
									autofocus required>
						</div>
						<div class="w3-right">
							<a id="idLupa" onclick="consultarDia()"
								href="consultar-programacao-play-list.php?dia=">
									<i class="fa fa-search botao-pesquisar"></i>
							</a>
						</div>
				</div>
			</div>

			<?php
				$data = $_SESSION["dataConsultar"];
				$hora = $_SESSION["horaConsultar"];

				$where  = "WHERE DataInicial <= '$data'";
				$where .= "  AND DataFinal   >= '$data'";
				$where .= "  AND HoraInicial  = '$hora'";

				$ordem  = "ORDER BY Video";

				$totalRegistros = DBRead("grade", "COUNT(*)", $where, null, null);
				$totalRegistros = $totalRegistros[0]["COUNT(*)"];

				$dados = DBRead("grade", "Video", $where, $ordem, null);			
			?>

			<div class="w3-responsive w3-center w3-text-white"
					style="margin-top: 10px; height: 280px; width: 100%;">
				<table>
					<thead>
						<tr>
							<th id="idVideoHora">Vídeo(s) - <?php echo $hora; ?></th>
						</tr>
					</thead>

					<tbody style="color: black; background-color: white;">
						<?php for (	$i = 0; $i < $totalRegistros; $i++) { ?>
							<tr>
								<td style="text-align: justify;">
									<?= $dados[$i]["Video"] ?>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>

		<?php
			$data = $_SESSION["dataConsultar"];

			$where  = "WHERE DataInicial <= '$data'";
			$where .= "  AND DataFinal   >= '$data'";

			$horarios = array();

			for ($i = 0; $i < 24; $i++) {
				if ($i < 10) {
					$hora = "0" . $i;
				} else {
					$hora = $i;
				}

				$hora = $hora  . ":00:00";
				$ver  = $where . " AND HoraInicial = '$hora'";

				$dados        = DBRead("grade", "COUNT(*)", $ver, null, null);
				$horarios[$i] = $dados[0]["COUNT(*)"];
			}
		?>

		<div class="w3-right" style="margin-top: 10px; width: 300px; max-height: 375px;">
			<div class="w3-responsive w3-center w3-text-white" style="height: 370px; width: 100%;">
				<table id="myTable" class="w3-hoverable">
					<thead>
						<tr>
							<th>Hora Inicial</th>
							<th>Hora Final</th>
							<th>Qtde.</th>
						</tr>
					</thead>

					<tbody style="color: black; background-color: white;">
						<?php for ($i = 0; $i < 24; $i++) {
								if ($i < 10) {
									$hora = "0" . $i;
								} else {
									$hora = $i;
								}
								$horaIni = $hora  . ":00:00";
								$horaFim = $hora  . ":59:59";
						?>
						<tr onclick="LinhaClick(this)">
							<td style="text-align: center; width: 110px;">
								<?= $horaIni; ?></td>
							<td style="text-align: center; width: 110px;">
								<?= $horaFim; ?></td>
							<td style="text-align: center; width: auto;">
								<?= $horarios[$i]; ?>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<p> </p>

	<a href="manter-grade.php" class="w3-ripple button-voltar"
		style="text-decoration: none;">&laquo; Anterior</a>

	<script src="../../_funcoes/_javascript/funcoes-nav-vertical.js"></script>
	<script src="../../_funcoes/_javascript/funcoes-grade-play-list.js"></script>

</div>
</body>

</html>
