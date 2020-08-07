<!DOCTYPE html>

<html lang="pt-br">

<head>
    <?php
    /* Não será usado neste exemplo.
    // name no Html = Num.
    $num = isset($_GET["Num"]) ? $_GET["Num"] : 0;
    // name no Html = Operacao.
    $oper = isset($_GET["Operacao"]) ? $_GET["Operacao"] : "Nenhuma";

    $data = isset($_GET["Data"]) ? $_GET["Data"] : "22/05/2018";
    $dataformatada = date_format(date_create($data), "d/m/Y");
    */
    ?>

    <meta charset="UTF-8">
    <title>PHP com MySQLi</title>

    <link rel="stylesheet" href="_css/estilo.css">

    <style>
        h2 {
            color: green;
            text-shadow: 1px 1px 1px black;
        }

        .formatado {
            color: green;
            font-size: 20pt;
            text-shadow: 1px 1px 1px black;
        }
    </style>
</head>

<body>
    <pre>
    <?php
        /* como devem ser passados os valores por parãmetros
        ../operadores.php?a=3&b=5
        $v1 = $_GET["x"];
        $v2 = $_GET["y"];
        $nome = "teste de nome";
        echo "<h2>Olá, </br>Mundo !!!</h2>";
        echo number_format($v1 *= (1 + ($v2 / 100)), 2, ',', '.');
        echo $nome;
        */

        require_once "bd-config.php";
        require_once "bd-connection.php";
        require_once "bd-crud.php";

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

        $nome  = "Zequinha 'Santos'"; // Proposital com 'Santos'.
        $dados = array(
            "nome"  => "Fulano",
            // "idade" => 30,
            "email" => "fulano@teste.com.br"
        );

//=============================================================
        /* Função de limpeza de caracteres "invasores".
            DBEscape está na nossa connectionDB.php. */
        $nome  = DBEscape($nome);
        $dados = DBEscape($dados);

//=============================================================
        /* Se no DBCreate abaixo o último parâmetro
            estiver true, retornará o valor do id
            criado. Senão, só dirá se foi criado com
            sucesso ou não.
        -------------------------------------------*/
        // $gravar = DBCreate("cliente", $dados, true);

        if ($gravar)
            echo "Inclusão efetuada com sucesso !!! <br/>";
        else
            echo "Inclusão não efetuada !!! <br/>";

//=============================================================
        // $clientes = DBRead("cliente");
        // $clientes = DBRead("cliente", "nome, email");
        // $clientes = DBRead("cliente", "*", "WHERE id = 2");
        // $clientes = DBRead("cliente", "*", null, "ORDER BY nome DESC");
        // $clientes = DBRead("cliente", "*", "LIKE 'a%'", "ORDER BY email", "LIMIT 10");

        /*-------------------------------------------------------
        WHERE    - Condições de seleção.
        LIKE     - Pesquisar.
            LIKE "%a"   : palavras terminadas com "a".
            LIKE "a%"   : palavras começadas com "a".
            LIKE "%a"   : palavras começadas e terminadas com "a".
		ORDER BY - Ordem dos registros.
        LIMIT    - Limita os resultados.
        --------------------------------------------------------*/

        $clientes = DBRead("cliente", "*", "WHERE id = 2");

        //foreach ($clientes as $cli) {
        //    echo "<hr>".$cli["nome"]."<br/>";
        //}

        var_dump($clientes[0]); // Primeiro e único registro.

//=============================================================
        $clientes[0]["nome"]  = "Valeria";
        $clientes[0]["email"] = "valeria@teste.com.br";

        // $gravar = DBUpdate("cliente", $clientes[0], "id = 2 OR status = 'P'");
        $gravar = DBUpdate("cliente", $clientes[0], "id = 2");

        if ($gravar)
            echo "Atualização efetuada com sucesso !!! <br/>";
        else
            echo "Atualização não efetuada !!! <br/>";

//=============================================================
        $gravar = DBDelete("cliente", "id = 25");

        if ($gravar)
            echo "Exclusão efetuada com sucesso !!! <br/>";
        else
            echo "Exclusão não efetuada !!! <br/>";
    ?>
    </pre>
</body>

</html>
