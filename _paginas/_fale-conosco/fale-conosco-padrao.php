<?php
    /*--------------------------------------------------
	session_start();
	
	// Não acessar se usuário não está logado.
	if (($_SESSION["usuarioId"] == NULL) ||
		(empty($_SESSION["usuarioId"]))  ||
		($_SESSION["usuarioId"] < 1)) {
		 $_SESSION['mensagem'] = "Usuário saiu !!!";
		 header("Location: ../_login/login-sair.php");
	}
    
	//Incluir a conexão com banco de dados.
    require_once "../_bd/bd-config.php";
    require_once "../_bd/bd-connection.php";
    require_once "../_bd/bd-crud.php";

    // Buscar na tabela usuario o Id.
    $dados = DBRead("usuario", "*", "WHERE Id = {$_SESSION['usuarioId']}");

    // Encontrado um usuário na tabela usuario.
    if($dados) {
        $Nome      = $dados[0]['Nome'];
        $Email     = $dados[0]['Email'];
        $Telefone = $dados[0]['Telefone'];
    }
    else {
        $Nome      = "";
        $Email     = "";
        $Telefone = "";
    }
	---------------------------------------------------*/

    if (isset($_REQUEST["envio"])) {
        $enviado = "Email enviado com sucesso !!!";
    }
    else {
        $enviado = "";
    }
?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

    <title>BCP Tech - Fale conosco</title>

    <!-- As linhas abaixo foram transferidas para o arq. estilo.css.
        Ficaram exemplificadas aqui só para um teste.

    <style>
        body {
            background-color: yellowgreen;
            color: blue;
        }

        p {
            text-align: justify;
            text-indent: 50px;
        }
    </style>
    -------------------------------------------------------------->

    <link rel="stylesheet" type="text/css" href="../_css/estilo.css"/>
    <link rel="stylesheet" type="text/css" href="../_css/fale-conosco.css"/>

    <script language="JavaScript" src = "../_funcoes/_javascript/funcoes.js">
    /* <script>
    	Função originalmente escrita aqui mesmo. Mas por questão de
        aprendizagem, foi colocado num arquivo de funções e chamado
        para cá.
    ---------------------------------------------------------------
    function mudarFoto(foto) {
        >> o parâmetro passado no comando abaixo refere-se ao id =
            "icone-menu" da imagem <img ...> algumas linhas
            abaixo. Conferir...

        document.getElementById("icone-menu").src = foto;
    }
    -------------------------------------------------------------*/
    </script>

    <script>
        function calc_total() {
            /* Como não terá o cálculo de total do pedido,
                anular estas linhas abaixo.
            ----------------------------------------------
            var qtd = parseInt(document.getElementById('idQtde').value);
            tot = qtd * 1500 * 3.5;
            document.getElementById('idTotal').value = tot;
            ---------------------------------------------*/

            var urg = parseInt(document.getElementById('idUrg').value);
            document.getElementById('idOutUrg').value = urg;
        }
    </script>

    <?php
    ?>
</head>

<body>
<div id="interface">
    <header id="cabecalho">

		<img id="logotipo" src="../__cliente/_imagens/bcp-logotipo.png">

		<h1>BCP Tecnologia</h1>
		<h2>Software House Web, Relatórios SAP Intelligence</h2>
		<h2>Especialista em CRM</h2>

        <h2 style="text-align: center; color: blue;">Fale conosco</h2>

        <img id="icone-menu" src="../__cliente/_imagens/contato.png">

        <nav id="menu-principal">
            <h1>Menu Principal</h1>

            <!-- Listas "ol" > "type" possíveis abaixo:
                1 = sequencial numérico; (padrão)
                a = sequencial minúsculo;
                A = sequencial maiúsculo;
                i = sequencial romano minúsculo;
                I = sequencial romano maiúsculo;

                "start" é sempre numérico !!!

            <ol type="I" start="950">
                <li>Home</li>
                <li>Especificações</li>
                <li>Fotos</li>
                <li>Multimídia</li>
                    <ul>
                        <li>Vídeos</li>
                        <li>Músicas</li>
                    </ul>
                <li>Fale conosco</li>
            </ol>
                ------------------------------->

            <!-- Listas "ul" > "type" possíveis abaixo:
                disc; (padrão)
                square = quadrado;
                circle = círculo oco;
                ------------------------------->

            <ul type="circle">
				<li onmouseover="mudarFoto('../__cliente/_imagens/home.png')"
                    onmouseout="mudarFoto('../__cliente/_imagens/contato.png')">
                    <a href="../index.php">Home</a></li>
                <!--- <li onmouseover="mudarFoto('../__cliente/_imagens/senha.png')"
                    onmouseout="mudarFoto('../__cliente/_imagens/contato.png')">
                    <a href="alterar-login.php">Sua senha</a></li> --->               
				<li onmouseover="mudarFoto('../__cliente/_imagens/especificacoes.png')"
                    onmouseout="mudarFoto('../__cliente/_imagens/contato.png')">
                    <a href="specs.html">Especificações</a></li>
				<li onmouseover="mudarFoto('../__cliente/_imagens/contato.png')"
                    onmouseout="mudarFoto('../__cliente/_imagens/contato.png')">
                    <a href="captcha-digitar.php?tipo=1">Fale conosco</a></li>
				<li class="sair" onmouseover="mudarFoto('../__cliente/_imagens/sair.png')"
                    onmouseout="mudarFoto('../__cliente/_imagens/contato.png')">
                    <a class="sair" href="login-sair.php">Sair</a></li>
            </ul>
        </nav>
    </header>

    <section id="corpo-full">
        <article id="noticia-principal">
            <header id="cabecalho-artigo">
                <!-- <h3>Fale Conosco <?php echo $enviado; ?></h3> -->
                <!-- <h1>Formulário de Contato</h1>
                <h3 class="direita">Atualizado em 14/junho/2018</h3> -->
            </header>

            <!-- <form method="post" id="formContato" action="mailto:sist.esthaki@gmail.com" -->
            <form id="formContato" class="w3-responsive" action="../_email/fale-conosco-Email.php"
				method="post" oninput="calc_total();">

				<?php if ($enviado != "") { ?>
					<p class="email-enviado"><?php echo $enviado ?></p>
				<?php } else { ?>
					<?php echo $enviado ?>
				<?php } ?>

                <fieldset id="mensagem"><legend>Formulário de contato</legend>
                    <p><label for="idNome">Nome:<sup class="asteristico">*</sup> </label>
                        <input type="text" name="txtNome" id="idNome"
                            size="40" maxlength="50" minlength="3"
                            placeholder="Nome completo" autofocus required></p>
                    <p><label for="idEmail">E-mail:<sup class="asteristico">*</sup> </label>
                        <input type="email" name="txtEmail" id="idEmail"
                            size="32" maxlength="100" minlength="8"
                            placeholder="Entre com um e-mail válido" required></p>
                    <p><label for="idTelefone">Celular:<sup class="asteristico">*</sup> </label>
                        <input type="tel" name="txtTelefone" id="idTelefone"
                            size="20" maxlength="20" minlength="9"
                            placeholder="(00) 12345-6789" required></p>
                    <p><label for="idUrg"></label>
                    Grau de Urgência: <output for="txtUrg" name="OutUrg" id="idOutUrg">1</output></p>
                    <p>Mín <input type="range" name="txtUrg" id="idUrg"
                           min="0" max="10" step="1" value="1"> Máx </p>
                    <p>Mensagem:<sup class="asteristico">*</sup> </p>
                    <p><textarea name="txtMsg" rows="5" cols="30"
                           maxlength="1000" required
                           placeholder="Mensagem (até 1000 caracteres)"></textarea></p>
                </fieldset>

                <!-- Escolher qual dos dois botões abaixo para enviar o form.
                <input type="submit" name="btnEnviar" value="Enviar">  -->

                <input class="enviar" type="image" name="btnEnviar" src="../__cliente/_imagens/botao-enviar.png">
            </form>
        </article>
    </section>

	<!-------------------------------------------------
    <footer id="rodape">
        <p>Copyright &copy; 2018 - by HAK<br/>
            <a href="http://facebook.com/sist.esthaki" target="_blank">Facebook</a> |
            <a href="http://twitter.com/sist.esthaki"  target="_blank">Twitter</a>
        </p>
    </footer>
	------------------------------------------------>
	
</div>
</body>

</html>


<script>
    /*
	var inputUrg  = document.querySelector('[name=txtUrg]')
    var outputUrg = document.querySelector('[name=valorUrg]')

    function mostraTamanho(){
        outputUrg.value = inputUrg.value

    inputUrg.oninput = mostraTamanho

       quando uma função só é usada uma única vez, pode-se fazer assim:
       função anônima !!! sem nome...
       inputTamanho.oninput = function(){
         	outputTamanho.value = inputTamanho.value}
    */
</script>
