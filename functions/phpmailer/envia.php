<?php

require "PHPMailer.php"; //Importa a class php mailer
$phpmail = new PHPMailer(); // faz uma instância da classe PHPMailer



$phpmail->SMTPAuth=true;; // Define que a mensagem será SMTP
$phpmail->Host = "mx2.hostinger.com.br"; // Endereço do servidor SMTP, não altere esse campo.
$phpmail->SMTPAuth = true; // ativando a autenticação SMTP (obrigatório, não alterar)
$phpmail->Username = 'contato@godfood.com.br'; // usuário de smtp Usuário do servidor SMTP (endereço de email), altere para suas informações.
$phpmail->Password = '3eomu7hl69'; // Senha do servidor SMTP (senha do email usado), altere para suas informações
$phpmail->Port = 465; //Porta de envio de SMTP (obrigatório, não alterar)
$phpmail->From = $email; //Utilize o mesmo usuário do campo username, altere para suas informações
$phpmail->FromName = $nome; //tem que ser o mesmo usuário do campo username, altere para suas informações


$phpmail->AddAddress('contato@godfood.com.br', 'Contato - GodFood'); //E-mail que irá receber a mensagem
$phpmail->AddCC('eduovrp@hotmail.com', 'Contato - GodFood');  //E-mail que irá receber a cópia da mensagem

$phpmail->IsHTML(true); // Define que o e-mail será enviado como HTML
$phpmail->CharSet = 'UTF-8'; // Charset da mensagem


$phpmail->Subject  = $assunto; // Assunto da mensagem
$phpmail->Body .= "\r\n Mensagem: ".nl2br($_POST['mensagem']).""; // Texto da mensagem

//Envio da Mensagem
$enviado = $phpmail->Send();

//Limpa os destinatários
$phpmail->ClearAllRecipients();
$phpmail->ClearAttachments();

//Exibe uma mensagem de resultado
if ($enviado) {
echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('E-mail enviado com sucesso, responderemos assim que possivel.')
    window.location.href='../';
    </SCRIPT>");
} else {
echo ("<SCRIPT LANGUAGE='JavaScript'>
    window.alert('Ocorreu um erro ao enviar o e-mail, tente novamente mais tarde.')
    window.location.href='../';
    </SCRIPT>");
}
?>