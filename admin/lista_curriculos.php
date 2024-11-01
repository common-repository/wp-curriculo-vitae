<?php

global $wpdb, $wpcvp;

include_once plugin_dir_path(__FILE__) . '../classes/estados.php';

$table = BD_CURRICULO;

$pg = $_GET['pg'];

if ($_POST['bnome']) {
	$bNome = $_POST['bnome'];
}

if ($_POST['bcidade']) {
	$bCidade = $_POST['bcidade'];
}

if ($_POST['bestado']) {
	$bEstado = $_POST['bestado'];
}

if ($_POST['bbairro']) {
	$bBairro = $_POST['bbairro'];
}

if ($_POST['barea']) {
	$bArea = $_POST['barea'];
}

if ($_POST['bcargo']) {
	$bcargo = $_POST['bcargo'];
}

$msg = $_GET['msg'];

$where = "";

if ($bNome) {
	$where .= " and LOWER(a.nome) LIKE  '%" . strtolower($bNome) . "%'";
}

if ($bEstado) {
	$where .= " and LOWER(a.estado) LIKE '%" . strtolower($bEstado) . "%'";
}

if ($bCidade) {
	$where .= " and LOWER(a.cidade) LIKE '%" . strtolower($bCidade) . "%'";
}

if ($bBairro) {
	$where .= " and LOWER(a.bairro) LIKE '%" . strtolower($bBairro) . "%'";
}

if ($bArea) {
	$where .= " and b.id = '" . $bArea . "'";
}

if ($buscar) {
	$where .= " and (nome LIKE  '%" . $buscar . "%' or descricao LIKE '%" . $buscar . "%')";
}

if (isset($_POST['bsexo']) && $_POST['bsexo'] != '') {
	$where .= " and a.sexo = " . $_POST['bsexo'];
}

if (isset($_POST['bcargo'])) {
	$where .= " and LOWER(b.area) LIKE '%" . strtolower($bcargo) . "%'";
}

########### Função para excluir registro

if (isset($_POST['excl'])) {

	$wpcvp->deleteTable($_POST['excl'], BD_CURRICULO);

}

//######### INICIO Paginação
$numreg = 20; // Quantos registros por página vai ser mostrado
if (!isset($pg)) {
	$pg = 0;
}
$inicial = $pg * $numreg;

//######### FIM dados Paginação

$sql = "SELECT a.*,
			   b.area

		FROM " . BD_CURRICULO . " a

			left join " . BD_AREA_SERVICOS . " b
				on a.id_area = b.id

		where 1=1 $where group by a.id order by a.nome asc LIMIT $inicial, $numreg ";

$query = $wpdb->get_results($sql);
$rowsCurr = $wpdb->num_rows;
$rowsAguardando = $wpcvp->selectWP(BD_CURRICULO, " and status='0'");
$rowsAprovado = $wpcvp->selectWP(BD_CURRICULO, " and status='2'");
$rowsReprovado = $wpcvp->selectWP(BD_CURRICULO, " and status='1'");

$sqlRow = "SELECT a.*,
				  b.area

		   FROM " . BD_CURRICULO . " a

		   		left join " . BD_AREA_SERVICOS . " b
					on a.id_area = b.id

		   where 1=1 $where group by a.id order by a.nome asc";

$queryRow = $wpdb->get_results($sqlRow);
$quantreg = $wpdb->num_rows; // Quantidade de registros pra paginação

wp_enqueue_style('bootstrap', plugins_url('../css/bootstrap.min.css', __FILE__));
wp_enqueue_style('bootstrap', plugins_url('../css/bootstrap-grid.min.css', __FILE__));
wp_enqueue_style('bootstrap', plugins_url('../css/bootstrap-reboot.min.css', __FILE__));
wp_enqueue_style('glyphicon', plugins_url('../css/glyphicon.css', __FILE__));
wp_enqueue_style('wpcvpa_style', plugins_url('css/style.css?1=1', __FILE__));

wp_enqueue_script('jquery');
wp_enqueue_script('wpcvp_popper', plugins_url('../js/popper.js', __FILE__));
wp_enqueue_script('wpcvp_bootstrap', plugins_url('../js/bootstrap.min.js', __FILE__));
wp_enqueue_script('wpcvp_bootstrap', plugins_url('../js/bootstrap.bundle.min.js', __FILE__));
wp_enqueue_script('wpcvpa_script', plugins_url('js/script.js', __FILE__));

?>

<div class="container-fluid">
  <h2 class="float-left"><?php echo NAME_LIST_CURR ?></h2>

  <a class="btn btn-sm bg-success bt_novo text-white ml-3 mt-2" href="?page=<?php echo URL_FOR_REG ?>">Novo cadastro</a>

  <div class="clearfix"></div>

  <?php if (@$_GET['msg'] == 2) {?>

        <div class="alert bg-success">Currículo Atualizado com sucesso!</div>

  <?php } elseif ($msg == 3) {?>

        <div class="alert bg-success">Registro deletado com sucesso!</div>

  <?php }?>

  <div class="clearfix"></div>
  <h5>Filtrar por:</h5>
  <form action="#" method="post" accept-charset="utf-8">
    <div class="row">
      <div class="col-12 col-md-3">
        <div class="form-group">
          <label>Nome:</label>
            <input type="text" name="bnome" value="<?php /*echo $bNome */?>" class="form-control form-control-sm" value="">
        </div>

      </div>
      <div class="col-12 col-md-3">
        <div class="form-group">
          <label>Estado:</label>
            <select class="form-control form-control-sm" name="bestado" id="estado">
              <option></option>
              <?php

$sqlEstado = "SELECT estado FROM " . BD_CURRICULO . " where estado <> ' ' group by estado order by estado asc";
$queryEstado = $wpdb->get_results($sqlEstado);
?>
              <?php foreach ($queryEstado as $kE => $vE) {?>
                  <option value="<?php echo strtoupper($vE->estado) ?>" ><?php echo utf8_encode($estadoArray[strtoupper($vE->estado)]) ?></option>
              <?php }?>
            </select>
        </div>

      </div>
      <div class="col-12 col-md-3">
        <div class="form-group">
          <label>Cidade:</label>
            <select name="bcidade" class="form-control form-control-sm" id="cidade">
            <option></option>
            <?php

$sqlCidade = "SELECT cidade FROM " . BD_CURRICULO . " where cidade <> '' group by cidade order by cidade asc";
$queryCidade = $wpdb->get_results($sqlCidade);
?>
            <?php foreach ($queryCidade as $kC => $vC) {?>
                <option value="<?php echo $vC->cidade ?>" <?php /*echo $bCidade == $vC->cidade?'selected="selected"':'' */?>><?php echo $vC->cidade ?></option>
            <?php }?>
          </select>
        </div>

      </div>

      <div class="col-12 col-md-3">
        <div class="form-group">
          <label>Bairro:</label>
            <select name="bbairro" class="form-control form-control-sm" id="bairro">
            <option></option>
            <?php

$sqlBairro = "SELECT bairro FROM " . BD_CURRICULO . " where bairro <> '' group by bairro order by bairro asc";
$queryBairro = $wpdb->get_results($sqlBairro);
?>
            <?php foreach ($queryBairro as $kB => $vB) {?>
                <option value="<?php echo $vB->bairro ?>"><?php echo $vB->bairro ?></option>
            <?php }?>
          </select>
        </div>
      </div>

      <div class="col-12 col-md-2">
        <div class="form-group">
            <label>Sexo:</label>
            <select name="bsexo" class="form-control form-control-sm">
                <option></option>
                <option value="0" >Feminino</option>
                <option value="1" >Masculino</option>
            </select>
        </div>
      </div>

        <div class="col-12 col-md-5">
            <div class="form-group">

                <?php
global $wpdb;
$sqlArea = "SELECT * FROM " . BD_AREA_SERVICOS . " where 1=1";
$queryArea = $wpdb->get_results($sqlArea, ARRAY_A);
?>

                  <label>Cargo Pretendido:</label>
                  <select class="form-control form-control-sm" name="barea">
                        <option></option>
                    <?php foreach ($queryArea as $kA => $vA) {?>
                        <option value="<?php echo $vA['id'] ?>" <?php echo @$dado['id_area'] == $vA['id'] ? "selected" : ""; ?> ><?php echo $vA['area'] ?></option>
                    <?php }?>
                  </select>
            </div>
        </div>

        <div class="col-12 col-md-5">
            <div class="form-group">
                  <label>Cargo:</label>
                  <input type="text" name="bcargo" class="form-control form-control-sm" value="">
            </div>
        </div>
    </div>

    <button type="submit" name="filtrar" id="filtrar" class="btn btn-primary filtrarList" style="">Filtrar</button>
  </form>

  <div class="clearfix"></div>

  <div class="row mt-4">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <span><?php echo 'Existe <strong>' . $rowsCurr . '</strong> ' . ($rowsCurr <= 1 ? 'currículo cadastrado.' : 'currículos cadastrados.'); ?>.</span>
      <a class="btn btn-sm bg-danger float-right text-white mb-0" href="javascript:registros.submit();"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
    </div>
  </div>

<div class="table-responsive">
  <table class="table table-sm table-bordered table-striped">
    <thead>
      <tr>
        <th width="5%"></th>
        <th>Nome</th>
        <th>Currículo</th>
        <th>Cargos</th>
        <th class="text-center" colspan="3">Links</th>
        <th width="30" class="text-center"><input type="checkbox" id="checkAll" /></th>
      </tr>
    </thead>
    <tbody id="carrList">
    <form action="?page=<?php echo URL_LIST_CURR ?>" name="registros" id="registros" method="post">
        <?php
$x = 0;
foreach ($query as $k => $v) {
	?>
              <input type="hidden" id="id_registro_<?php echo $x ?>" value="<?php echo $v->id ?>" />
              <tr>
                <td class="text-center">
                  <?php if ($v->foto) {?>
                      <img src="<?php echo content_url('uploads/fotocurriculo/' . @$v->foto); ?>" width="50" />
                  <?php } /*else{ ?>
	                      <img src="<?php echo plugins_url('../img/semlogo.jpg', __FILE__) ?>" width="50" />
*/?>
                </td>
                <td id="nomeUser_<?php echo $x ?>" class="<?php echo $statusLinh ?>"><?php echo $v->nome ?></td>

                <td><a class="abrirDescricao text-primary" rel="<?php echo $x; ?>" style="cursor:pointer;" >Visualizar</a></td>

                <td><?php echo $v->area ?></td>

                <td class="text-center" width="1%"><a href="mailto:<?php echo $v->email ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Enviar e-mail para <?php echo $v->email ?>">
                <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a></td>

                <td class="text-center" width="1%">
                  <?php if (isset($v->curriculo) && $v->curriculo != null && $v->curriculo != '') {?>
                  <a href="<?php echo content_url('uploads/curriculos/' . $v->curriculo); ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Abrir arquivo anexo"> <span class="glyphicon glyphicon-file" aria-hidden="true"></span></a>
                  <?php } else {?>
                    <span class="glyphicon glyphicon-file text-muted" aria-hidden="true"></span>
                  <?php }?>
                </td>

                <td class="text-center" width="1%">

                    <a href="?page=<?php echo URL_FOR_REG ?>&id_cadastro=<?php echo $v->id ?>" data-toggle="tooltip" data-placement="top" title="Editar cadastro">
                      <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a><br />

                </td>

                <td class="text-center">
                    <input type="checkbox" name="excl[]" value="<?php echo $v->id ?>" class="check" />
                </td>

              </tr>

        <?php $x++;}?>
    </form>
    </tbody>
  </table>
</div>

<?php
if ($quantreg > $numreg) {
	// Chama o arquivo que monta a paginação. ex: << anterior 1 2 3 4 5 próximo >>
	include plugin_dir_path(__FILE__) . '../classes/paginacao.php';
}
?>

<div class="modal fade" id="ModalDCurriculo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="wpcv_lightbox_content" id="LigthBoxCurriculo"></div>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

<div class="modal fade" id="ModalStatusCadastro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Atualizando</h5>
      </div>
      <div class="modal-body">
        Aguarde enquanto atualiza o status do cadastro.
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>
