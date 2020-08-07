<?php
    // Abrir conexão com o MySQLi.
    function DBConnect(){
        $link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD,
            DB_DATABASE) or die(mysqli_connect_error());
        mysqli_set_charset($link, DB_CHARSET) or die(mysqli_error($link));
        return $link;
    }

    /* Abrir conexão com o MySQLi.
		Especificamente esta função só servirá na base de dados a ser definida
		pelo campo {BaseDados, str(4), Ex.: "0001"}, da tabela cliente, que está na
		base de dados BCP. Assim que o cliente fizer logon, estiver Ativo = "S",
		AtivoAteData >= data atual, lerá este campo BaseDados, para saber em qual
		BD auxiliar estará o seu cadastro de produtos.
		
		Supondo que no cadastro da hospedagem a BCP receba o código "u907543_" para
		email´s e bancos de dados.
		
		Ex.: O cliente "Supermercado G" tem seu campo BaseDados = "0038". Isto quer
		dizer que sua tabela "produto" estará na base de dados "u907543_" + "0038",
		formando a string "u907543_0038" em $baseDados abaixo.
	*/
    function DBConnectBaseDados($baseDados){
        $link = mysqli_connect(DB_HOSTNAME, DB_USERNAME, DB_PASSWORD,
            $baseDados) or die(mysqli_connect_error());
        mysqli_set_charset($link, DB_CHARSET) or die(mysqli_error($link));
        return $link;
    }

    // Fechar conexão com o MySQLi.
    function DBClose($link) {
        mysqli_close($link) or die(mysqli_error($link));
    }

    // Proteger contra SQL Injection.
    function DBEscape($dados) {
        $link = DBConnect();

        // Verificar se $dados é uma array() ou string, booleano e numérico.
        if(!is_array($dados))
            $dados = mysqli_real_escape_string($link, $dados);
        else {
            $array = $dados;
            foreach ($array as $key => $value) {
                $key   = mysqli_real_escape_string($link, $key);
                $value = mysqli_real_escape_string($link, $value);
                $dados[$key] = $value;
            }
        }
        DBClose($link);
        return $dados;
    }

    // Proteger contra SQL Injection.
    function DBEscapeBaseDados($dados, $baseDados) {
        $link = DBConnectBaseDados($baseDados);

        // Verificar se $dados é uma array() ou string, booleano e numérico.
        if(!is_array($dados))
            $dados = mysqli_real_escape_string($link, $dados);
        else {
            $array = $dados;
            foreach ($array as $key => $value) {
                $key   = mysqli_real_escape_string($link, $key);
                $value = mysqli_real_escape_string($link, $value);
                $dados[$key] = $value;
            }
        }
        DBClose($link);
        return $dados;
    }
?>
