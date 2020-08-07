<?php
    session_start();

	if(!isset($_COOKIE["Moema"])) {
		setcookie("Moema", "", time() - 86400);
		header("location:../../index.php");
	}
	else {
		if(count($_COOKIE) <= 0) {
			setcookie("Moema", "", time() - 86400);
			header("location:../../index.php");			
		}
	}
	/*------------------------------------------------------------*/

	if ((!isset($_SESSION["usuarioAtivo"])) ||
		($_SESSION["usuarioAtivo"] == NULL) ||
		($_SESSION["usuarioAtivo"] != "S")) {
		 $_SESSION['mensagem'] = "Usuário saiu !!!";
		header("Location: ../_login/login-entrar.php");
	}

	$origem = isset($_REQUEST["origem"]) ? ($_REQUEST["origem"]) : 0;

	if (($origem != 1) && ($origem != 2)) {
		$_SESSION['mensagem'] = "Sem origem !!!";
		header("Location: ../_login/login-sair.php");
	}

	if ($origem == 1) {
		$titulo = "Fale Conosco";
		$tabela = "faleconosco";
	}

	if ($origem == 2) {
		$titulo = "Requisições";
		$tabela = "requisicao";
	}
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Moema Times Square - <?= $titulo; ?></title>

	<link rel="stylesheet" type="text/css" href="../../_css/estilo.css"/>
	<link rel="stylesheet" type="text/css" href="../../_css/w3.css"/>

	<style>
		table {
			font-family: arial, sans-serif;
			border-collapse: collapse;
			width: 100%;
			border: 1px solid green;
		}

		th {
			border: 1px solid green;
			text-align: center;
			padding: 8px;
			background-color: green;
		}

		td {
			border: 1px solid green;
			text-align: left;
			padding: 8px;
		}

		tr:nth-child(even) {
			color: #000;
			background-color: #dddddd;
		}

		.w3-hoverable tbody tr:hover {
			color: #fff;
			background-color: #0000ff;
		}		
	</style>

    <!-- Selecionar os registros a serem mostrados. -->
    <?php
        require_once "../../_bd/bd-config.php";
        require_once "../../_bd/bd-connection.php";
        require_once "../../_bd/bd-crud.php";

        // No MySQL começa a leitura do LIMIT em 0.
        if(!isset($_SESSION["aPartirDoRegistro"])) {
            $_SESSION["aPartirDoRegistro"] = 0;
        }

        if(!isset($_SESSION["totalRegistros"])) {
            $_SESSION["totalRegistros"] = 0;
        }

        $aPartirDoRegistro = $_SESSION["aPartirDoRegistro"];
        $totalRegistros    = $_SESSION["totalRegistros"];
        $regPorPagina      = 10;

        if(isset($totalRegistros))  {
            if($totalRegistros < 1) {
                $totalRegistros = DBRead($tabela, "COUNT(*)");
                $totalRegistros = $totalRegistros[0]["COUNT(*)"];
                $_SESSION["totalRegistros"] = $totalRegistros;
            }
        }
        else {
            $totalRegistros = DBRead($tabela, "COUNT(*)");
            $totalRegistros = $totalRegistros[0]["COUNT(*)"];
            $_SESSION["totalRegistros"] = $totalRegistros;
        }

        $dados = DBRead($tabela, "*", null,
            "ORDER BY Situacao, DataCriacao",
            "LIMIT $aPartirDoRegistro, $regPorPagina");
    ?>
</head>

<body class="imagem-fundo">

<div id="interface">
	<div id="titulo01">
		<span>TIMES SQUARE INFORME</span>

		<div id="idSidepanel" class="sidepanel">
			<a href="../_captcha/captcha-usar.php?tipo=2" class="item">LOGIN</a>
			<a href="#" class="item" onclick="alertaMenu()">INFORMAÇÕES</a>
			<a href="../_negocios/negocios.php" class="item">NEGÓCIOS E OPORTUNIDADES</a>
			<a href="#" class="item" onclick="alertaMenu()">SERVIÇOS</a>
			<a href="../_captcha/captcha-usar.php?tipo=1" class="item last-item">FALE CONOSCO</a>
		</div>

		<button id="btnOpenNav" onclick="openNav()">☰</button> 
	</div>

	<div class="box-geral" style="background-color: black;">
		<div class="w3-responsive w3-center w3-text-white">
			<table id="myTable" class="w3-hoverable">
				<thead>
					<tr>
						<th>Data</th>
						<th>Situação</th>
						<th>Nome</th>
						<th>Email</th>
						<th>Telefone</th>
						<th>Urgência</th>
						<th>Mensagem</th>
					</tr>
				</thead>

				<?php
					$qtde = $totalRegistros - $aPartirDoRegistro;
					if ($qtde > 10) {
						$qtde = 10;
					}
				?>
					
				<tbody>
					<?php for (	$i = 0; $i < $qtde; $i++) { ?>
					<tr onclick="LinhaClick(this)">			
						<td style="display: none;">      <?= $dados[$i]["Id"] ?></td>
						<td style="text-align: center; "><?= $dados[$i]["DataCriacao"] ?></td>
						<td style="text-align: center; "><?= $dados[$i]["Situacao"] ?></td>
						<td><?= $dados[$i]["Nome"] ?></td>
						<td><?= $dados[$i]["Email"] ?></td>
						<td style="text-align: center; "><?= $dados[$i]["Telefone"] ?></td>
						<td style="text-align: center; "><?= $dados[$i]["Urgencia"] ?></td>
						<td style="text-align: justify;"><?= $dados[$i]["Mensagem"] ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>

			<a id="idDetalhar" href="fale-conosco-editar.php" style="font-size: 20px;"
				class="w3-center w3-button w3-ripple w3-orange
					w3-mobile w3-margin-top estilo-margin-leftright-4
					w3-round-xlarge">Detalhar este contato / mensagem</a> 

			<a href="paginar-tabela.php?v=-10" style="font-size: 20px;"
				class="w3-center w3-button w3-ripple estilo-green
					w3-mobile w3-margin-top estilo-margin-leftright-4
					w3-border w3-round-xlarge w3-border-green">Página anterior</a>
			<a href="paginar-tabela.php?v=10" style="font-size: 20px;"
				class="w3-center w3-button w3-ripple estilo-green
					w3-mobile w3-margin-top estilo-margin-leftright-4
					w3-border w3-round-xlarge w3-border-green">Próxima página</a>

			<p> </p>
		</div>

		<script>		
			var idDetalhar = document.getElementById("idDetalhar");

			idDetalhar.style.display = "none";

			function LinhaClick(x) {
				quemId = document.getElementById("myTable").rows[x.rowIndex].cells[0].innerHTML;
				idDetalhar.innerHTML = "Detalhar este contato / mensagem";
				idDetalhar.href = "fale-conosco-editar.php?id=" + quemId + "&origem=<?= $origem; ?>";
				idDetalhar.style.display = "block";
			}
		</script>

		<p> </p>

	</div>

	<a href="../_login/login-home.php" class="w3-ripple button-voltar">&laquo; Anterior</a>

	<p> </p>

	<script src="../../_funcoes/_javascript/funcoes-nav-vertical.js"></script>

</div>
</body>

</html>
