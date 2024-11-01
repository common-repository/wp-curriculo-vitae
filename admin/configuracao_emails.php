<?php

global $wpdb, $wpcvp;

if (isset($_POST['salvar'])) {
	require_once "include/enviarOptions.php";
}

$sqlOp = "SELECT * FROM " . BD_CONFIGURACOES . " where 1=1 and id=1";

$queryOp = $wpdb->get_results($sqlOp, ARRAY_A);

foreach ($queryOp as $kOp => $vOp) {
	$dadosOp = $vOp;
}

wp_enqueue_style('wpcvpa_style', plugins_url('css/style.css', __FILE__));
wp_enqueue_style('wpcva_bootstrap', plugins_url('../css/bootstrap.min.css', __FILE__));

wp_enqueue_script('jquery');
wp_enqueue_script('wpcvpa_bootstrapJS', plugins_url('../js/bootstrap.min.js', __FILE__));
wp_enqueue_script('wpcvpa_script', plugins_url('js/script.js', __FILE__));

?>
<div class="container-fluid">
    <h1><?php echo NAME_CONFIG ?></h1>
    <p>Para usar as informações do cadastrado no e-mail usar os comandos abaixo:</p>
    <div class="row">
      <div class="col-4 col-md-3"><strong>@login</strong></div>
      <div class="col-4 col-md-3"><strong>@senha</strong></div>
      <div class="col-4 col-md-3"><strong>@nome</strong></div>
      <div class="col-4 col-md-3"><strong>@email</strong></div>
      <div class="col-4 col-md-3"><strong>@cpf</strong></div>
      <div class="col-4 col-md-3"><strong>@cep</strong></div>
      <div class="col-4 col-md-3"><strong>@rua</strong></div>
      <div class="col-4 col-md-3"><strong>@bairro</strong></div>
      <div class="col-4 col-md-3"><strong>@cidade</strong></div>
      <div class="col-4 col-md-3"><strong>@estado</strong></div>
      <div class="col-4 col-md-3"><strong>@numero</strong></div>
      <div class="col-4 col-md-3"><strong>@telefone</strong></div>
      <div class="col-4 col-md-3"><strong>@celular</strong></div>
      <div class="col-4 col-md-3"><strong>@site_blog</strong></div>
      <div class="col-4 col-md-3"><strong>@skype</strong></div>
      <div class="col-4 col-md-3"></div>
      <div class="col-4 col-md-3"></div>

    </div>


<?php
if ($_POST['salvar']) {
	include plugin_dir_path(__FILE__) . 'include/enviarOptions.php';
}
?>

<?php if (@$_GET['msg'] == 1) {?>

  <div class="alert alert-success" style="text-align:center;">Salvo com sucesso!</div>

<?php }?>

	<form method="post" class="mt-5">
      <h5>Formulário de cadastro com lightBox?</h5>
        <div class="row">
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="radio">
              <label>
                <input type="radio" name="light_box" id="light_box1" value="0" <?php echo $dadosOp['light_box'] == '0' ? "checked" : ""; ?>  />
                Não
              </label>
            </div>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="radio">
              <label>
                <input type="radio" name="light_box" id="light_box2" value="1" <?php echo $dadosOp['light_box'] == '1' ? "checked" : ""; ?> />
                Sim
              </label>
            </div>
          </div>
        </div>

        <h5>Permitir cadastrar novas áreas de serviço pelo site?</h5>
        <div class="row">
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="radio">
              <label>
                <input type="radio" name="new_area_ex" id="new_area_ex1" value="0" <?php echo $dadosOp['new_area_ex'] == '0' ? "checked" : ""; ?>  />
                Não
              </label>
            </div>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
            <div class="radio">
              <label>
                <input type="radio" name="new_area_ex" id="new_area_ex2" value="1" <?php echo $dadosOp['new_area_ex'] == '1' ? "checked" : ""; ?> />
                Sim
              </label>
            </div>
          </div>
        </div>

        <h5>Configuração de CSS</h5>
        <div class="form-group">
          <label class="control-label">CSS:</label>
          <div class="controls">
            <textarea name="css" id="css" class="form-control" ><?php echo $dadosOp['css']; ?></textarea>
          </div>
        </div>
        <?php
$campos = json_decode($dadosOp['campos']);
$abas = json_decode($dadosOp['abas']);
?>
		    <h5>Configura&ccedil;&otilde;es de e-mail cadastro</h5>

        <div class="form-group">
          <label class="control-label cep">Assunto:</label>
          <div class="controls">
            <input type="text" name="assunto_cadastro" id="assunto_cadastro" value="<?php echo $dadosOp['assunto_cadastro']; ?>" class="form-control" />
          </div>
        </div>

        <div class="form-group">
          <label class="control-label cep">Mensagem:</label>
          <div class="controls">

            <?php wp_editor($dadosOp['mensagem_cadastro'], 'wpcvp_mensagem_cadastro', $settings = array('textarea_name' => mensagem_cadastro));?>

          </div>
        </div>

        <h5>Configura&ccedil;&otilde;es de e-mail cadastro para o admin</h5>

        <div class="form-group">
          <label class="control-label cep">Assunto:</label>
          <div class="controls">
            <input type="text" name="assunto_cadastro_admin" id="assunto_cadastro_admin" value="<?php echo $dadosOp['assunto_cadastro_admin']; ?>" class="form-control" />
          </div>
        </div>

        <div class="form-group">
          <label class="control-label cep">Mensagem:</label>
          <div class="controls">

            <?php wp_editor($dadosOp['mensagem_cadastro_admin'], 'wpcvp_mensagem_cadastro_admin', $settings = array('textarea_name' => mensagem_cadastro_admin));?>

          </div>
        </div>

        <h5>Personalizar configura&ccedil;&otilde;es de remetente</h5>

        <div class="rows">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
              <div class="form-group">
                <label for="tipo_envio" class="control-label">Tipo de envio:</label>
                <div class="controls">
                  <select class="form-control" name="tipo_envio" id="tipo_envio">
                      <option value="0" <?php echo @$dadosOp['tipo_envio'] == "0" ? "selected" : ""; ?>>Normal</option>
                      <option value="1" <?php echo @$dadosOp['tipo_envio'] == "1" ? "selected" : ""; ?>>SMTP</option>
                  </select>
                </div>
              </div>
            </div>
          </div>

          <?php $hidden = @$dadosOp['tipo_envio'] == "0" ? "" : "style='display:none;'";?>
          <div id="personalizarSMTP" <?php echo $hidden ?>>
          <div class="rows smtp" >
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="form-group">
              <label class="control-label">Host:</label>
              <div class="controls">
                <input type="text" name="host" id="host" value="<?php echo $dadosOp['host']; ?>" class="form-control" />
              </div>
            </div>
          </div>

          <div class="rows smtp">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
              <div class="form-group">
                  <label class="control-label">Usuário:</label>
                  <div class="controls">
                    <input type="text" name="usuario" id="usuario" value="<?php echo $dadosOp['usuario']; ?>" class="form-control" />
                  </div>
                </div>
            </div>


            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
              <div class="form-group">
                  <label class="control-label">Senha:</label>
                  <div class="controls">
                    <input type="password" name="senha" id="senha" value="<?php echo $dadosOp['senha']; ?>" class="form-control" />
                  </div>
                </div>
            </div>
          </div>

          <div class="rows smtp">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
              <div class="checkbox">
              <label>
                <input type="checkbox" value="1" name="smtp_autententicacao" <?php echo @$dadosOp['smtp_autententicacao'] == "1" ? "checked" : ""; ?>>
                  SMTP com autenticação de segurança?
              </label>
            </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
              <div class="form-group">
              <label class="control-label">Segurança:</label>
              <div class="controls">
                <select class="form-control" name="seguranca" id="seguranca">
                  <option value="0"></option>
                  <option value="STARTTLS" <?php echo @$dadosOp['seguranca'] == "STARTTLS" ? "selected" : ""; ?>>STARTTLS</option>
                  <option value="SSL/TLS" <?php echo @$dadosOp['seguranca'] == "SSL/TLS" ? "selected" : ""; ?>>SSL/TLS</option>
                </select>
              </div>
            </div>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
              <div class="form-group">
                    <label class="control-label">Porta de saída:</label>
                    <div class="controls">
                      <input type="text" name="porta_saida" id="porta_saida" value="<?php echo $dadosOp['porta_saida']; ?>" class="form-control" />
                    </div>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            	<div class="form-group">
                  <label class="control-label">Nome:</label>
                  <div class="controls">
                    <input type="text" name="nome" value="<?php echo $dadosOp['nome']; ?>" class="form-control" />
                  </div>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            	<div class="form-group">
                  <label class="control-label">E-mail:</label>
                  <div class="controls">
                    <input type="text" name="email" value="<?php echo $dadosOp['email']; ?>" class="form-control" />
                  </div>
                </div>
            </div>

        </div>

        <button type="submit" name="salvar" id="cadastrar" class="btn btn-primary">Salvar</button>

    </form>


</div>
