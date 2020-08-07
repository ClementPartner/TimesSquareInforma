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
	/*------------------------------------------------------------*/

	/*-----------------------------------------------
		Deletar todos os registros cujas datas finais
		sejam anteriores a data atual.
	-----------------------------------------------*/
    require_once "../../_bd/bd-config.php";
    require_once "../../_bd/bd-connection.php";
    require_once "../../_bd/bd-crud.php";

	$where = date("Y-m-d");
	$where = "WHERE DataFinal < '$where'";
	
	DBDelete("grade", $where);
	/*-----------------------------------------------*/

	date_default_timezone_set("America/Sao_Paulo");

	$dir = "../../__cliente/_videos/";

	$arqsArray = array();
	$qtdeArqs  = 0;

	// Abrir o diretório e ler seu conteúdo.
	if (is_dir($dir)){
		if ($dh = opendir($dir)){
			while (($file = readdir($dh)) !== false){
				if(empty($file)   ||
					$file == '..' ||
					$file == '.'  ||
					is_dir($file)) continue;
		
				$data = date("Y/m/d H:i:s", filemtime($dir . $file));
				$arqsArray[$file] = $data;	
				$qtdeArqs++;
			}
			closedir($dh);
		}
	}

	/*--->>> Se for só em uma array $arqsArray.
	foreach($arqsArray as $x => $x_value) {
		echo "Key=" . $x . ", Value=" . $x_value;
		echo "<br>";
	}
	----------------------------*/

	// Ordem crescente, só do value.
	// sort($arqsArray);

	// Ordem decrescente do value, toda a linha.
	// arsort($arqsArray);

	// Ordem crescente da chave, toda a linha.
	// ksort($arqsArray);

	// asort($arqsArray);
	ksort($arqsArray);

	$arquivos = array();

	//--->>> Se for só em uma array $arqsArray.
	foreach($arqsArray as $x => $x_value) {
		$linha = array($x, $x_value);
		array_push($arquivos, $linha);
	
		//echo "Key=" . $x . ", Value=" . $x_value . "<br>";
	}

	$_SESSION["gradeDataInicial"] = isset($_SESSION["gradeDataInicial"]) ?
        $_SESSION["gradeDataInicial"] : "";
	$_SESSION["gradeDataFinal"]   = isset($_SESSION["gradeDataFinal"]) ?
        $_SESSION["gradeDataFinal"]   : "";
	$_SESSION["gradeHorario"]     = isset($_SESSION["gradeHorario"]) ?
        $_SESSION["gradeHorario"]     : "";
	$_SESSION["gradeVideo"]       = isset($_SESSION["gradeVideo"]) ?
        $_SESSION["gradeVideo"]       : "";

	$mensagem = isset($_SESSION['mensagem']) ?
		$_SESSION['mensagem'] : "";
	$_SESSION['mensagem'] = "";
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Moema Times Square - Grade</title>

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="../../_css/w3.css"/>
	<link rel="stylesheet" type="text/css" href="../../_css/estilo.css"/>
	<link rel="stylesheet" type="text/css" href="../../_css/login.css"/>
	<link rel="stylesheet" type="text/css" href="../../_css/upload.css"/>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

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
		
		form p {
			color: black;
			font-size: 20px;
			margin: 0;
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

	<div id="titulo02">	<span>PROGRAMAR</span> </div>

	<div class="box-geral">
		<div class="box-form" style="width: 500px;">
			<p class="linha-box-form">Programação</p>
			<form action="programar-arq.php" method="post" style="margin-top: 16px;"
					onsubmit="return validarForm()">
				<input type="hidden" name="txtHoje" id="idHoje" value="<?= date("Y-m-d"); ?>">				

				<?php if(!empty($mensagem)) { ?>
					<span id="idMsg"><?php print $mensagem; $mensagem = ""; ?></span>
				<?php } ?>

				<div class="w3-row-padding">
					<div class="w3-third">
					<p class="w3-center">Data inicial:<sup class="asteristico">*</sup></p>
					<input type="date" id="idDataInicial" name="txtDataInicial" class="texto-centro-16"
						style="width: 130px;"
						size="10" minlength="10" maxlength="10"
						onclick="closeMsg()" onkeydown="closeMsg()"
						value="<?php print $_SESSION['gradeDataInicial']; ?>"
						placeholder="01/01/2019" autofocus required>
					</div>

					<div class="w3-third">
					<p class="w3-center">Data final:<sup class="asteristico">*</sup></p>
					<input type="date" id="idDataFinal" name="txtDataFinal" class="texto-centro-16"
						style="width: 130px;"
						size="10" minlength="10" maxlength="10"
						onclick="closeMsg()" onkeydown="closeMsg()"
						value="<?php print $_SESSION['gradeDataFinal']; ?>"
						placeholder="01/01/2019" required>
					</div>

					<div class="w3-third">
					<p class="w3-center">Horário:<sup class="asteristico">*</sup></p>
					<select multiple id="idHorario" name="txtHorario[]" size="5"
						class="texto-centro-16" style="width: 100px;"
						value="<?php print $_SESSION['gradeHorario']; ?>"
						onclick="closeMsg()" onkeydown="closeMsg()" required>
						<option value="08 - 09">08 - 09</option>
						<option value="09 - 10">09 - 10</option>
						<option value="10 - 11">10 - 11</option>
						<option value="11 - 12">11 - 12</option>
						<option value="12 - 13">12 - 13</option>
						<option value="13 - 14">13 - 14</option>
						<option value="14 - 15">14 - 15</option>
						<option value="15 - 16">15 - 16</option>
						<option value="16 - 17">16 - 17</option>
						<option value="17 - 18">17 - 18</option>
						<option value="18 - 19">18 - 19</option>
						<option value="19 - 20">19 - 20</option>
						<option value="20 - 21">20 - 21</option>
						<option value="21 - 22">21 - 22</option>
						<option value="22 - 23">22 - 23</option>
						<option value="23 - 00">23 - 00</option>
						<option value="00 - 01">00 - 01</option>
						<option value="01 - 02">01 - 02</option>
						<option value="02 - 03">02 - 03</option>
						<option value="03 - 04">03 - 04</option>
						<option value="04 - 05">04 - 05</option>
						<option value="05 - 06">05 - 06</option>
						<option value="06 - 07">06 - 07</option>
						<option value="07 - 08">07 - 08</option>
					</select>
					</div>
				</div>

				<p class="w3-center">Vídeo:<sup class="asteristico">*</sup></p>
                <input type="text" id="idVideo" name="txtVideo" class="texto-centro-16"
                    size="30" minlength="5" maxlength="100"
					style="width: 300px;"
					onclick="closeMsg()" onkeydown="closeMsg()" onkeyup="videoFuncao()"
					value="<?php print $_SESSION['gradeVideo']; ?>"
                    placeholder="Selecione o vídeo na tabela abaixo." required>

				<div class="w3-responsive w3-center w3-text-white"
					style="background-color: black; padding: 0 10px; margin: 10px 0 16px 0;
						border-bottom: solid 3px #330066;
						height: 280px; width: 100%;">

					<table id="myTable" class="w3-hoverable">
					<thead>
						<tr>
							<th>Vídeo</th>
						</tr>
					</thead>

					<tbody style="color: black; background-color: white;">
						<?php for (	$i = 0; $i < count($arquivos); $i++) { ?>
							<tr onclick="LinhaClick(this)">
								<td><?= $arquivos[$i][0]; ?></td>
							</tr>
						<?php } ?>
					</tbody>
					</table>
				</div>

				<input class="w3-button w3-ripple w3-border button-entrar"
					type="submit" value="Gravar" />
			</form>

			<p> </p>
		</div>
	</div>

	<a href="manter-grade.php" class="w3-ripple button-voltar"
		style="text-decoration: none;">&laquo; Anterior</a>

	<p> </p>

	<script src="../../_funcoes/_javascript/funcoes-nav-vertical.js"></script>
	<script src="../../_funcoes/_javascript/funcoes-programar-grade.js"></script>

</div>
</body>

</html>

