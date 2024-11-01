<?php

// Acesso ao objeto global de gestão de bases de dados
global $wpdb, $wpcvp;

// Para usarmos a função dbDelta() é necessário carregar este ficheiro
require_once ABSPATH . 'wp-admin/includes/upgrade.php';

// Vamos checar se a nova tabela existe
// A propriedade prefix é o prefixo de tabela escolhido na
// instalação do WordPress

// Se a tabela não existe vamos criá-la
if ($wpdb->get_var("SHOW TABLES LIKE '" . BD_CURRICULO . "'") != BD_CURRICULO) {

	$sql = "

		CREATE TABLE " . BD_CURRICULO . "(
			  id 			int(11) 		NOT NULL AUTO_INCREMENT,
			  id_area 		int(11) 		DEFAULT NULL,
			  nome 			varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			  cpf 			varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			  telefone 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			  celular 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			  email 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			  site_blog 	varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			  skype 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			  estado_civil 	varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			  idade 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			  sexo 			int(11) 		DEFAULT NULL,
			  remuneracao 	varchar(255) 	COLLATE latin1_bin DEFAULT NULL,

			  login 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			  senha 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,

			  rua 			varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			  numero 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			  bairro 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			  cidade 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			  estado 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			  cep 			varchar(255) 	COLLATE latin1_bin DEFAULT NULL,

			  curriculo 	varchar(255) 	COLLATE latin1_bin DEFAULT NULL,

			  descricao 	text 			COLLATE latin1_bin,


			  status 		int(11) 		NOT NULL DEFAULT '0',
			  foto 			varchar(255) COLLATE latin1_bin DEFAULT NULL,
			  PRIMARY KEY (id)
		)";

	// Esta função cria a tabela na base de dados e executa as otimizações necessárias.
	dbDelta($sql);
}

if (!is_array($wpdb->get_row("SELECT a.login, a.senha FROM " . BD_CURRICULO . " a where 1=1 ", ARRAY_A))) {
	$wpdb->get_row("ALTER TABLE " . BD_CURRICULO . " ADD login varchar(255) COLLATE latin1_bin DEFAULT NULL AFTER remuneracao", ARRAY_A);
	$wpdb->get_row("ALTER TABLE " . BD_CURRICULO . " ADD senha varchar(255) COLLATE latin1_bin DEFAULT NULL AFTER login", ARRAY_A);
}

if (!is_array($wpdb->get_row("SELECT a.criadoData FROM " . BD_CURRICULO . " a where 1=1 ", ARRAY_A))) {
	$wpdb->get_row("ALTER TABLE " . BD_CURRICULO . " ADD criadoData timestamp NULL DEFAULT CURRENT_TIMESTAMP AFTER descricao", ARRAY_A);
}

if (!is_array($wpdb->get_row("SELECT a.foto FROM " . BD_CURRICULO . " a where 1=1 ", ARRAY_A))) {
	$wpdb->get_row("ALTER TABLE " . BD_CURRICULO . " ADD foto varchar(255) COLLATE latin1_bin DEFAULT NULL AFTER status", ARRAY_A);
}

if (!is_array($wpdb->get_row("SELECT a.alteradoData FROM " . BD_CURRICULO . " a where 1=1 ", ARRAY_A))) {
	$wpdb->get_row("ALTER TABLE " . BD_CURRICULO . " ADD alteradoData timestamp NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP AFTER criadoData", ARRAY_A);
}

if ($wpdb->get_var("SHOW TABLES LIKE '" . BD_AREA_SERVICOS . "'") != BD_AREA_SERVICOS) {

	$sql1 = "

		CREATE TABLE " . BD_AREA_SERVICOS . "(
			id	 	int(11) 		NOT NULL AUTO_INCREMENT,
			area 	varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			status 	int(11) 		NOT NULL DEFAULT '0',
			PRIMARY KEY (id)
		)";

	// Esta função cria a tabela na base de dados e executa as otimizações necessárias.
	dbDelta($sql1);

}

if (!is_array($wpdb->get_row("SELECT a.status FROM " . BD_AREA_SERVICOS . " a where 1=1 ", ARRAY_A))) {
	$wpdb->get_row("ALTER TABLE " . BD_AREA_SERVICOS . " ADD status int(11) NOT NULL DEFAULT '0' ON UPDATE CURRENT_TIMESTAMP AFTER area", ARRAY_A);
}

$sqlArea2 = "SELECT * FROM " . BD_AREA_SERVICOS . " where 1=1";

$queryArea2 = $wpdb->get_results($sqlArea2, ARRAY_A);

foreach ($queryArea2 as $kA2 => $vA2) {
	$dadosArea2 = $vA2;
}

if (count($queryArea2) == 0) {

	$areas = array("Administração", "Finanças/Contabilidade", "Mercado Financeiro/Seguros", "Engenharia", "Tecnologia da Informação", "Jurídica", "Logística/Suprimentos", "Marketing", "Recursos Humanos", "Vendas");

	for ($iA = 0; $iA < count($areas); $iA++) {

		$sqlArea = "SELECT * FROM " . BD_AREA_SERVICOS . " where area='" . $areas[$iA] . "'";

		$queryArea = $wpdb->get_results($sqlArea, ARRAY_A);

		if (count($queryArea) == 0) {

			$varArea = array(
				'area' => $areas[$iA],
			);

			if ($varArea['area'] != "") {
				$wpdb->insert(BD_AREA_SERVICOS, $varArea);
			}

		}

	}

}

if ($wpdb->get_var("SHOW TABLES LIKE '" . BD_CONFIGURACOES . "'") != BD_CONFIGURACOES) {

	$sql2 = "

		CREATE TABLE " . BD_CONFIGURACOES . "(
			id 						int(11) 		NOT NULL AUTO_INCREMENT,
			assunto_cadastro 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			mensagem_cadastro 		text 			COLLATE latin1_bin,
			assunto_cadastro_admin 	varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			mensagem_cadastro_admin text 			COLLATE latin1_bin,
			assunto_aprovacao 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			mensagem_aprovacao 		text 			COLLATE latin1_bin,
			assunto_esqueceu 		varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			mensagem_esqueceu 		text 			COLLATE latin1_bin,

			emails_recebimento 		text 			COLLATE latin1_bin,
			tipo_envio 				int(11) 		DEFAULT '0',
			email 					varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			nome 					varchar(255) 	COLLATE latin1_bin DEFAULT NULL,

			usuario 				varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			senha 					varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			smtp_autententicacao 	int(11) 		DEFAULT '0',
			seguranca 				varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			porta_saida 			varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			host 					varchar(255) 	COLLATE latin1_bin DEFAULT NULL,

			css 					varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			campos 					varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			abas 					varchar(255) 	COLLATE latin1_bin DEFAULT NULL,
			light_box 				int(11) 		DEFAULT '0',
			new_area_ex				int(11) 		DEFAULT '0',
			email_enviado			int(11) 		DEFAULT '0',
			PRIMARY KEY (id)
		)";

	// Esta função cria a tabela na base de dados e executa as otimizações necessárias.

	dbDelta($sql2);
}

if (!is_array($wpdb->get_row("SELECT a.campos FROM " . BD_CONFIGURACOES . " a where 1=1 ", ARRAY_A))) {
	$wpdb->get_row("ALTER TABLE " . BD_CONFIGURACOES . " ADD campos varchar(255) COLLATE latin1_bin DEFAULT NULL AFTER css", ARRAY_A);
}

if (!is_array($wpdb->get_row("SELECT a.abas FROM " . BD_CONFIGURACOES . " a where 1=1 ", ARRAY_A))) {
	$wpdb->get_row("ALTER TABLE " . BD_CONFIGURACOES . " ADD abas varchar(255) COLLATE latin1_bin DEFAULT NULL AFTER campos", ARRAY_A);
}

if (!is_array($wpdb->get_row("SELECT a.css FROM " . BD_CONFIGURACOES . " a where 1=1 ", ARRAY_A))) {
	$wpdb->get_row("ALTER TABLE " . BD_CONFIGURACOES . " ADD css text DEFAULT NULL AFTER host", ARRAY_A);
}

if (!is_array($wpdb->get_row("SELECT a.light_box FROM " . BD_CONFIGURACOES . " a where 1=1 ", ARRAY_A))) {
	$wpdb->get_row("ALTER TABLE " . BD_CONFIGURACOES . " ADD light_box int(11) DEFAULT '0' AFTER abas", ARRAY_A);
}

if (!is_array($wpdb->get_row("SELECT a.new_area_ex FROM " . BD_CONFIGURACOES . " a where 1=1 ", ARRAY_A))) {
	$wpdb->get_row("ALTER TABLE " . BD_CONFIGURACOES . " ADD new_area_ex int(11) DEFAULT '0' AFTER light_box", ARRAY_A);
}

if (!is_array($wpdb->get_row("SELECT a.email_enviado FROM " . BD_CONFIGURACOES . " a where 1=1 ", ARRAY_A))) {
	$wpdb->get_row("ALTER TABLE " . BD_CONFIGURACOES . " ADD email_enviado int(11) DEFAULT '0' AFTER new_area_ex", ARRAY_A);
}

$sqlOp = "SELECT * FROM " . BD_CONFIGURACOES . " where id=1";

$queryOp = $wpdb->get_results($sqlOp, ARRAY_A);

foreach ($queryOp as $kOp => $vOp) {
	$dadosOp = $vOp;
}

if ($dadosOp['id'] == "") {

	$assunto_cadastro = "Seu currículo foi cadastrado com sucesso!";
	$mensagem_cadastro = "Seu Currículo foi cadastrado com sucesso,<br/>\n e assim que com pagamento for aprovado você receberá os dados de login de acesso.";

	/*$assunto_cadastro_admin = "Novo currículo cadastrado";
		$mensagem_cadastro_admin = "Nome: @nome <br/>
		Área de serviço: @area";

		$assunto_aprovado = "Seu currículo foi aprovado!";
		$mensagem_aprovado = "Seu currículo foi aprovado";

		$assunto_esqueceu = "Nova senha foi gerada";
		$mensagem_esqueceu = "Olá @nome, tudo bem?\n<br/>

	*/

	$varOptions = array(
		'assunto_cadastro' => $assunto_cadastro,
		'mensagem_cadastro' => $mensagem_cadastro,
		/*'assunto_cadastro_admin' => $assunto_cadastro_admin,
			'mensagem_cadastro_admin' => $mensagem_cadastro_admin,
			'assunto_aprovacao' => $assunto_aprovado,
			'mensagem_aprovacao' => $mensagem_aprovado,
			'assunto_esqueceu' => $assunto_esqueceu,
		*/
	);

	$wpdb->insert(BD_CONFIGURACOES, $varOptions);
}

// $sql6 = "
// 	CREATE TABLE " . BD_CURRICULO . " 			LIKE " . $wpdb->prefix . "wls_curriculo;
// 	CREATE TABLE " . BD_AREA_SERVICOS . " 		LIKE " . $wpdb->prefix . "wls_areas;
// 	CREATE TABLE " . BD_CONFIGURACOES . " 		LIKE " . $wpdb->prefix . "wls_curriculo_options;
// ";
//
// if (sizeof($sql6) > 0) {
// 	// Esta função cria a tabela na base de dados e executa as otimizações necessárias.
// 	dbDelta($sql6);
// }

$upload = wp_upload_dir();
$upload_dir = $upload['basedir'];
$upload_dir = $upload_dir . '/curriculos';

if (!is_dir($upload_dir)) {
	mkdir($upload_dir, 0777);
}

$uploadFoto = wp_upload_dir();
$upload_dirFoto = $uploadFoto['basedir'];
$upload_dirFoto = $upload_dirFoto . '/fotocurriculo';

if (!is_dir($upload_dirFoto)) {
	mkdir($upload_dirFoto, 0777);
}

?>
