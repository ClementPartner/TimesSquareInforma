<?php
    // Executar Query´s.
    function DBExecute($query, $insertId = false) {
        $link   = DBConnect();
        $result = mysqli_query($link, $query) or die(mysqli_error($link));

        // Retornar o "id" criado.
        if ($insertId) // Parâmetro da função acima.
            $result = mysqli_insert_id($link);

        DBClose($link);
        return $result;
    }

    // Executar Query´s.
    function DBExecuteBaseDados($baseDados, $query, $insertId = false) {
        $link   = DBConnectBaseDados($baseDados);
        $result = mysqli_query($link, $query) or die(mysqli_error($link));

        // Retornar o "id" criado.
        if ($insertId) // Parâmetro da função acima.
            $result = mysqli_insert_id($link);

        DBClose($link);
        return $result;
    }

    // Gravar registro.
    function DBCreate($tabela, array $dados, $insertId = false) {
        $dados   = DBEscape($dados);

        $campos  = implode(", ", array_keys($dados)); // Nomes dos campos da tabela.
        $valores = "'".implode("', '", $dados)."'"; // Valores dos campos da tabela.

        $query = "INSERT INTO {$tabela} ({$campos}) VALUES ({$valores}) ";

        return DBExecute($query, $insertId);
    }

    // Gravar registro.
    function DBCreateBaseDados($baseDados, $tabela, array $dados, $insertId = false) {
        $dados   = DBEscapeBaseDados($dados, $baseDados);

        $campos  = implode(", ", array_keys($dados)); // Nomes dos campos da tabela.
        $valores = "'".implode("', '", $dados)."'"; // Valores dos campos da tabela.

        $query = "INSERT INTO {$tabela} ({$campos}) VALUES ({$valores}) ";

        return DBExecuteBaseDados($query, $baseDados, $insertId = false);
    }

    // Ler registros.
    function DBRead($tabela, $campos = "*", $where = null, $orderby = null, $limite = null) {
        $query  = "SELECT {$campos} FROM {$tabela} {$where} {$orderby} {$limite}";
		
        $result = DBExecute($query);
		
        if (mysqli_num_rows($result)) {
            while ($res = mysqli_fetch_assoc($result)) {
                $data[] = $res;
            }
            return $data;
        }
        else
            return false;
    }

    // Ler registros.
    function DBReadBaseDados($baseDados, $tabela, $campos = "*", $where = null, $orderby = null, $limite = null) {
        $query  = "SELECT {$campos} FROM {$tabela} {$where} {$orderby} {$limite}";

        $result = DBExecuteBaseDados($query, $baseDados);

        if (mysqli_num_rows($result)) {
            while ($res = mysqli_fetch_assoc($result)) {
                $data[] = $res;
            }
            return $data;
        }
        else
            return false;
    }

    // Alterar registros.
    function DBUpdate($tabela, array $dados, $where = null) {
        $dados = DBEscape($dados);
        $where = ($where) ? " {$where}" : null;

        foreach ($dados as $chave => $valor) {
            // Não posso alterar o campo "id" = a chave da tabela.
            if ($chave != "id")
                $campos[] = "{$chave} = '{$valor}'";
        }

        $campos = implode(", ", $campos);

        $query = "UPDATE {$tabela} SET {$campos} {$where}";
        return DBExecute($query);
    }

    // Alterar registros.
    function DBUpdateBaseDados($baseDados, $tabela, array $dados, $where = null) {
        $dados = DBEscapeBaseDados($dados, $baseDados);
        $where = ($where) ? " {$where}" : null;

        foreach ($dados as $chave => $valor) {
            // Não posso alterar o campo "id" = a chave da tabela.
            if ($chave != "id")
                $campos[] = "{$chave} = '{$valor}'";
        }

        $campos = implode(", ", $campos);

        $query = "UPDATE {$tabela} SET {$campos} {$where}";
        return DBExecuteBaseDados($baseDados, $query);
    }

    // Deletar registros.
    function DBDelete($tabela, $where = null) {
        $where = ($where) ? " {$where}" : null;

        $query = "DELETE FROM {$tabela} {$where}";
        return DBExecute($query);
    }

    // Deletar registros.
    function DBDeleteBaseDados($baseDados, $tabela, $where = null) {
        $where = ($where) ? " {$where}" : null;

        $query = "DELETE FROM {$tabela} {$where}";
        return DBExecuteBaseDados($baseDados, $query);
    }
?>

