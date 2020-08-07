<?php
    session_start();

	require_once "../../_funcoes/_php/funcoes_php.php";

	date_default_timezone_set("America/Sao_Paulo");

	$tipo = validar_entrada($_REQUEST["tipo"]);

    $emailEnviar = isset($_SESSION['usuarioEmail']) ? 
		validar_entrada($_SESSION['usuarioEmail']) : "#####";

	//Incluir a conexão com banco de dados.
    require_once "../../_bd/bd-config.php";
    require_once "../../_bd/bd-connection.php";
    require_once "../../_bd/bd-crud.php";

    // O campo email preenchido entra no if para validar.
    if (!empty($emailEnviar)) {
		$emailEnviar = DBEscape($emailEnviar);
	}
	else {
		$_SESSION['mensagem'] = "Senha não enviada !!!";
	    return false;
	}

	/*---------------------------------------------------------*/
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$email      = isset($_REQUEST["txtEmail"])       ?
			validar_entrada($_REQUEST["txtEmail"]) : "";
		$nome       = isset($_REQUEST["txtNome"])		 ?
			validar_entrada($_REQUEST["txtNome"])  : "";
        $ativo      = isset($_REQUEST["txtAtivo"])     ?
			validar_entrada($_REQUEST["txtAtivo"]) : "N";
        $nivel      = isset($_REQUEST["txtNivel"])       ?
			validar_entrada($_REQUEST["txtNivel"]) : 1;
        $telefone   = isset($_REQUEST["txtTelefone"])	 ?
			validar_entrada($_REQUEST["txtTelefone"]) : "";
	} else {
		$email      = "";
		$nome       = "";
        $ativo      = "N";
        $nivel      = 1;
        $telefone   = "";
        $cadastro 	= "2000-01-01";
	}
	/*---------------------------------------------------------*/
	
	// Email´s para onde serão enviados os dados recebidos.
	// $emailDestino = "betoreich@gmail.com"; // "contato@empresa.com.br, sac@empresa.com.br";
	if ($tipo == 1) {
		$emailDestino = $email;
	}
	if ($tipo == 2) {
		$emailDestino = $emailEnviar;
	}

	/*----------------------------------------------------------------
		Criar senha randômica.
		Daí encriptar esta senha random criada.
		Daí gravar na BD esta nova senha random encriptada para o
			email $emailEnviar.
		Daí montar o texto do corpo da mensagem com esta senha random
			criada.
		Daí enviar email para o $emailEnviar.
	-----------------------------------------------------------------*/

	// dentro do /_funcoes/_php/funcoes_php.php
	$novaSenha    = gerar_senha_aleatoria();
    $encryptsenha = password_hash($novaSenha, PASSWORD_DEFAULT);

	$imprimir = false;
	
	//------------------------------------------------------------
	// Novo usuário.
	if ($tipo == 1) {
		$imprimir = true;

		$dados = array(
			"Email" 		=> $email,
			"Senha" 		=> $encryptsenha,
			"Nome"  		=> $nome,
			"Telefone"		=> $telefone,
			"Data_Cadastro" => date("Y-m-d"),
			"Ativo"         => "S",
			"NivelAcesso"   => 1
		);

		$achou = DBRead("usuario", "*", "WHERE Email = '$email'");

		if ($achou) {
			$imprimir = false;
			$_SESSION['mensagem'] = "Usuário já incluído !";
		} else {
			DBCreate("usuario", $dados);

			$_SESSION['mensagem'] = "Usuário criado com sucesso!";
			//------------------------------------------------------------
	
			$assunto = "Site Moema Times Square: Novo usuário criado.";

			$corpo  = "Conforme sua solicitação no site do condomínio Moema Times Square, ";
			$corpo .= "um novo usuário foi criado para o login com este email.<br><br>";
			$corpo .= "Ao acessar o site na próxima vez, utilize este email para logar-se ";
			$corpo .= "e esta senha aleatória gerada abaixo, e complete os seus dados.<br><br>";
			$corpo .= "Observe que esta senha aleatória gerada pode conter caracteres maiúsculos, ";
			$corpo .= "minúsculos e números ! E precisa ser digitada exatamente como foi gerada !<br><br>";
			$corpo .= "Usuário criado para o email: $email<br><br>";
			$corpo .= "Senha aleatória gerada: $novaSenha<br><br>";
			$corpo .= "Em " . date("d/m/Y H:i:s") . " <br>";
		}
	}
	
	// Gravar a senha nova.
	if ($tipo == 2) {
		$imprimir = true;

		$dados = array(
			"Senha" => $encryptsenha
		);

		DBUpdate("usuario", $dados, "WHERE Email = '$emailEnviar'");

		$_SESSION['mensagem'] = "Senha enviada com sucesso!";
		//------------------------------------------------------------
	
		$assunto = "Site Moema Times Square: Nova senha criada.";

		$corpo  = "Conforme sua requisição no site do condomínio Moema Times Square, ";
		$corpo .= "uma nova senha aleatória foi gerada para o seu login.<br><br>";
		$corpo .= "Ao acessar o site na próxima vez, utilize esta senha aleatória gerada ";
		$corpo .= "e altere-a para uma de sua preferência.<br><br>";
		$corpo .= "Observe que esta senha aleatória gerada pode conter caracteres maiúsculos, ";
		$corpo .= "minúsculos e números ! E precisa ser digitada exatamente como foi gerada !<br><br>";
		$corpo .= "Nova senha aleatória gerada: $novaSenha<br><br>";
		$corpo .= "Em " . date("d/m/Y H:i:s") . " <br>";
	}

	/* Se houver necessidade de cabeçalho de email.
	--------------------------------------------------------
	$header  = "MIME-Version: 1.0\r\n";
	$header .= "Content-Type: text/html; charset=utf-8\r\n";
	$header .= "From: $email > Reply-to: $email \r\n";
	------------------------------------------------------*/

	// Sindico em cópia ???
	$copiarSindico = false;
	
	$enviou = false;

	if ($imprimir) {
		require_once "../_email/enviarPHPMailer.php";
	}

    // Exibe uma mensagem de resultado.
    if ($enviou) {
		$_SESSION["emailEnviado"] = "Enviada com sucesso !!!";
    } else {
		$_SESSION["emailEnviado"] = "Senha NÃO enviada !!!";
    }

	/*-------------------------------------
	if ($tipo == 1) {
		header("location:login-incluir-fale-conosco.php");
	}

	if ($tipo == 2) {
		header("location:login-entrar.php");
	}
	--------------------------------------*/
?>

<script>
    window.setTimeout("history.back(-1)", 200); // 200 milisegundos.
</script>
