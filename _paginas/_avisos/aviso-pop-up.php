<?php
    session_start(); 

	//Incluir a conexão com banco de dados.
    require_once "../../_bd/bd-config.php";
    require_once "../../_bd/bd-connection.php";
    require_once "../../_bd/bd-crud.php";

	$abrir = "openPopUp";
	
	/* Buscar na tabela aviso o último aviso cadastrado.
	--------------------------------------------------*/
	$dados = DBRead("aviso", "Id, Titulo, Descricao, Data",  null, "ORDER BY Id DESC", "LIMIT 10");

	if($dados){
		$avisoId 		= $dados[0]["Id"];
		$avisoTitulo 	= $dados[0]["Titulo"];
		$avisoDescricao = $dados[0]["Descricao"];
		$avisoData 		= date_format(date_create($dados[0]["Data"]), "d/m/Y");
	} else {
		$avisoId 		= 0;
		$avisoTitulo 	= "";
		$avisoDescricao = "";
		$avisoData 		= date_format(date_create("1900-01-01"), "d/m/Y");
		$abrir = "";
	}

	/* Buscar na tabela usuário o $_SESSION['usuarioId'].
	---------------------------------------------------*/

	$usuarioId = $_SESSION['usuarioId'];

	$dados = DBRead("usuario", "Aviso, Data_Aviso", "WHERE Id = $usuarioId");

	if (($dados) && ($abrir)) {
		/* Se não existir, zerar o valor.
		-------------------------------*/
		if (empty($dados[0]["Aviso"])) {
			$dados[0]["Aviso"] = 0;
		}

		/* Verificar se o usuário já leu o aviso.
		---------------------------------------*/
		if ($dados[0]["Aviso"] >= $avisoId) {
			$abrir = "";
		} else {
			$dados = array(
				"Aviso"   	 => $avisoId,
				"Data_Aviso" => date("Y-m-d")
			);
			DBUpdate("usuario", $dados, "WHERE Id = $usuarioId");
		}
	} else {
		$dados = array(
			"Aviso"   	 => $avisoId,
			"Data_Aviso" => date("Y-m-d")
		);
		DBCreate("usuario", $dados);
	}
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="../../_css/avisos-pop-up.css"/>
</head>

<body onload="openPopUp()">
	<div id="myPopUp" class="pop-up-overlay">
		<div class="pop-up-overlay-content">
			<span class="aviso">Aviso !</span>
			<a href="javascript:void(0)" class="closebtn" onclick="closePopUp()">&times;</a>
			<p class="aviso-titulo"><?php print $avisoTitulo; ?></p>
			<p class="aviso-data"><?php echo $avisoData; ?></p>
			<a href="javascript:void(0)" class="botao-mais" style="color: blue;">[+]</a>
		</div>
	</div>

	<script src="../../_funcoes/_javascript/funcoes-pop-up.js"></script>

</body>
</html>
