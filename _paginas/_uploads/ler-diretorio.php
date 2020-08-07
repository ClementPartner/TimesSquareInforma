<?php
session_start();

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
		
		$data = date("Y/m/d H:i:s", filectime($dir . $file));
		
		//echo "Arquivo: " . $file . ", em " . date("d/m/Y H:i:s", filemtime($file)) . "<br>";

		//$detalhe = array($file, date("d/m/Y H:i:s", filemtime($file)));

		//array_push($arqsArray, $detalhe);
		
		//$arqsArray[$data] = $file;
		$arqsArray[$file] = $data;
		
		$qtdeArqs++;
    }
    closedir($dh);
  }
}

//echo "<br>Acabou. Com $qtdeArqs<br><br>";

//echo "Contador de registros: " . count($arqsArray) . "<br><br>";

//print_r($arqsArray);

//echo "<br><br>";

/*--->>> Se for array $detalhe dentro de array $arqsArray.
$i = 0;

for ($i = 0; $i < $qtdeArqs; $i++) {
	echo "Nome: " . $arqsArray[$i][0] . " Data: " . $arqsArray[$i][1] . "<br>";
}
---------------------------------------------------------*/

/*--->>> Se for só em uma array $arqsArray.
foreach($arqsArray as $x => $x_value) {
    echo "Key=" . $x . ", Value=" . $x_value;
    echo "<br>";
}
----------------------------*/

//echo "<br>Odenada pela data.<br><br>";

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

//print_r($arquivos);
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Moema Times Square - Upload</title>

	<link rel="stylesheet" type="text/css" href="../../_css/w3.css"/>
	<link rel="stylesheet" type="text/css" href="../../_css/estilo.css"/>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
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

	<div id="titulo02">	<span>CONSULTA UPLOAD</span></div>

	<div class="box-geral">
		<div class="w3-responsive w3-center w3-text-white"
				style="background-color: black; padding: 0 10px; height: 400px; width: 400px;">

			<p> </p>

			<table id="myTable" class="w3-hoverable">
				<thead>
					<tr>
						<th>Data</th>
						<th>Arquivo</th>
					</tr>
				</thead>
					
				<tbody style="color: black; background-color: white;">
					<?php for (	$i = 0; $i < count($arquivos); $i++) { ?>
						<tr onclick="LinhaClick(this)">
							<td style="text-align: center; ">
								<?= $arquivos[$i][1]; ?></td>
							<td><?= $arquivos[$i][0]; ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>

			<p> </p>

		</div>

		<p> </p>
	</div>

	<a id="idDeletar" href="#" class="glyphicon glyphicon-trash botao-lixo w3-ripple"
		role="button"></a>
 
	<a href="../_login/login-home.php" class="w3-ripple button-voltar"
		style="text-decoration: none;">&laquo; Anterior</a>

	<p> </p>

	<script>		
		var idDeletar = document.getElementById("idDeletar");
		idDeletar.style.display = "none";

		function LinhaClick(x) {
			quemDeletar = document.getElementById("myTable").rows[x.rowIndex].cells[1].innerHTML;
			idDeletar.href = "deletar-arq.php?arq=" + quemDeletar;	
			idDeletar.innerHTML = " " + quemDeletar + "?";
			idDeletar.style.display = "block";
		}
		
		function DeletarClick() {
			idDeletar.style.display = "none";
		}
	</script>

	<script src="../../_funcoes/_javascript/funcoes-nav-vertical.js"></script>

</div>
</body>

</html>

