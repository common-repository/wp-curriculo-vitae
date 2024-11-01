<?php
##############################################################################
#Definindo as URLs e nomes das páginas

#Definições do menu Informações
define("NAME_INF", "Informações");
define("URL_INF", "curriculo-vitae-premium");

#Definições do menu Configurações
define("NAME_CONFIG", "Configuração");
define("URL_CONFIG", "configuracao-premium");

#Definições do menu Novo cadastro
define("NAME_FOR_REG", "Novo cadastro");
define("URL_FOR_REG", "formulario-premium-admin");

#Definições do menu Lista de currículos
define("NAME_LIST_CURR", "Lista de currículos");
define("URL_LIST_CURR", "lista-de-curriculos-premium-admin");

#Definições do menu Áreas de serviços
define("NAME_AREA_SERV", "Áreas de serviços");
define("URL_AREA_SERV", "areas-de-servicos-premium");

##############################################################################
#Definições dos bancos

define("BD_CURRICULO", $wpdb->prefix . 'wls_curriculo');
define("BD_AREA_SERVICOS", $wpdb->prefix . 'wls_areas');
define("BD_CONFIGURACOES", $wpdb->prefix . 'wls_curriculo_options');

if (!class_exists('WpWls')) {
	include_once plugin_dir_path(__FILE__) . '../admin/include/class.wpwls.php';
}

if (!class_exists('Mobile_Detect')) {
	require_once plugin_dir_path(__FILE__) . "../include/Mobile_Detect.php";
}


	require plugin_dir_path(__FILE__) . "../include/uri.class.php";


$detect = new Mobile_Detect;

$wpcvp = new WpWls();

$uri = new URI();

?>
