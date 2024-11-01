<div class="container-fluid">
  <form id="formCadastro" name="formCadastro" method="post" enctype="multipart/form-data">
    <input type="hidden" name="tipoF" value="admin" />
    <?php if ($dado['id']) {?>
    <input type="hidden" name="mod" value="edit" />
    <input type="hidden" name="id_cadastro" id="id_cadastro" value="<?php echo $dado['id']; ?>" />
    <?php } else {?>
    <input type="hidden" name="mod" value="new" />
    <?php }?>
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
      <div class="panel panel-default">
        <div class="panel-heading" role="tab" id="headingOne">
          <h4 class="panel-title">
          <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseDadosPessoais" aria-expanded="true" aria-controls="collapseDadosPessoais">
            Dados Pessoais
          </a>
          </h4>
        </div>
        <div id="collapseDadosPessoais" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
          <div class="panel-body">
            <div class="container-fluid">
              <h4><b>Dados Pessoais</b></h4>
              <div class="form-group">
                <label class="control-label">Nome:</label>
                <div class="controls">
                  <input type="text" class="form-control" name="nome" value="<?php echo @$dado['nome'] ?>" />
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-6 col-lg-6">
                  <div class="form-group">
                    <label class="control-label">Sexo:</label>
                    <div class="controls">
                      <select class="form-control" name="sexo">
                        <option></option>
                        <option value="0"   <?php echo @$dado['sexo'] == "0" ? "selected" : "" ?> >Feminino</option>
                        <option value="1"   <?php echo @$dado['sexo'] == "1" ? "selected" : "" ?> >Masculino</option>
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
                        <option value="1" <?php echo @$dado['estado_civil'] == "1" ? "selected" : ""; ?>>Solteiro(a)</option>
                        <option value="2" <?php echo @$dado['estado_civil'] == "2" ? "selected" : ""; ?>>Viuvo(a)</option>
                        <option value="3" <?php echo @$dado['estado_civil'] == "3" ? "selected" : ""; ?>>Casado(a)</option>
                        <option value="4" <?php echo @$dado['estado_civil'] == "4" ? "selected" : ""; ?>>Divorciado(a)</option>
                        <option value="5" <?php echo @$dado['estado_civil'] == "5" ? "selected" : ""; ?>>Amigável</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-4 col-md-12 col-lg-12">
                  <div class="form-group">
                    <label class="control-label">Data de nascimento:</label>
                    <div class="controls">
                      <input type="date" class="form-control" name="idade" value="<?php echo @$dado['idade'] ?>" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group">
                    <label class="control-label">Telefone:</label>
                    <div class="controls">
                      <input type="tel" class="form-control telefone" name="telefone" value="<?php echo @$dado['telefone'] ?>" />
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group">
                    <label class="control-label">Celular:</label>
                    <div class="controls">
                      <input type="tel" class="form-control telefone" name="celular" value="<?php echo @$dado['celular'] ?>" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group">
                    <label class="control-label">E-mail:</label>
                    <div class="controls">
                      <input type="email" class="form-control" name="email" value="<?php echo @$dado['email'] ?>" />
                    </div>
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group">
                    <label class="control-label">Skype:</label>
                    <div class="controls">
                      <input type="text" class="form-control" name="skype" value="<?php echo @$dado['skype'] ?>" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Site/Blog:</label>
                <div class="controls">
                  <input type="url" class="form-control" name="site_blog" value="<?php echo @$dado['site_blog'] ?>" />
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
                        <option value="<?php echo $vA['id'] ?>" <?php echo @$dado['id_area'] == $vA['id'] ? "selected" : ""; ?> ><?php echo $vA['area'] ?></option>
                        <?php }?>
                        <option value="outro">Outro</option>
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
                  <input type="text" class="form-control" name="remuneracao" value="<?php echo @$dado['remuneracao']; ?>" />
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group">
                    <label class="control-label">Login:</label>
                    <div class="controls">
                      <input type="text" class="form-control" name="login" value="<?php echo @$dado['login']; ?>" />
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
                    <input type="text" class="form-control" name="cpf" id="cpf" value="<?php echo @$dado['cpf']; ?>" aria-describedby="">
                  </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                  <div class="form-group">
                    <label class="control-label">CEP:</label>
                    <div class="controls">
                      <input type="text" class="form-control" name="cep" value="<?php echo @$dado['cep']; ?>" id="cep" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-9 col-sm-10 col-md-10 col-lg-10">
                  <div class="form-group">
                    <label class="control-label">Endereço:</label>
                    <div class="controls">
                      <input type="text" class="form-control" name="rua" value="<?php echo @$dado['rua']; ?>" id="rua" />
                    </div>
                  </div>
                </div>
                <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2">
                  <div class="form-group">
                    <label class="control-label">N&ordm;:</label>
                    <div class="controls">
                      <input type="text" class="form-control" name="numero" value="<?php echo @$dado['numero']; ?>" id="numero" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Bairro:</label>
                <div class="controls">
                  <input type="text" class="form-control" name="bairro" value="<?php echo @$dado['bairro']; ?>" id="bairro" />
                </div>
              </div>
              <div class="row">
                <div class="col-xs-9 col-sm-10 col-md-10 col-lg-10">
                  <div class="form-group">
                    <label class="control-label">Cidade:</label>
                    <div class="controls">
                      <input type="text" class="form-control" name="cidade" value="<?php echo @$dado['cidade']; ?>" id="cidade" />
                    </div>
                  </div>
                </div>
                <div class="col-xs-3 col-sm-2 col-md-2 col-lg-2">
                  <div class="form-group">
                    <label class="control-label">Estado:</label>
                    <div class="controls">
                      <input type="text" class="form-control" name="estado" value="<?php echo @$dado['estado']; ?>" id="estado" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label">Resumo Profissional:</label>
                <div class="controls">
                  <textarea class="form-control input-block-level" name="descricao"><?php echo @$dado['descricao']; ?></textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    <?php ############################# FOTO ################################## ?>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="form-group">
          <label class="control-label">Enviar foto:</label>
          <?php if ($dado['foto']) {?>
          <input type="hidden" name="fotoCar" value="<?php echo @$dado['foto']; ?>" />
          <div class="well well-img">
            <a href="<?php echo content_url('uploads/fotocurriculo/' . @$dado['foto']); ?>" target="_blank" >
              <img src="<?php echo content_url('uploads/fotocurriculo/' . @$dado['foto']); ?>" width="100" />
            </a>
          </div>
          <?php }?>
          <div class="controls">
            <input type="file" name="foto" id="foto" style="margin-bottom:-15px;" ><br />
          </span>
        </div><br />
      </div>
    </div>
    <?php ############################# CURRÍCULO ################################## ?>
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
      <div class="form-group" >
        <label class="control-label">Enviar currículo:</label>
        <?php if ($dado['curriculo']) {?>
        <input type="hidden" name="curriculoCar" value="<?php echo @$dado['curriculo']; ?>" />
        <div class="well">
          <a href="<?php echo content_url('uploads/curriculos/' . $dado['curriculo']); ?>" target="_blank" > <?php echo @$dado['curriculo'] ?></a>
        </div>
        <?php }?>
        <div class="controls">
          <input type="hidden" name="curriculoCar" value="<?php echo @$dado['curriculo']; ?>" id="curriculoCar" style="margin-bottom:-15px;" ><br />
          <input type="file" name="curriculo" id="curriculo" style="margin-bottom:-15px;" ><br />
          <span id="msgFile">Não é permitido enviar arquivo com extensão
            <b><span id="ext"></span></b>. Extensões permitidas: <strong>pdf</strong>,
          <strong>doc</strong> e <strong>docx</strong>.</span>
        </div>
      </div>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($id_cadastro) {?>
    <button type="submit" name="cadastrar" id="cadastrar" class="btn btn-success tbCadastrarSite">Atualizar</button>
    <?php } else {?>
    <button type="submit" name="cadastrar" id="cadastrar" class="btn btn-success tbCadastrarSite">Cadastrar</button>
    <?php }?>
  </div>
</form>
</div>