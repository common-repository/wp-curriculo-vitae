<?php

global $wpdb, $wpcvp, $uri;

$pg = $_GET['pg'];

foreach ($_POST as $key => $value) {
	${$key} = $value;
}

$headBusca = "";

$busca ? $headBusca .= $buscar . ".&nbsp;&nbsp;" : "";
$bairro ? $headBusca .= $bairro . "&nbsp;-&nbsp;" : "";
$cidade ? $headBusca .= $cidade . "&nbsp;-&nbsp;" : "";
$estado ? $headBusca .= $estado . "." : "";

/*if ($_POST['barea']) {
$bArea = $_POST['barea'];
}*/

echo $headBusca;

$where = "";

if ($buscar != '') {
	$where .= " and ( LOWER(a.nome) LIKE  '%" . strtolower($buscar) . "%' or LOWER(a.descricao) LIKE '%" . strtolower($buscar) . "%' or LOWER(b.area) LIKE '%" . strtolower($buscar) . "%')";
}

if ($bairro != '') {
	$where .= " and LOWER(a.bairro) LIKE  LOWER('%" . strtolower($bairro) . "%')";
}

if ($cidade != '') {
	$where .= " and LOWER(a.cidade) LIKE  LOWER('%" . strtolower($cidade) . "%')";
}

if ($estado != '') {
	$where .= " and LOWER(a.estado) LIKE  LOWER('%" . strtolower($estado) . "%')";
}

if (isset($_POST['bsexo']) && $_POST['bsexo'] != '') {
	$where .= " and a.sexo = " . $_POST['bsexo'];
}

if (isset($_POST['barea']) && $_POST['barea'] != '') {
	$where .= " and b.id = '" . $barea . "'";
}

######### INICIO Paginação
$numreg = 20; // Quantos registros por página vai ser mostrado
if (!isset($pg)) {
	$pg = 0;
}

$inicial = $pg * $numreg;

######### FIM dados Paginação

$sql = "SELECT a.*,
			   b.area

		FROM " . BD_CURRICULO . " a

			left join " . BD_AREA_SERVICOS . " b
				on a.id_area = b.id

		where 1=1 $where group by a.id order by a.nome asc LIMIT $inicial, $numreg ";

$query = $wpdb->get_results($sql);

$sqlRow = "SELECT a.*,
				  b.area

		   FROM " . BD_CURRICULO . " a

		   	left join " . BD_AREA_SERVICOS . " b
					on a.id_area = b.id

		   where 1=1 $where group by a.id order by a.nome asc";


$queryRow = $wpdb->get_results($sqlRow);
$quantreg = $wpdb->num_rows; // Quantidade de registros pra paginação

include plugin_dir_path(__FILE__) . 'classes/estados.php';

?>
<div id="wp-cvp">
        <form id="wp-curriculo-busca-rapida" method="post">
          <input type="hidden" id="url_ajax" value="<?php echo admin_url('admin-ajax.php'); ?>"  />

          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
              <div class="form-group">
                <input type="text" name="buscar" placeholder="Nome, área de atuação, experiência..." class="form-control form-control-sm" >
              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">

              <div class="form-group">
                <div class="controls">
                  <select name="estado" class="form-control form-control-sm" id="estado">
                    <option value="">Selecione o estado</option>
                    <?php

$sqlEstado = "SELECT estado FROM " . BD_CURRICULO . " where estado IS NOT NULL and status = 2 group by estado";
$queryEstado = $wpdb->get_results($sqlEstado);
?>
                    <?php foreach ($queryEstado as $kE => $vE) {
											if($vE->estado != ""){?>
                        <option value="<?php echo $vE->estado ?>" <?php echo $vE->estado==$estado?'selected':''; ?>><?php echo $vE->estado ?></option>
                    <?php } }?>
                  </select>
                </div>
              </div>

            </div>
          </div>

          <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
              <div class="form-group">
                <select name="cidade" class="form-control form-control-sm" <?php echo $cidade!=''?'':'disabled="disabled"'; ?>  id="cidade">

									<?php if($cidade!=''){	?>
										<option value=""><?php echo $cidade ?></option>
									<?php }else{ ?>
										<option value="">Selecione a cidade</option>
									<?php } ?>

                </select>

              </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
              <div class="form-group">
                  <select name="bairro" class="form-control form-control-sm" <?php echo $bairro !=''?'':'disabled="disabled"'; ?> id="bairro">
										<?php if($bairro!=''){	?>
											<option value=""><?php echo $bairro ?></option>
										<?php }else{ ?>
											<option value="">Selecione o bairro</option>
										<?php } ?>
                  </select>
              </div>
            </div>

            <div class="col-xs-12 col-sm-6 col-md-9 col-lg-9">
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
                          <option value="<?php echo $vA['id'] ?>" <?php echo @$barea == $vA['id'] ? "selected" : ""; ?> ><?php echo $vA['area'] ?></option>
                      <?php }?>
                    </select>

            </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3">
              <div class="form-group">
                  <label>Sexo:</label>
                  <select name="bsexo" class="form-control form-control-sm">
                      <option></option>
                      <option value="0"  <?php echo (isset($_POST['bsexo']) && $_POST['bsexo']='0')?'selected':''; ?>>Feminino</option>
                      <option value="1"  <?php echo (isset($_POST['bsexo']) && $_POST['bsexo']='1')?'selected':''; ?>>Masculino</option>
                  </select>
              </div>
            </div>


          </div>

          <button type="submit" class="btn btn-primary">
            <span class="glyphicon glyphicon-search" aria-hidden="true"></span> Pesquisar</button>

        </form>
        <div class="clearfix"></div>
        <div class="table-responsive">
          <table class="table table-sm table-striped table-bordered">
            <thead>
              <tr>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Cargo</th>
                <th class="text-center" colspan="3">Links</th>
              </tr>
            </thead>
            <tbody>
              <?php

$x = 1;
foreach ($query as $k => $v) {
	//print_r($v)

	?>
                          <input type="hidden" id="id_registro_<?php echo $x ?>" value="<?php echo $v->id ?>" />
                          <tr>
                            <td><?php echo $v->nome ?></td>

                            <td >
                              <a class="abrirDescricao text-primary" rel="<?php echo $x; ?>" style="cursor:pointer;">Visualizar</a>
                            </td>

                            <td><?php echo $v->area ?></td>

                            <td class="text-center"><a href="mailto:<?php echo $v->email ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Enviar e-mail para <?php echo $v->email ?>">
                            <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a></td>

                            <td class="text-center">
                              <?php if (isset($v->curriculo) && $v->curriculo != null && $v->curriculo != '') {?>
                                <a href="<?php echo content_url('uploads/curriculos/' . $v->curriculo); ?>" target="_blank" data-toggle="tooltip" data-placement="top" title="Abrir arquivo anexo"> <span class="glyphicon glyphicon-file" aria-hidden="true"></span></a>
                              <?php } else {?>
                                <span class="glyphicon glyphicon-file text-muted" aria-hidden="true"></span>
                              <?php }?>
                            </td>

                          </tr>

                    <?php

	$x++;

}?>

            </tbody>
          </table>
        </div>

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

        </div>
      </div>
    </div>
		<?php

		if ($quantreg > $numreg) {
			// Chama o arquivo que monta a paginação. ex: << anterior 1 2 3 4 5 próximo >>
			include plugin_dir_path(__FILE__) . 'classes/paginacao.php';
		}
		?>
	</div>
