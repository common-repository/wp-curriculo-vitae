<?php
$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output
//$mail->isSMTP();                                      // Set mailer to use SMTP

$mail->Host = $dadosOp['host']; // Specify main and backup SMTP servers
$mail->SMTPAuth = $dadosOp['smtp_autententicacao'] == "1" ? true : false; // Enable SMTP authentication
$mail->Username = $dadosOp['usuario']; // SMTP username
$mail->Password = $dadosOp['senha']; // SMTP password
$mail->SMTPSecure = $dadosOp['seguranca'] == "STARTTLS" ? "tls" : "ssl"; // Enable TLS encryption, `ssl` also accepted
$mail->Port = (int) $dadosOp['porta_saida']; // TCP port to connect to

$mail->setFrom($dadosOp['email'], $dadosOp['nome']);

$mail->addAddress($dadosCurriculo['email'], $dadosCurriculo['nome']); // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional

//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true); // Set email format to HTML

$mail->Subject = utf8_decode($subject);
$mail->Body = utf8_decode($msge);
//$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
?>
