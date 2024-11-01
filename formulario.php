<?php

global $wpdb, $wpcvp, $detect;

if (isset($_POST['cadastrar'])) {
	include_once plugin_dir_path(__FILE__) . 'admin/include/enviarCadastro.php';
}

$sqlF = "SELECT a.*,
			  b.area

	   FROM " . BD_CURRICULO . " a

			left join " . BD_AREA_SERVICOS . " b
				on a.id_area = b.id

			where a.id = '" . @$_SESSION['id_cadastro'] . "' ";

$queryF = $wpdb->get_results($sqlF, ARRAY_A);

$dadosF = array();
foreach ($queryF as $kF => $vF) {
	$dadosF = $vF;
}

$sqlOp = "SELECT * FROM " . BD_CONFIGURACOES . " where id=1";

$queryOp = $wpdb->get_results($sqlOp, ARRAY_A);

foreach ($queryOp as $kOp => $vOp) {
	$dadosOp = $vOp;
}
?>

<div id="wp-cvp">
  <?php if (@$_GET['msg'] == 1) {?>

      <div class="alert alert-success">Curriculo cadastrado com sucesso!</div>

  <?php } elseif (@$_GET['msg'] == 2) {?>

      <div class="alert alert-success">Curriculo Atualizado com sucesso!</div>

  <?php } elseif (@$_GET['msg'] == 3) {?>

      <div class="alert alert-success">Conta excluido com sucesso!</div>

  <?php }

if ($detect->isMobile() || $detect->isTablet() || $detect->isiOS() || $detect->isAndroidOS()) {
	include plugin_dir_path(__FILE__) . 'form-mobile.php'; // Telas para smartphones e tablets
} else {

	if ($dadosOp['light_box'] == 1) {
		?>
  <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" id="btn-modal-cadastro" data-toggle="modal" data-target="#modalCadastro">
  abrir o formulário de cadastro
</button>

<!-- Modal -->
<div class="modal hide" id="modalCadastro" tabindex="-1" role="dialog" aria-labelledby="modalCadastroLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCadastroLabel">Formulário de cadastro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
include plugin_dir_path(__FILE__) . 'form-pc.php'; // Tags para PCs ou telas maiores
		?>
      </div>

    </div>
  </div>
</div>

<?php } else {
		include plugin_dir_path(__FILE__) . 'form-pc.php'; // Tags para PCs ou telas maiores
	}?>

  <?php }?>


</div>
</div>
