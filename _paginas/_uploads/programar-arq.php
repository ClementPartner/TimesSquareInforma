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

    require_once "../../_funcoes/_php/funcoes_php.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$dataInicial = isset($_REQUEST["txtDataInicial"]) ?
			validar_entrada($_REQUEST["txtDataInicial"])  : "2000-01-01";
		$dataFinal   = isset($_REQUEST["txtDataFinal"])   ?
			validar_entrada($_REQUEST["txtDataFinal"])    : "2000-01-01";
		$horario     =      $_REQUEST["txtHorario"];
        $video       = isset($_REQUEST["txtVideo"])       ?
			validar_entrada($_REQUEST["txtVideo"])        : "";
	} else {
		$dataInicial = "2010-01-01";
		$dataFinal   = "2010-01-01";
		$horario     = "";
        $video       = "";
	}

	//Incluir a conexão com banco de dados.
    require_once "../../_bd/bd-config.php";
    require_once "../../_bd/bd-connection.php";
    require_once "../../_bd/bd-crud.php";

    // O campo email e senha preenchido entra no if para validar.
    if (!empty($video)) {
		$dataInicial = DBEscape($dataInicial);
		$dataFinal   = DBEscape($dataFinal);
		$horario     = DBEscape($horario);
        $video       = DBEscape($video);

		foreach ($horario as $value) {
			$horaInicial = substr($value, 0, 2) . ":00:00"; 
			$horaFinal   = substr($value, 0, 2) . ":59:59"; 

			$dados = array(
				"DataInicial" => $dataInicial,
				"DataFinal"   => $dataFinal,
				"HoraInicial" => $horaInicial,
				"HoraFinal"   => $horaFinal,
				"Ordem"		  => 5,
				"Video"       => $video
			);

			$where  = " WHERE DataInicial = '$dataInicial'";
			$where .= "   AND DataFinal   = '$dataFinal'";
			$where .= "   AND HoraInicial = '$horaInicial'";
			$where .= "   AND HoraFinal   = '$horaFinal'";
			$where .= "   AND Video       = '$video' ";

			// Buscar na tabela grade todos os campos.
			$existe = DBRead("grade", "DataInicial", "$where");

			$_SESSION['mensagem'] = "";

			if(!$existe) {
				DBCreate("grade", $dados);
				$_SESSION['mensagem'] = "Programação criada com sucesso!";
			} else {
				DBUpdate("grade", $dados, "$where");
				$_SESSION['mensagem'] = "Programação alterada com sucesso!";
			}

			$_SESSION["gradeDataInicial"] = $dataInicial;
			$_SESSION["gradeDataFinal"]   = $dataFinal;
			$_SESSION["gradeHorario"]     = $value;
			$_SESSION["gradeVideo"]       = $video;	
		}

		unset($value);
	}
?>

<script>
    window.setTimeout("history.back(-1)", 50); // 50 milisegundos.
</script>
