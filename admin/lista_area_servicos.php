<?php

global $wpdb, $wpcvp;

########### Função para excluir registro
if (isset($_POST['excl'])) {

	$wpcvp->deleteTable($_POST['excl'], BD_AREA_SERVICOS);

}

$cadastrar = @$_POST["cadastrar"];
$cadastrar_x = @$_POST["cadastrar_x"];

if (isset($_POST["cadastrar"])) {

	global $wpdb;

	$area = $_POST["area"];

	// A Hora a que o usuário acessou
	$current_time = current_time('mysql');

	// Checamos se não existe nenhum registo procedemos
	$var = array(
		'area' => $area,
	);

	/*print"<pre>";
		print_r($var);
	*/

	$proto = strtolower(preg_replace('/[^a-zA-Z]/', '', $_SERVER['SERVER_PROTOCOL'])); //pegando só o que for letra
	$location = $proto . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

	$path = $location;

	$sql = "SELECT * FROM " . BD_AREA_SERVICOS . " where area = '" . $area . "' ";
	$query = $wpdb->get_results($sql);
	$rows = $wpdb->num_rows;

	if ($rows == 0) {

		// Guardar os valores na tabela
		$wpdb->insert(BD_AREA_SERVICOS, $var);
		echo "<script>location.href='" . $wpcvp->removeMsg($path) . "&msg=1'</script>";

	} else {

		echo "<script>location.href='" . $wpcvp->removeMsg($path) . "&msg=2'</script>";

	}

	#$wpdb->show_errors();
	#$wpdb->print_error();

}

wp_enqueue_style('bootstrap', plugins_url('../css/bootstrap.min.css', __FILE__));
wp_enqueue_style('bootstrap', plugins_url('../css/bootstrap-grid.min.css', __FILE__));
wp_enqueue_style('bootstrap', plugins_url('../css/bootstrap-reboot.min.css', __FILE__));
wp_enqueue_style('glyphicon', plugins_url('../css/glyphicon.css', __FILE__));
wp_enqueue_style('wpcvpa_style', plugins_url('css/style.css?1=1', __FILE__));

wp_enqueue_script('jquery');
wp_enqueue_script('wpcvp_bootstrap', plugins_url('../js/bootstrap.min.js', __FILE__));
wp_enqueue_script('wpcvp_bootstrap', plugins_url('../js/bootstrap.bundle.min.js', __FILE__));
wp_enqueue_script('wpcvpa_script', plugins_url('js/script.js', __FILE__));

?>
<div class="container">
    <h2><?php echo NAME_AREA_SERV ?></h2>

    <form method="post">
      <div class="row">
      	<div class="col-12 col-md-6">
          <div class="input-group input-group-sm" id="campoArea">
            <label for="area">Cadastrar uma novo cargo:</label>
            <div class="w-100"></div>
            <input type="text" class="form-control" name="area" id="area" />
          </div>
        </div>
        <div class="col-12 col-md-6 pt-1">
        	<button type="submit" name="cadastrar" class="btn bt_area btn-success mt-4">
            <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Cadastrar
          </button>
        </div>
      </div>
    </form>

    <?php

$table = BD_AREA_SERVICOS;

//######### INICIO Paginação
$numreg = 20; // Quantos registros por página vai ser mostrado
if ($_GET['pg']) {
	$pg = $_GET['pg'];
} else {
	$pg = 0;
}
$inicial = $pg * $numreg;
//######### FIM dados Paginação

$sql = "SELECT * FROM " . $table . " where 1=1 order by area asc LIMIT $inicial, $numreg ";
$query = @$wpdb->get_results(@$sql);

$sqlRow = "SELECT * FROM " . $table . " where 1=1 order by area asc";
$queryRow = $wpdb->get_results($sqlRow);
$quantreg = $wpdb->num_rows; // Quantidade de registros pra paginação
if ($queryRow) {
	?>

    		<?php if ($_GET['msg'] == 1) {?>
    			<div class="alert bg-success">Registro cadastrado com sucesso!</div>
            <?php } elseif ($_GET['msg'] == 2) {?>
            	<div class="alert bg-danger">Já existe.</div>
            <?php } elseif ($_GET['msg'] == 3) {?>
            	<div class="alert bg-success">Registro deletado com sucesso!</div>
            <?php }?>

            <div class="float-right">
              <a class="btn btn-sm bg-danger text-white mb-2" href="javascript:registros.submit();"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
            </div>

    		<form action="?page=<?php echo URL_AREA_SERV ?>" name="registros" id="registros" method="post">
                <table class="table table-striped table-bordered table-sm table-hover">
                  <thead>
                    <tr>
                      <th>Cargo cadastrados</th>
                      <th width="30" class="text-center"><input type="checkbox" id="checkAll" /></th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php
$x = 0;
	foreach ($query as $k => $v) {
		//print_r($v);
		?>

                    <tr>
                      <td><div id="response"></div><span class="areaEdit" rel="<?php echo $v->id ?>" ><?php echo @$v->area ?></span></td>
                      <td class="text-center">
                      	<input type="checkbox" name="excl[]" value="<?php echo $v->id ?>" class="check" />
                      </td>
                    </tr>

                  <?php $x++;}?>

                  </tbody>
                </table>
            </form>



		<?php } else {?>
        	<div class="alert bg-success" style="text-align:center;">Nenhum cadastro de cargo encontrado.</div>

        <?php }?>

      <?php
if ($quantreg > $numreg) {
	// Chama o arquivo que monta a paginação. ex: << anterior 1 2 3 4 5 próximo >>
	include plugin_dir_path(__FILE__) . '../classes/paginacao.php';
}
?>

</div>
<div id="black_overlay" style="display:none;"></div>
<div id="aviso" style="display:none;">
	<h4>Atualizando registro</h4>
    <div id="avisoMensagem">
    	Aguarde um momento, enquanto atualiza o registro.
    </div>
    <div id="avisoMensagemErro" style="display:none;"><span id='fecharAviso'><strong>Clique aqui</strong></span> para fechar a mensagem.</div>
</div>
