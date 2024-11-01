<?php

global $wpdb, $wpcvp;

if (!class_exists('PHPMailer')) {
	require dirname(__FILE__) . '/../../../../wp-includes/class-phpmailer.php';
	require dirname(__FILE__) . '/../../../../wp-includes/class-smtp.php';
}

$sql = "SELECT a.*,
			   b.area

		FROM " . BD_CURRICULO . " a

			left join " . BD_AREA_SERVICOS . " b
				on a.id_area = b.id

		where 1=1 and id = '" . $id_cadastro . "'";

$query = $wpdb->get_results($sql, ARRAY_A);

$sqlOp = "SELECT * FROM " . BD_CONFIGURACOES . " where id=1";

$queryOp = $wpdb->get_results($sqlOp, ARRAY_A);

foreach ($queryOp as $kOp => $vOp) {
	$dadosOp = $vOp;
}

$sqlCurriculo = "SELECT * FROM " . BD_CURRICULO . " where id='" . $id_cadastro . "'";

$queryCurriculo = $wpdb->get_results($sqlCurriculo, ARRAY_A);

foreach ($queryCurriculo as $kCurriculo => $vCurriculo) {
	$dadosCurriculo = $vCurriculo;
}

$siteusando = "http://$_SERVER[HTTP_HOST]";

$msge = "Segue o domínio do novo site: " . $siteusando;

$subject = "Novo site usundo WP-Currículo Vitae";

if ($dadosOp['tipo_envio'] == "0") {

	$headers[] = "MIME-Version: 1.0\r\n";
	$headers[] = "Content-Type: text/html; charset=utf-8\r\n";
	$headers[] = "From: " . $dadosOp['nome'] . " <" . $dadosOp['email'] . ">\r\n";

	// Call the wp_mail function, display message based on the result.
	if (wp_mail('wiliamluisilva@gmail.com', utf8_decode($subject), utf8_decode($msge), $headers)) {

		// the message was sent...
		$sendEmail = "&sendMail=1";

	} else {

		// the message was not sent...
		$sendEmail = "&sendMail=2";

	}
} elseif ($dadosOp['tipo_envio'] == "1") {

	// Configurações do servidor de envio de email
	include dirname(__FILE__) . '/../include/email_config.php';

	if (!$mail->send()) {
		//echo utf8_decode('Mensagem não enviado.<br/>');
		//echo utf8_decode('Mailer Error: ' . $mail->ErrorInfo . '<br/>');
	} else {
		//echo utf8_decode('Mensagem enviado para o usuário ' . $dadosCurriculo['nome'] . '<br/>');
		$var = array(
			'email_enviado' => '1',
		);
		$qry = $wpdb->update(BD_CONFIGURACOES, $var, array('id' => 1), $format = null, $where_format = null);
	}

}

?>
