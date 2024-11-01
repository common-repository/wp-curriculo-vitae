<?php
// Devido � quantidade de dados que esta fun��o poderia gerar,
// vamos apenas atualizar a base de dados de 10 em 10 minutos.
// Desta forma, se um usu�rio permanecer no site por 30 minutos,
// ser� registado tr�s vezes na tabela.
global $wpdb;

foreach ($_POST as $key => $value) {
	${$key} = $value;
}

/*
$assunto_cadastro 		      = @$_POST['assunto_cadastro'];
$mensagem_cadastro 		      = @$_POST['mensagem_cadastro'];

$assunto_cadastro_admin			= @$_POST['assunto_cadastro_admin'];
$mensagem_cadastro_admin 		= @$_POST['mensagem_cadastro_admin'];

$assunto_aprovacao 		 = @$_POST['assunto_aprovacao'];
$mensagem_aprovacao 	 = @$_POST['mensagem_aprovacao'];

$assunto_esqueceu 		 = @$_POST['assunto_esqueceu'];
$mensagem_esqueceu 		 = @$_POST['mensagem_esqueceu'];

$tipo_envio				     = @$_POST['tipo_envio'];
$nome					         = @$_POST['nome'];
$email					       = @$_POST['email'];
$usuario 				       = @$_POST['usuario'];
$senha 					       = @$_POST['senha'];
$smtp_autententicacao  = @$_POST['smtp_autententicacao'];
$seguranca 				     = @$_POST['seguranca'];
$porta_saida 			     = @$_POST['porta_saida'];
$host 					       = @$_POST['host'];

$css                   = @$_POST['css']; */

#exit;
// Checamos se n�o existe nenhum registo procedemos

// Registar os IPs na base de dados
$var = array(

	'assunto_cadastro' => $assunto_cadastro,
	'mensagem_cadastro' => $mensagem_cadastro,
	'assunto_cadastro_admin' => $assunto_cadastro_admin,
	'mensagem_cadastro_admin' => $mensagem_cadastro_admin,
	'assunto_aprovacao' => $assunto_aprovacao,
	'mensagem_aprovacao' => $mensagem_aprovacao,
	'assunto_esqueceu' => $assunto_esqueceu,
	'mensagem_esqueceu' => $mensagem_esqueceu,
	'nome' => $nome,
	'tipo_envio' => $tipo_envio,
	'email' => $email,
	'css' => $css,
	'senha' => $senha,
	'usuario' => $usuario,
	'smtp_autententicacao' => $smtp_autententicacao,
	'seguranca' => $seguranca,
	'porta_saida' => $porta_saida,
	'host' => $host,
	'campos' => json_encode($campos),
	'abas' => json_encode($abas),
	'light_box' => $light_box,
	'new_area_ex' => $new_area_ex,

);

$proto = strtolower(preg_replace('/[^a-zA-Z]/', '', $_SERVER['SERVER_PROTOCOL'])); //pegando s� o que for letra

if ($_GET['id_formulario']) {

	$location = $proto . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "&";

} else {

	$location = $proto . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "?";

}

$id = 1;

$qry = $wpdb->update(BD_CONFIGURACOES, $var, array('id' => $id), $format = null, $where_format = null);

/*$msg = 1;

if($qry == false) {

$wpdb->show_errors();

$wpdb->print_error();

exit;

} else { */

@header("Location:?page=configuracao-premium&msg=" . $msg . "");

//}

?>
