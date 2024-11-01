<?php
global $wpdb, $wpcvp, $detect;
$id_cadastro = @$_GET['id_cadastro'];
if (isset($_POST['cadastrar'])) {
#print_r($_POST);
	#exit;
	include_once plugin_dir_path(__FILE__) . 'include/enviarCadastro.php';
}

$dados = $wpdb->get_row("SELECT a.*,
b.area
FROM " . BD_CURRICULO . " a
left join " . BD_AREA_SERVICOS . " b
on a.id_area = b.id
where a.id = '" . @$id_cadastro . "'", ARRAY_A);

$sqlOp = "SELECT * FROM " . BD_CONFIGURACOES . " where id=1";

$queryOp = $wpdb->get_results($sqlOp, ARRAY_A);

foreach ($queryOp as $kOp => $vOp) {
	$dadosOp = $vOp;
}

// wp_enqueue_style("jquery-ui-core", '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css');
// wp_enqueue_style('bootstrap', plugins_url('../css/bootstrap.min.css', __FILE__));
// wp_enqueue_style('bootstrap', plugins_url('../css/bootstrap-grid.min.css', __FILE__));
// wp_enqueue_style('bootstrap', plugins_url('../css/bootstrap-reboot.min.css', __FILE__));
// wp_enqueue_style('glyphicon', plugins_url('../css/glyphicon.css', __FILE__));
// wp_enqueue_style('wpcvpa_style', plugins_url('css/style.css', __FILE__));
// wp_enqueue_script('jquery');
// wp_enqueue_script("jquery-ui-autocomplete");
// wp_enqueue_script('wpcvp_bootstrap', plugins_url('../js/bootstrap.min.js', __FILE__));
// wp_enqueue_script('wpcvp_bootstrap', plugins_url('../js/bootstrap.bundle.min.js', __FILE__));
// wp_enqueue_script('wpcvpa_scriptMask', plugins_url('../js/jquery.maskedinput-1.1.4.pack.js', __FILE__));
// wp_enqueue_script('wpcvpa_scriptArea', plugins_url('../js/scriptArea.js', __FILE__));
// wp_enqueue_script('wpcvpa_script', plugins_url('js/script.js', __FILE__));
?>

<?php if (isset($id_cadastro) && $id_cadastro != '') {?>
	<h1>Editar cadastro - <?php echo $dados['nome'] ?></h1>
<?php } else {?>
	<h1>Novo cadastro</h1>
<?php }?>


<?php
//var_dump($dados);
if ($detect->isMobile() || $detect->isTablet() || $detect->isiOS() || $detect->isAndroidOS()) {
	include plugin_dir_path(__FILE__) . '../form-mobile.php'; // Telas para smartphones e tablets
} else {
	include plugin_dir_path(__FILE__) . '../form-pc.php'; // Tags para PCs ou telas maiores
}

?>
