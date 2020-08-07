<?php
    session_start();
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Moema Times Square - Mural</title>

	<link rel="stylesheet" type="text/css" href="../../_css/w3.css"/>
	<link rel="stylesheet" type="text/css" href="../../_css/estilo.css"/>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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
		}

		#idPesquisar {
			padding: 6px;
			border: none;
			font-size: 17px;
		}

		form {
			font-family: Arial, Helvetica, sans-serif;
		}
		
		form button {
			color: white;
			background-color: black;
			font-size: 23px;
			padding-bottom: 4px;
			border: solid 2px black;
		}
		
		form button:hover, form button:focus {
			color: white;
			background-color: blue;
		}

		/*----------------------------------
		.w3-hoverable thead tr th:hover {
			color: blue;
			background-color: yellow;
			//cursor: pointer;
		}
		----------------------------------*/
	</style>

    <?php
        require_once "../../_bd/bd-config.php";
        require_once "../../_bd/bd-connection.php";
        require_once "../../_bd/bd-crud.php";

		// Só mostrar os Ativo = "S".
		$whereLike = "WHERE Ativo = 'S' AND Atividade <> ''";

        if (!isset($_SESSION["whereLike"])) {
            $_SESSION["whereLike"] = null;
        } else {
			if (empty($_SESSION["whereLike"])) {
				$_SESSION["whereLike"] = null;
			} else {
				$whereLike .= $_SESSION["whereLike"];
			}
		}

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
                $totalRegistros = DBRead("usuario", "COUNT(*)", $whereLike);
                $totalRegistros = $totalRegistros[0]["COUNT(*)"];
                $_SESSION["totalRegistros"] = $totalRegistros;
            }
        }
        else {
            $totalRegistros = DBRead("usuario", "COUNT(*)", $whereLike);
            $totalRegistros = $totalRegistros[0]["COUNT(*)"];
            $_SESSION["totalRegistros"] = $totalRegistros;
        }

        $dados = DBRead("usuario", "Nome, TipoPessoa, Atividade, Telefone", $whereLike,
			// null,
            // "ORDER BY Situacao, DataCriacao",
            "ORDER BY Atividade, Nome",
            "LIMIT $aPartirDoRegistro, $regPorPagina");
    ?>
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

	<div id="titulo02">	<span>CONSULTA</span> </div>

	<div class="box-geral">
		<div class="w3-responsive w3-center w3-text-white"
				style="background-color: black; padding: 0 10px;">

			<p> </p>

			<form action="pesquisar.php">
				Pesquisar: <input type="text" id="idPesquisar" name="txtPesquisar"
					size="30" maxlength="50"
					placeholder="dentista, advogado, médico, etc." autofocus>				
				<button type="submit"><i class="fa fa-search"></i></button>
			</form>

			<p> </p>

			<table id="myTable" class="w3-hoverable">
				<thead>
					<tr>
						<th>Nome</th>
						<th>Pessoa</th>
						<th>Atividade</th>
						<th>Telefone</th>
					</tr>
				</thead>

				<?php
					$qtde = $totalRegistros - $aPartirDoRegistro;
					if ($qtde > 10) {
						$qtde = 10;
					}
				?>
					
				<tbody style="color: black; background-color: white;">
					<?php for (	$i = 0; $i < $qtde; $i++) { ?>
						<tr>			
							<td><?= $dados[$i]["Nome"] ?></td>
							<td><?= $dados[$i]["TipoPessoa"] ?></td>
							<td><?= $dados[$i]["Atividade"] ?></td>
							<td style="text-align: center; "><?= $dados[$i]["Telefone"] ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>

			<a href="../_fale-conosco/paginar-tabela.php?v=-10" style="font-size: 20px;"
				class="w3-center w3-button w3-ripple estilo-lilas
					w3-mobile w3-margin-top estilo-margin-leftright-4"> < Página anterior</a>
			<a href="../_fale-conosco/paginar-tabela.php?v=10" style="font-size: 20px;"
				class="w3-center w3-button w3-ripple estilo-lilas
					w3-mobile w3-margin-top estilo-margin-leftright-4">Próxima página ></a>

			<p> </p>
		</div>
		
		<p> </p>
	</div>

	<a href="../_negocios/negocios.php" class="w3-ripple button-voltar">&laquo; Anterior</a>

	<p> </p>

	<script src="../../_funcoes/_javascript/funcoes-nav-vertical.js"></script>

</div>
</body>

</html>
