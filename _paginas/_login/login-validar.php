<?php
    session_start(); 

    require_once "../../_bd/bd-config.php";
    require_once "../../_bd/bd-connection.php";
    require_once "../../_bd/bd-crud.php";

	/*******************************************************
	Para alterar qualquer informação sobre a configuração da
	Base de dados, tal como: 
		DB_HOSTNAME = 'localhost'
		DB_USERNAME = 'root'
		DB_PASSWORD = null
		DB_DATABASE = 'bdcliente'
		DB_PREFIX'  = 'cw')  > prefixo nas tabelas.
		DB_CHARSET  = 'utf8' > // Não pode ter traço = utf-8.

	Deve-se fazer no arq. /_bd/bd-config.php !!!!
	********************************************************/

	/*======================================================
	Blindar contra SQL Injection.
            
	validar_entrada($data)
		está na nossa ../../_funcoes/_php/funcoes_php.php.
	======================================================*/

    require_once "../../_funcoes/_php/funcoes_php.php";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$login 	 = validar_entrada($_REQUEST["txtEmail"]);
		$senha 	 = validar_entrada($_REQUEST["txtSenha"]);
		$lembrar = validar_entrada($_REQUEST["txtLembrar"]);
	} else {
		$login   = "";
		$senha   = "";
		$lembrar = "naolembrarse";
	}

	/*----------------------------------------------------------------
		Criar um Cookie com o email digitado se for para "Lembrar-se".
		--------------------------------------------------------------
	
		A "/" indica que estará disponível para o website inteiro.   
		A função setcookie() deve aparecer ANTES da tag <html>.	   
	----------------------------------------------------------------*/
	if ($lembrar == "lembrarse") {
		$cookie_name  = "MTSLembrar";
		$cookie_value = DBEscape($login);
		$cookie_tempo = 3600 * 24 * 30;  // 3600 = 1 hora (60 min x 60 s), * 24 horas, * 30 dias.
	} else {
		$cookie_name  = "MTSLembrar";
		$cookie_value = "";
		$cookie_tempo = -86400;
	}

	setcookie($cookie_name, 
			  $cookie_value, 
			  time() + $cookie_tempo,
			  "/");
	/*---------------------------------------------------------*/
		
    // O campo email e senha preenchido entra no if para validar.
    if ((!empty($login)) && (!empty($senha))) {

		/*======================================================
        Função de limpeza de caracteres "invasores", como aspas,
			prevenindo SQL injection.
            
		DBEscape está na nossa bd-connection.php.
		======================================================*/
		$login = DBEscape($login);
		$senha = DBEscape($senha);

		/*--->>> Pela necessidade de se retornar o email digitado. <<<---*/
		$_SESSION['usuarioEmail'] = $login;

		/*---------------------------------------------------------------------------------------
			Está aqui só para exemplo. Original no Curso PHP Básico.../24.cryptsenha.php.
		-----------------------------------------------------------------------------------------
        $senhacrypt1  = crypt($senha, "_S4..hak1"); // CRYPT_EXT_DES.
        @$senhacrypt1 = crypt($senha, "$5$rounds=5000$anexamplestringforsalt$"); // CRYPT_SHA256.
        @$senhacrypt1 = crypt($senha, "$6$rounds=5000$anexamplestringforsalt$"); // CRYPT_SHA512.

        Preferência de uso será esta abaixo = Password_Hash.
        $senhacrypt = password_hash($senha, PASSWORD_DEFAULT);

        if (password_verify($senha, $senhacrypt)) {
            echo 'Senha válida ! 2... <br><br>';
        }
        else {
            echo 'Senha inválida ! 2... <br><br>';
        }
		
        $senhacrypt = password_hash($senha, PASSWORD_DEFAULT);
		print $senhacrypt;
        ---------------------------------------------------------------------------------------*/
		
        // Buscar na tabela usuario o $login e $senha.
		$dados = DBRead("usuario", "*", "WHERE Email = '$login'");

        // Encontrado um usuário na tabela usuario.
		if($dados){
			$senha_tabela = $dados[0]['Senha'];
		
			// Verificar a $senha com a senha do usuário.
            if (password_verify($senha, $senha_tabela)) {
                $_SESSION['mensagem']           = "";

				$_SESSION['usuarioId']          = $dados[0]['Id'];
				$_SESSION['usuarioEmail']       = $dados[0]['Email'];
                $_SESSION['usuarioSenha']		= $dados[0]['Senha'];
				$_SESSION['usuarioNome']        = $dados[0]['Nome'];
				$_SESSION['usuarioAtivo']       = $dados[0]['Ativo'];
				$_SESSION['usuarioNivelAcesso'] = $dados[0]['NivelAcesso'];
				$_SESSION['usuarioTipoUsuario'] = $dados[0]['TipoUsuario'];
				$_SESSION['usuarioTipoPessoa'] 	= $dados[0]['TipoPessoa'];
				$_SESSION['usuarioCPFCNPJ'] 	= $dados[0]['CPF_CNPJ'];
				$_SESSION['usuarioAtividade'] 	= $dados[0]['Atividade'];
				$_SESSION['usuarioEndereco'] 	= $dados[0]['Endereco'];
				$_SESSION['usuarioTelefone'] 	= $dados[0]['Telefone'];
				$_SESSION['usuarioBloco'] 		= $dados[0]['Bloco'];
				$_SESSION['usuarioUnidade'] 	= $dados[0]['Unidade'];
				$_SESSION['usuarioAniversario']	= $dados[0]['Data_Aniversario'];
				$_SESSION['usuarioCadastro'] 	= $dados[0]['Data_Cadastro'];
				$_SESSION['usuarioUltAcesso'] 	= $dados[0]['Data_Ult_Acesso'];

				$_SESSION["aPartirDoRegistro"]  = 0;
				$_SESSION["totalRegistros"]     = 0;
				
				$_SESSION["senhaErrada"] = "";
				$_SESSION["novoUsuario"] = "";

				// Verificar se o usuário ainda está ativo = "S".
				if ($_SESSION['usuarioAtivo'] != "S") {

					// Se o Nome = "a" é para incluir usuário.
					if ($_SESSION['usuarioNome'] == "a") {
						header("Location:login-incluir-usuario.php");
					} else {
						$_SESSION['mensagem'] = "Usuário não está ativo !!!";

						header("Location:login-sair.php");
					}
				} else {
					// Gravar a data atual como último acesso.				
					$dados = array(
						"Data_Ult_Acesso" => date("Y-m-d")
						);
					DBUpdate("usuario", $dados, "WHERE Email = '$login'");

					$_SESSION['usuarioUltAcesso'] = date("Y-m-d");					
					$_SESSION['usuarioLeuAviso']  = false;

					/*----------------------------------------------------------------
						Criar cookie Moema.
						-------------------

					Estipular o tempo do Cookie Moema.

					A "/" indica que estará disponível para o website inteiro.   
					A função setcookie() deve aparecer ANTES da tag <html>.	   
					----------------------------------------------------------------*/
					$cookie_name  = "Moema";
					$cookie_value = "Time";
					$cookie_tempo = 3600 * 24;  // 3600 = 1 hora (60 min x 60 s), * 24 horas.

					setcookie($cookie_name, 
						$cookie_value, 
						time() + $cookie_tempo,
						"/");
					/*---------------------------------------------------------*/

					// Se é usuário novo.
					if (empty($_SESSION['usuarioCPFCNPJ'])) {
						header("Location:login-alterar-usuario.php");
					} else {
						header("Location:login-home.php");
					}
				}
			}
			else {
                // Váriavel global recebendo a mensagem de erro
                $_SESSION['mensagem']    = "Senha não confere !!!";
				$_SESSION["senhaErrada"] = $login;
				$_SESSION["novoUsuario"] = "";

				header("Location:login-sair.php");
			}
        }
		else {
            //Váriavel global recebendo a mensagem de erro
            $_SESSION['mensagem']    = "Usuário não existe !!!";
			$_SESSION["senhaErrada"] = "";
			$_SESSION["novoUsuario"] = $login;

			header("Location:login-sair.php");
        }
    }
	else {
		// O login e senha inválidos. Retorna para a página de login.
        $_SESSION['mensagem']    = "Login ou senha inválidos !!!";
		$_SESSION["senhaErrada"] = "";
		$_SESSION["novoUsuario"] = "";

        header("Location:login-sair.php");
    }
?>
