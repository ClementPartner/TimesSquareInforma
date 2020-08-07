<?php
	session_start(); // inicial a sessao.

	header("Content-type: image/jpeg"); // define o tipo do arquivo.

    $largura 			= $_GET["l"];  // recebe a largura.
    $altura 			= $_GET["a"];  // recebe a altura.
    $tamanho_fonte		= $_GET["tf"]; // recebe o tamanho da fonte.
    $quantidade_letras 	= $_GET["ql"]; // recebe a quantidade de letras que o captcha terá.

    function captcha($largura, $altura, $tamanho_fonte, $quantidade_letras){
        // define a largura e a altura da imagem.
		$imagem = imagecreate($largura, $altura);

		// voce deve ter essa ou outra fonte de sua preferencia em sua pasta.
        $fonte = "../../_fontes/arial.ttf"; 

		// define a cor preta.
		$preto  = imagecolorallocate($imagem,0,0,0); 

		// define a cor branca.
        $branco = imagecolorallocate($imagem,255,255,255); 

        // define a palavra conforme a quantidade de letras definidas no parametro $quantidade_letras.
        $palavra = substr(str_shuffle("AaBbCcDdEeFfGgHhiJjKkLMmNnPpQqRrSsTtUuVvYyXxWwZz23456789"),
			0, ($quantidade_letras)); 

		// atribui para a sessao a palavra gerada.
		$_SESSION["palavra"] = $palavra; 

		// atribui as letras a imagem.
        for($i = 1; $i <= $quantidade_letras; $i++){ 
            imagettftext($imagem, $tamanho_fonte, rand(-25,25), ($tamanho_fonte * $i),
			   ($tamanho_fonte + 10), $branco, $fonte, substr($palavra, ($i-1), 1)); 
        }

        imagejpeg($imagem); 	// gera a imagem.
        imagedestroy($imagem);	// limpa a imagem da memoria.
    }

	// Executa a function acima.
    captcha($largura, $altura, $tamanho_fonte, $quantidade_letras); // executa a funcao captcha passando os parametros recebidos.
?>
