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

	//Incluir a conexão com banco de dados.
    require_once "../../_bd/bd-config.php";
    require_once "../../_bd/bd-connection.php";
    require_once "../../_bd/bd-crud.php";

	/*******************************************************
	Para alterar qualquer informação sobre a configuração da
	Base de dados, tal como: 
		DB_HOSTNAME = 'localhost'
		DB_USERNAME = 'root'
		DB_PASSWORD = null
		DB_DATABASE = 'moema'
		DB_PREFIX'  = 'cw')  > prefixo nas tabelas.
		DB_CHARSET  = 'utf8' > // Não pode ter traço = utf-8.

	Deve-se fazer no arq. /_bd/bd-config.php !!!!
	********************************************************/
	
	/*======================================================
	Blindar contra SQL Injection.
            
	validar_entrada($data)
		está na nossa ../_funcoes/_php/funcoes_php.php.
	======================================================*/

    require_once "../../_funcoes/_php/funcoes_php.php";

	/*---------------------------------------------------
		Já que o usuário foi incluído "a força" ao tentar
		entrar, ele já foi cadastrado com email e senha
		aleatória. Portanto, agora só resta alterá-lo.
				
    <input type="hidden" name="txtCrud"  value="incluir">
	---------------------------------------------------*/

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$crud       = isset($_REQUEST["txtCrud"])        ?
			validar_entrada($_REQUEST["txtCrud"]) : "";
		$email      = isset($_REQUEST["txtEmail"])       ?
			validar_entrada($_REQUEST["txtEmail"]) : "";
		$senha      = isset($_REQUEST["txtSenha"])       ?
			validar_entrada($_REQUEST["txtSenha"]) : "";
		$nome       = isset($_REQUEST["txtNome"])		 ?
			validar_entrada($_REQUEST["txtNome"])  : "";
        $ativo      = isset($_REQUEST["txtAtivo"])     ?
			validar_entrada($_REQUEST["txtAtivo"]) : "N";
        $nivel      = isset($_REQUEST["txtNivel"])       ?
			validar_entrada($_REQUEST["txtNivel"]) : 1;
        $tipo       = isset($_REQUEST["txtTipoUsuario"]) ?
			validar_entrada($_REQUEST["txtTipoUsuario"]) : "";
		$pessoa     = isset($_REQUEST["txtTipoPessoa"])	 ?
			validar_entrada($_REQUEST["txtTipoPessoa"]) : "Fisica";
        $cpfcnpj    = isset($_REQUEST["txtCPFCNPJ"])	 ?
			validar_entrada($_REQUEST["txtCPFCNPJ"]) : "";
        $atividade  = isset($_REQUEST["txtAtividade"])	 ?
			validar_entrada($_REQUEST["txtAtividade"]) : "";
        $endereco   = isset($_REQUEST["txtEndereco"])	 ?
			validar_entrada($_REQUEST["txtEndereco"]) : "";
        $telefone   = isset($_REQUEST["txtTelefone"])	 ?
			validar_entrada($_REQUEST["txtTelefone"]) : "";
        $bloco	    = isset($_REQUEST["txtBloco"])		 ?
			validar_entrada($_REQUEST["txtBloco"]) 	 : "";
        $unidade    = isset($_REQUEST["txtUnidade"])	 ?
			validar_entrada($_REQUEST["txtUnidade"]) : "";
        $nascimento = isset($_REQUEST["txtNascimento"])	 ?
			validar_entrada($_REQUEST["txtNascimento"]) : "2000-01-01";
        $cadastro 	= isset($_REQUEST["txtDataCadastro"])	 ?
			validar_entrada($_REQUEST["txtDataCadastro"]) : date("Y-m-d");
        $ultAcesso  = isset($_REQUEST["txtDataUltAcesso"])	 ?
			validar_entrada($_REQUEST["txtDataUltAcesso"]) : date("Y-m-d");
	} else {
		$crud       = "";
		$email      = "";
		$senha      = "";
		$nome       = "";
        $ativo      = "N";
        $nivel      = 1;
        $tipo       = "";
        $bloco      = "";
        $unidade    = "";
		$pessoa     = "Fisica";
        $cpfcnpj    = "";
        $atividade  = "";
        $endereco   = "";
        $telefone   = "";
        $nascimento = "2000-01-01";
        $cadastro 	= "2000-01-01";
        $ultAcesso  = "2000-01-01";
	}

    // O campo email e senha preenchido entra no if para validar.
    if ((!empty($email)) && (!empty($senha))) {

		/*======================================================
        Função de limpeza de caracteres "invasores", como aspas,
			prevenindo SQL injection.
            
		DBEscape está na nossa connectionbd.php.
		======================================================*/
		$crud       = DBEscape($crud);
		$email      = DBEscape($email);
		$senha      = DBEscape($senha);
		$nome       = DBEscape($nome);
        $ativo      = DBEscape($ativo);
        $nivel      = DBEscape($nivel);
        $tipo       = DBEscape($tipo);
        $bloco      = DBEscape($bloco);
        $unidade    = DBEscape($unidade);
		$pessoa     = DBEscape($pessoa);
        $cpfcnpj    = DBEscape($cpfcnpj);
        $atividade  = DBEscape($atividade);
        $endereco   = DBEscape($endereco);
        $telefone   = DBEscape($telefone);
        $nascimento = DBEscape($nascimento);
        $cadastro 	= DBEscape($cadastro);
        $ultAcesso  = DBEscape($ultAcesso);

		/*---------------------------------------------------------------------------------------
			Está aqui só para exemplo. Original no Curso PHP Básico.../24.cryptsenha.php.
		-----------------------------------------------------------------------------------------
        $senhacrypt1 = crypt($senha, "_S4..hak1"); // CRYPT_EXT_DES.
        @$senhacrypt1 = crypt($senha, "$5$rounds=5000$anexamplestringforsalt$"); // CRYPT_SHA256.
        @$senhacrypt1 = crypt($senha, "$6$rounds=5000$anexamplestringforsalt$"); // CRYPT_SHA512.

        Preferência de uso será esta abaixo = Password_Hash.
        $senhacrypt = password_hash($senha, PASSWORD_DEFAULT);
        ---------------------------------------------------------------------------------------*/

        $senha = password_hash($senha, PASSWORD_DEFAULT);

		$dados = array(
			"Email"            => $email,
			"Senha"            => $senha,
			"Nome"             => $nome,
            "TipoUsuario"      => $tipo,
			"TipoPessoa"       => $pessoa,
            "CPF_CNPJ"         => $cpfcnpj,
            "Atividade"        => $atividade,
            "Endereco"         => $endereco,
            "Telefone"         => $telefone,
            "Bloco"	           => $bloco,
            "Unidade"          => $unidade,
            "Data_Aniversario" => $nascimento,
			"Data_Cadastro"    => $cadastro,
			"Data_Ult_Acesso"  => $ultAcesso,
			"Ativo"            => $ativo,
			"NivelAcesso"      => $nivel
		);

		// Buscar na tabela usuario o $email.
		$existe = DBRead("usuario", "Email", "WHERE Email = '$email'");

		$_SESSION['mensagem'] = "";

		if(!$existe) {
			if($crud == "incluir") {
				DBCreate("usuario", $dados);
				$_SESSION['mensagem'] = "Usuário criado com sucesso!";
			}
			else {
				alert("Usuário não cadastrado !!! Redigite-o...");
			}
		}
		else {
			if($crud == "alterar") {
				DBUpdate("usuario", $dados, "WHERE Email = '$email'");
				$_SESSION['mensagem'] = "Usuário alterado com sucesso!";
			}
			else {
				alert("Usuário já cadastrado !!! Redigite-o...");
			}
		}

		// Só recarregar os dados para alteração.
		if($crud == "alterar") {
			$dados = DBRead("usuario", "*", "WHERE Email = '$email'");

			$_SESSION['usuarioId']		    = $dados[0]['Id'];
			$_SESSION['usuarioEmail'] 		= $dados[0]['Email'];
			$_SESSION['usuarioSenha'] 		= $dados[0]['Senha'];
			$_SESSION['usuarioNome']  		= $dados[0]['Nome'];
			$_SESSION['usuarioAtivo']       = $dados[0]['Ativo'];
			$_SESSION['usuarioNivelAcesso'] = $dados[0]['NivelAcesso'];
			$_SESSION['usuarioTipoUsuario'] = $dados[0]['TipoUsuario'];
			$_SESSION['usuarioTipoPessoa'] 	= $dados[0]['TipoPessoa'];
			$_SESSION['usuarioCPFCNPJ'] 	= $dados[0]['CPF_CNPJ'];
			$_SESSION['usuarioAtividade'] 	= $dados[0]['Atividade'];
			$_SESSION['usuarioEndereco'] 	= $dados[0]['Endereco'];
			$_SESSION['usuarioTelefone'] 	= $dados[0]['Telefone'];
			$_SESSION['usuarioBloco']	 	= $dados[0]['Bloco'];
			$_SESSION['usuarioUnidade'] 	= $dados[0]['Unidade'];
			$_SESSION['usuarioAniversario']	= $dados[0]['Data_Aniversario'];
			$_SESSION['usuarioCadastro'] 	= $dados[0]['Data_Cadastro'];
			$_SESSION['usuarioUltAcesso'] 	= $dados[0]['Data_Ult_Acesso'];
		}
	}
?>
		
<script>
    window.setTimeout("history.back(-1)", 200); // 200 milisegundos.
</script>
