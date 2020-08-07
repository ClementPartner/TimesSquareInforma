<?php
session_start();

require_once "../../_funcoes/_php/funcoes_php.php";

date_default_timezone_set("America/Sao_Paulo");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$nome  = validar_entrada($_REQUEST["txtNome"]);
	$email = validar_entrada($_REQUEST["txtEmail"]);
} else {
	$nome  = "";
	$email = "";
}

// Não enviar se $nome ou $email em branco.
if (empty($nome) || empty($email)) {
	$_SESSION["emailEnviado"] = "Não enviado - falta de assunto / corpo !!!";
    return false;
}

$origemMsgValida = false;

$origemMsg = isset($_REQUEST["txtOrigemMsg"]) ? 
   validar_entrada($_REQUEST["txtOrigemMsg"]) : "#######";

require_once "../../_configuracoes/config-Email.php";	

// Email recebido por POST.
$emailDestino = $email;

// Sindico em cópia ??? Será decidido em cada uma das origens de mensagem.
$copiarSindico = false;

$emailEspecifico = "";

$temAnexo   = "";
$arqsAnexar = "";

$gravou = false;
$enviou = false;
	
if ($origemMsg == "Fale Conosco") {
	$origemMsgValida = true;

	// Sindico em cópia ???
	$copiarSindico = true;

	$telefone  = isset($_REQUEST["txtTelefone"])	?
	   validar_entrada($_REQUEST["txtTelefone"]) 	: "(00) 0000-0000";
	$urgencia  = isset($_REQUEST["txtUrg"])			? 
	   validar_entrada($_REQUEST["txtUrg"]) 		: "0";
	$mensagem  = isset($_REQUEST["txtMsg"])			? 
	   validar_entrada($_REQUEST["txtMsg"])			: "####";

	$assunto = "Site Moema Times Square: " . $origemMsg;

	$corpo  = "Mensagem de Contato<br><br>";
	$corpo .= "<b>Origem:</b>    $origemMsg<br><br>";
	$corpo .= "<b>Nome:</b>      $nome<br>";
	$corpo .= "<b>Email:</b>     $email<br>";
	$corpo .= "<b>Telefone:</b>  $telefone<br>";
	$corpo .= "<b>Urgência:</b>  $urgencia<br>";
	$corpo .= "<b>Mensagem:</b>  $mensagem<br><br> Em " . date("d/m/Y H:i:s") . " <br>";
}

if ($origemMsg == "Linha Direta") {
	$origemMsgValida = true;

	// Sindico em cópia ???
	$copiarSindico = true;
		
	$urgencia   = isset($_REQUEST["txtUrg"])		? 
		validar_entrada($_REQUEST["txtUrg"]) 		: "0";
	$mensagem   = isset($_REQUEST["txtMsg"])		? 
		validar_entrada($_REQUEST["txtMsg"])		: "####";
	$requisicao = isset($_REQUEST["txtRequisicao"]) ? 
	    validar_entrada($_REQUEST["txtRequisicao"])	: "####";
	$temAnexo	= isset($_REQUEST["txtFoto"]) 		?
	    validar_entrada($_REQUEST["txtFoto"])		: "";
	$arqsAnexar = $_FILES["txtArqsFotos"];

	$assunto = "Site Moema Times Square: Linha Direta - " . $requisicao;

	$corpo  = "Mensagem de Contato<br><br>";
	$corpo .= "<b>Origem:</b>    $requisicao<br><br>";
	$corpo .= "<b>Nome:</b>      $nome<br>";
	$corpo .= "<b>Email:</b>     $email<br>";
	$corpo .= "<b>Telefone:</b>  " . $_SESSION["usuarioTelefone"] . "<br><br>";

	$corpo .= "<b>Pessoa:</b>    " . $_SESSION["usuarioTipoPessoa"] . "<br>";
	$corpo .= "<b>CPF/CNPJ:</b>  " . $_SESSION["usuarioCPFCNPJ"] . "<br><br>";

	$corpo .= "<b>Tipo:</b>      " . $_SESSION["usuarioTipoUsuario"] . "<br>";
	$corpo .= "<b>Unidade:</b>   " . $_SESSION["usuarioBloco"] . ", " 
		. $_SESSION["usuarioUnidade"] . "<br><br>";

	$corpo .= "<b>Atividade:</b> " . $_SESSION["usuarioAtividade"] . "<br><br>";

	$corpo .= "<b>Cadastro:</b>  " . $_SESSION["usuarioCadastro"] . "<br>";

	$corpo .= "<b>Urgência:</b>  $urgencia<br>";
	$corpo .= "<b>Mensagem:</b>  $mensagem<br><br> Em " . date("d/m/Y H:i:s") . " <br>";
}

if ($origemMsg == "Servicos") {
	$origemMsgValida = true;

	// Sindico em cópia ???
	$copiarSindico = true;
		
	$urgencia   = isset($_REQUEST["txtUrg"]) ? 
	    validar_entrada($_REQUEST["txtUrg"]) : "0";
	$mensagem   = isset($_REQUEST["txtMsg"]) ? 
	    validar_entrada($_REQUEST["txtMsg"]) : "####";
	$requisicao = isset($_REQUEST["txtRequisicao"]) ? 
	    validar_entrada($_REQUEST["txtRequisicao"])	: "####";

	if ($requisicao == "Reparos Emergenciais") {
		$emailEspecifico = EMAIL_REPAROS;
	}

	if ($requisicao == "2ª Via do boleto") {
		$emailEspecifico = EMAIL_2VIA_BOLETO;
		$copiarSindico = false;
	}

	if ($requisicao == "Reserva de Sala") {
		$emailEspecifico = EMAIL_RESERVA_SALA;
		$copiarSindico = false;
	}

	if ($requisicao == "Restaurante") {
		$emailEspecifico = EMAIL_RESTAURANTE;
	}

	if ($requisicao == "Estacionamento") {
		$emailEspecifico = EMAIL_ESTACIONAMENTO;
	}

	if ($requisicao == "Frans Café") {
		$emailEspecifico = EMAIL_FRANS_CAFE;
	}

	if ($requisicao == "Salão de beleza") {
		$emailEspecifico = EMAIL_SALAO_BELEZA;
	}

	if (($requisicao == "Mudança - Adagio") ||
	    ($requisicao == "Reforma - Adagio")) {
		$emailEspecifico = EMAIL_MUDANCA_ADAGIO;
		$copiarSindico = false;
	}

	if (($requisicao == "Mudança - Mercure") ||
	    ($requisicao == "Reforma - Mercure")) {
		$emailEspecifico = EMAIL_MUDANCA_MERCURE;
		$copiarSindico = false;
	}

	if (($requisicao == "Mudança - Wall Street") ||
	    ($requisicao == "Reforma - Wall Street")) {
		$emailEspecifico = EMAIL_MUDANCA_WALL;
		$copiarSindico = false;
	}

	$assunto = "Site Moema Times Square: Serviço - " . $requisicao;

	$corpo  = "Mensagem de Contato<br><br>";
	$corpo .= "<b>Origem:</b>    $requisicao<br><br>";
	$corpo .= "<b>Nome:</b>      $nome<br>";
	$corpo .= "<b>Email:</b>     $email<br>";
	$corpo .= "<b>Telefone:</b>  " . $_SESSION["usuarioTelefone"] . "<br><br>";

	$corpo .= "<b>Pessoa:</b>    " . $_SESSION["usuarioTipoPessoa"] . "<br>";
	$corpo .= "<b>CPF/CNPJ:</b>  " . $_SESSION["usuarioCPFCNPJ"] . "<br><br>";

	$corpo .= "<b>Tipo:</b>      " . $_SESSION["usuarioTipoUsuario"] . "<br>";
	$corpo .= "<b>Unidade:</b>   " . $_SESSION["usuarioBloco"] . ", " 
		. $_SESSION["usuarioUnidade"] . "<br><br>";

	// $corpo .= "<b>Atividade:</b> " . $_SESSION["usuarioAtividade"] . "<br><br>";

	$corpo .= "<b>Cadastro:</b>  " . $_SESSION["usuarioCadastro"] . "<br>";

	$corpo .= "<b>Urgência:</b>  $urgencia<br>";
	$corpo .= "<b>Mensagem:</b>  $mensagem<br><br> Em " . date("d/m/Y H:i:s") . " <br>";
}

if (!$origemMsgValida) {
	$_SESSION["emailEnviado"] = "Não enviado - falta de origem !!!";
    return false;
}

require_once "enviarPHPMailer.php";

// Exibe uma mensagem de resultado.
if ($enviou) {
    echo "Seu email foi enviado com sucesso! " . $time . "<br><br>";
	$_SESSION["emailEnviado"] = "Enviado com sucesso !!!";
} else {
    echo "Houve um erro enviando o email: " . $time . "<br><br>" . $mail->ErrorInfo;
	$_SESSION["emailEnviado"] = "Não enviado !!!";
}

if ($origemMsg == "Fale Conosco") {
	header("location:../_fale-conosco/fale-conosco.php");
}

if ($origemMsg == "Linha Direta") {
	header("location:../_linha-direta/linha-direta.php");
}

if ($origemMsg == "Servicos") {
	header("location:../_servicos/servicos.php");
}
?>
