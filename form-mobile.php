  <div class="container-fluid">
  <form id="wp-curriculo-cadastro" name="formCadastro" method="post" enctype="multipart/form-data">
    <input type="hidden" name="tipoF" value="admin" />
    <?php if ($dados['id']) {?>
    <input type="hidden" name="mod" value="edit" />
    <input type="hidden" name="id_cadastro" id="id_cadastro" value="<?php echo $dados['id']; ?>" />
    <?php } else {?>
    <input type="hidden" name="mod" value="new" />
    <?php }?>

    <?php /*<div class="accordion" id="formMobileCollapse">
      <div class="card">
        <div class="card-header text-center pt-2 pl-2 pb-2 pr-2" id="headingOne">
          <h4 class="mb-0">
          <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseDadosPessoais" aria-expanded="false" aria-controls="collapseDadosPessoais">
            Dados Pessoais
          </button>
          </h4>
        </div>
        <div id="collapseDadosPessoais" class="collapse" data-parent="#formMobileCollapse" aria-labelledby="headingOne">
          <div class="card-body">*/ ?>
            <div class="container-fluid">
              <h4><b>Dados Pessoais</b></h4>
              <div class="form-group">
                <label class="control-label">Nome:</label>
                <div class="controls">
                  <input type="text" class="form-control" name="nome" value="<?php echo @$dados['nome'] ?>" />
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-6 col-lg-6">
                  <div class="form-group">
                    <label class="control-label">Sexo:</label>
                    <div class="controls">
                      <select class="form-control" name="sexo">
                        <option></option>
                        <option value="0"   <?php echo @$dados['sexo'] == "0" ? "selected" : "" ?> >Feminino</option>
                        <option value="1"   <?php echo @$dados['sexo'] == "1" ? "selected" : "" ?> >Masculino</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-6 col-lg-6">
                  <div class="form-group">
                    <label class="control-label">Estado c&iacute;vil:</label>
                    <div class="controls">
                      <select class="form-control" name="estado_civil">
                        <option value="0"></option>
                        <option value="1" <?php echo @$dados['estado_civil'] == "1" ? "selected" : ""; ?>>Solteiro(a)</option>
                        <option value="2" <?php echo @$dados['estado_civil'] == "2" ? "selected" : ""; ?>>Viuvo(a)</option>
                        <option value="3" <?php echo @$dados['estado_civil'] == "3" ? "selected" : ""; ?>>Casado(a)</option>
                        <option value="4" <?php echo @$dados['estado_civil'] == "4" ? "selected" : ""; ?>>Divorciado(a)</option>
                        <option value="5" <?php echo @$dados['estado_civil'] == "5" ? "selected" : ""; ?>>Amigável</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-12 col-lg-12">
                  <div class="form-group">
                    <label class="control-label">Data de nascimento:</label>
                    <div class="controls">
                      <input type="date" class="form-control" name="idade" value="<?php echo @$dados['idade'] ?>" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group">
                    <label class="control-label">Telefone:</label>
                    <div class="controls">
                      <input type="tel" class="form-control telefone" name="telefone" value="<?php echo @$dados['telefone'] ?>" />
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group">
                    <label class="control-label">Celular:</label>
                    <div class="controls">
                      <input type="tel" class="form-control telefone" name="celular" value="<?php echo @$dados['celular'] ?>" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group">
                    <label class="control-label">E-mail:</label>
                    <div class="controls">
                      <input type="text" class="form-control" name="email" value="<?php echo @$dados['email'] ?>" />
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group">
                    <label class="control-label">Skype:</label>
                    <div class="controls">
                      <input type="text" class="form-control" name="skype" value="<?php echo @$dados['skype'] ?>" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Site/Blog:</label>
                <div class="controls">
                  <input type="url" class="form-control" name="site_blog" value="<?php echo @$dados['site_blog'] ?>" />
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group">
                    <?php
global $wpdb;
$sqlArea = "SELECT * FROM " . BD_AREA_SERVICOS . " where 1=1";
$queryArea = $wpdb->get_results($sqlArea, ARRAY_A);
?>
                    <label class="control-label">Cargo Pretendido:</label>
                    <div class="controls">
                      <select class="form-control" id="id_area" name="id_area">
                        <option value="0">Selecione um área</option>
                        <?php foreach ($queryArea as $kA => $vA) {?>
                        <option value="<?php echo $vA['id'] ?>" <?php echo @$dados['id_area'] == $vA['id'] ? "selected" : ""; ?> ><?php echo $vA['area'] ?></option>
                        <?php }?>
                        <?php if ($dadosOp['new_area_ex'] == "1") {?>
                        <option value="outro">Outro</option>
                        <?php }?>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group has-feedback" id="campoArea" style="display:none;">
                    <label class="control-label" for="area">Escreva seu cargo:</label>
                    <input type="text" class="form-control" name="area" id="area" aria-describedby="" />
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Pretensão Salarial:</label>
                <div class="controls">
                  <input type="text" class="form-control" name="remuneracao" value="<?php echo @$dados['remuneracao']; ?>" />
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group">
                    <label class="control-label">Login:</label>
                    <div class="controls">
                      <input type="text" class="form-control" name="login" value="<?php echo @$dados['login']; ?>" />
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group">
                    <label class="control-label">Senha:</label>
                    <div class="controls">
                      <input type="password" class="form-control" name="senha">
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group has-feedback">
                    <label class="control-label" for="cpf">CPF</label>
                    <input type="text" class="form-control" name="cpf" id="cpf" value="<?php echo @$dados['cpf']; ?>" aria-describedby="">
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group">
                    <label class="control-label">CEP:</label>
                    <div class="controls">
                      <input type="text" class="form-control" name="cep" value="<?php echo @$dados['cep']; ?>" id="wpcvpcep" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-9 col-sm-10 col-md-10 col-lg-10">
                  <div class="form-group">
                    <label class="control-label">Endereço:</label>
                    <div class="controls">
                      <input type="text" class="form-control" name="rua" id="rua" value="<?php echo @$dados['rua']; ?>" id="rua" />
                    </div>
                  </div>
                </div>
                <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2">
                  <div class="form-group">
                    <label class="control-label">N&ordm;:</label>
                    <div class="controls">
                      <input type="text" class="form-control" name="numero" id="numero" value="<?php echo @$dados['numero']; ?>" id="numero" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Bairro:</label>
                <div class="controls">
                  <input type="text" class="form-control" name="bairro" id="bairro" value="<?php echo @$dados['bairro']; ?>" id="bairro" />
                </div>
              </div>
              <div class="row">
                <div class="col-xs-9 col-sm-10 col-md-10 col-lg-10">
                  <div class="form-group">
                    <label class="control-label">Cidade:</label>
                    <div class="controls">
                      <input type="text" class="form-control" name="cidade" id="cidade" value="<?php echo @$dados['cidade']; ?>" id="cidade" />
                    </div>
                  </div>
                </div>
                <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2">
                  <div class="form-group">
                    <label class="control-label">Estado:</label>
                    <div class="controls">
                      <input type="text" class="form-control" name="estado" id="estado" value="<?php echo @$dados['estado']; ?>" id="estado" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Resumo Profissional:</label>
                <div class="controls">
                  <textarea class="form-control input-block-level" name="descricao"><?php echo @$dados['descricao']; ?></textarea>
                </div>
              </div>
              <?php /*
            </div>
          </div>
        </div>
      </div>
    </div>*/?>
    <?php ############################# FOTO ################################## ?>
    <div class="row">
      <div class="col-12 col-md-2">
        <div class="card mt-2 pt-2 pr-2 pb-2 pl-2">
            <?php if ($dados['foto']) {?>
                <input type="hidden" name="fotoCar" value="<?php echo @$dados['foto']; ?>" />
                <img class="ml-auto mr-auto" src="<?php echo content_url('uploads/fotocurriculo/' . @$dados['foto']); ?>" width="100" />
            <?php } else {?>
                <img class="ml-auto mr-auto" id="fotoCurriculo" src="<?php echo plugins_url('img/sem-foto.png', __FILE__) ?>" width="100" />
            <?php }?>
        </div>
      </div>
      <div class="col-12 col-md-10">
          <div class="form-group">

            <label>Enviar foto:</label>

            <div class="custom-file">
              <input type="file" class="custom-file-input" name="foto" id="foto">
              <label class="custom-file-label" for="foto">Selecione sua foto</label>
            </div>

          </div>
      </div>

    <?php ############################# CURRÍCULO ################################## ?>
    <?php if ($dados['curriculo']) {?>

                <div class="col-12 mt-3">
                  <input type="hidden" name="curriculoCar" value="<?php echo @$dados['curriculo']; ?>" />
                  <div class="container-fluid">
                      <label class="control-label">Arquivo já salvo:</label>
                      <div class="well">
                          <a href="<?php echo content_url('uploads/curriculos/' . @$dadosF['curriculo']); ?>" target="_blank" > <?php echo @$_SESSION['curriculo'] ?></a>
                      </div>
                  </div>
                </div>

            <?php }?>

              <div class="col-12 mt-3">
                <div class="form-group">
                  <label class="control-label">Enviar currículo:</label>

                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="curriculo" id="curriculo">
                    <label class="custom-file-label" for="foto">Selecione o arquivo</label>
                    <small id="curriculoHelpBlock" class="form-text text-muted">
  Não é permitido enviar arquivo com extensão <b><span id="ext"></span></b>. Extensões permitidas: <strong>pdf</strong>, <strong>doc</strong> e <strong>docx</strong>.
</small>
                  </div>

                </div>
              </div>
  </div>
  <div class="container-fluid text-center">
    <?php if ($id_cadastro) {?>
    <button type="submit" name="cadastrar" id="cadastrar" class="btn btn-success tbCadastrarSite">
      <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Atualizar</button>
    <?php } else {?>
    <button type="submit" name="cadastrar" id="cadastrar" class="btn btn-success tbCadastrarSite">
      <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Cadastrar</button>
    <?php }?>
  </div>
</form>
</div>
