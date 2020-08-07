<?php

include "PHPMailer/PHPMailerAutoload.php"; 

// Inicia a classe PHPMailer 
$mail = new PHPMailer(); 

date_default_timezone_set("America/Sao_Paulo");

$time = date("d/m/Y H:i:s");

require_once "../../_configuracoes/config-Email.php";	

$mail->Host       = EMAIL_HOST;		// sets the SMTP server
$mail->Port       = EMAIL_PORT;		// set the SMTP port for the GMAIL server
$mail->Username   = EMAIL_USERNAME; // SMTP account username
$mail->Password   = EMAIL_PASSWORD; // SMTP account password

$mail->SetFrom(EMAIL_SETFROM, EMAIL_FROMNAME);

$mail->AddReplyTo(EMAIL_REPLYTO, "Reply-to");

$mail->AddAddress($emailDestino);

$emailDestino = "";

if (!empty($emailEspecifico)) {
	$mail->AddCC($emailEspecifico);
}

// Sindico será copiado ??? Em cópia oculta !!!
if ($copiarSindico) {
	$mail->AddBCC(EMAIL_SINDICO);
	if ((EMAIL2_SINDICO != null) && (!empty(EMAIL2_SINDICO))) {
		$mail->AddBCC(EMAIL2_SINDICO);
	}			
}

$mail->Subject = $assunto;

$mail->IsHTML(true);

$body  = "Mensagem de Contato<br><br>";
$body .= "<b>Nome:</b>      Principal<br>";
$body .= "<b>Email:</b>     principal@kkk.com<br>";
$body .= "<b>Telefone:</b>  (12) 3456-7890<br>";
$body .= "<b>Urgência:</b>  4<br>";
$body .= "<b>Mensagem:</b>  Aqui entra o conteudo texto do email da mensagem em <b>PHPMailer</b>. Em " . $time . " <br>";

$mail->MsgHTML($corpo);

// Plain text body (for mail clients that cannot read HTML)
$text_body  = 'Hello Hugo txt ' . ", \n\n";
$text_body .= "Your personal photograph to this message.\n\n";
$text_body .= "Sincerely, \n";
$text_body .= 'phpmailer List manager';

$mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

if (!empty($temAnexo)) {
	//$mail->AddAttachment($arqsAnexar['tmp_name'], $arqsAnexar['name']);

    for ($ct = 0; $ct < count($_FILES['txtArqsFotos']['tmp_name']); $ct++) {
        $uploadfile = tempnam(sys_get_temp_dir(), hash('sha256', $_FILES['txtArqsFotos']['name'][$ct]));
        $filename = $_FILES['txtArqsFotos']['name'][$ct];
        if (move_uploaded_file($_FILES['txtArqsFotos']['tmp_name'][$ct], $uploadfile)) {
            $mail->addAttachment($uploadfile, $filename);
        } else {
            $msg .= 'Falha ao mover arq. para ' . $uploadfile;
        }
    }

	$temAnexo = "";
}

/************************************************************************
   Fim das parametrizações necessárias.
************************************************************************/

// Charset (opcional) 
$mail->CharSet = 'UTF-8';

$mail->IsSMTP(); // telling the class to use SMTP

// Usar autenticação SMTP (obrigatório) 
$mail->SMTPAuth = true;

$mail->SMTPDebug  = 0;  // enables SMTP debug information (for testing)
                        // 1 = errors and messages
                        // 2 = messages only

$mail->SMTPAuth   = true;  // enable SMTP authentication

// $mail->SMTPSecure = "ssl";

// Configurações de compatibilidade para autenticação em TLS 
$mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ) );

// Exibe uma mensagem de resultado.
if ($mail->send()) {
    $enviou = true;
} else {
    $enviou = false;
}

$mail->ClearAllRecipients();
$mail->ClearAttachments();
?>
