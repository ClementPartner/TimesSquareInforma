<?php
    session_start();

    $pular = (isset($_REQUEST["v"])) ? $_REQUEST["v"] : 0;

    $aPartirDoRegistro = $_SESSION["aPartirDoRegistro"];
    $totalRegistros    = $_SESSION["totalRegistros"];

    if($pular < 0) {
        $aPartirDoRegistro += $pular;
        if ($aPartirDoRegistro < 0)
            $aPartirDoRegistro = 0;
        $_SESSION["aPartirDoRegistro"] = $aPartirDoRegistro;
    }
    else {
        if(($aPartirDoRegistro +  $pular)  < $totalRegistros) {
            $aPartirDoRegistro += $pular;
            $_SESSION["aPartirDoRegistro"] = $aPartirDoRegistro;
        }
    }

    /* --- header("Location: home.php"); --- */
?>
			
<script>
    window.setTimeout("history.back(-1)", 100); // 100 milisegundos.
</script>
