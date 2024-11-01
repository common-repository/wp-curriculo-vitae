
    <div class="container-fluid">

     <form id="wp-curriculo-cadastro" name="wp-curriculo-cadastro" method="post" enctype="multipart/form-data">
        <input type="hidden" name="tipoF" value="site" />

        <?php if (@$_SESSION['logado'] == 1 || @$dados['id']) {?>

            <input type="hidden" name="mod" value="edit" />
            <input type="hidden" name="id_cadastro" value="<?php echo @$dados['id']; ?>" />

        <?php } else {?>

          <input type="hidden" name="mod" value="new" />
          <input type="hidden" name="excluirConta" value="0" />

        <?php }?>

    <div class="tab-content pt-3" id="myTabContent">

        <div id="dadosPessoais" role="tabpanel" >
            <h4><b>Dados pessoais:</b></h4>
            <div>
            <div class="row">
              <div class="col-12 col-md-8">
                <div class="form-group">
                  <label>Nome:</label>
                  <input type="text" name="nome" id="nome" class="form-control form-control-sm" value="<?php echo $dados['nome'] ?>" />

                </div>
              </div>
                <div class="col-12 col-md-4">
                	  <div class="form-group">
                      <label>Sexo: </label>
                      <select class="form-control form-control-sm" name="sexo">
                        <option></option>
                        <option value="0" 	<?php echo $dados['sexo'] == "0" ? "selected" : "" ?> >Feminino</option>
                        <option value="1" 	<?php echo $dados['sexo'] == "1" ? "selected" : "" ?> >Masculino</option>
                      </select>
                    </div>
                </div>
                <div class="w-100"></div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                      <label>Estado civil:</label>
                      <select name="estado_civil" class="form-control form-control-sm">
                          <option value="0"></option>
                          <option value="1" <?php echo @$dados['estado_civil'] == "1" ? "selected" : ""; ?>>Solteiro(a)</option>
                          <option value="2" <?php echo @$dados['estado_civil'] == "2" ? "selected" : ""; ?>>Viuvo(a)</option>
                          <option value="3" <?php echo @$dados['estado_civil'] == "3" ? "selected" : ""; ?>>Casado(a)</option>
                          <option value="4" <?php echo @$dados['estado_civil'] == "4" ? "selected" : ""; ?>>Divorciado(a)</option>
                          <option value="5" <?php echo @$dados['estado_civil'] == "5" ? "selected" : ""; ?>>Amigável</option>
                      </select>

                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                      <label>Data de nascimento:</label>
                      <input type="date" name="idade" value="<?php echo @$dados['idade'] ?>" class="form-control form-control-sm" />

                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="form-group">
                      <label>Telefone:</label>
                      <input type="tel" name="telefone" value="<?php echo @$dados['telefone'] ?>" class="form-control form-control-sm telefone" />

                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                      <label>Celular:</label>
                      <input type="tel" name="celular" value="<?php echo @$dados['celular'] ?>" class="form-control form-control-sm telefone" />
                    </div>
                </div>

              <div class="col-12 col-md-4">
                <div class="form-group">
                  <label>Email:</label>
                  <input type="email" name="email" value="<?php echo @$dados['email'] ?>" class="form-control form-control-sm">
                </div>
              </div>
              <div class="col-12 col-md-4">
                <div class="form-group">
                  <label>Skype:</label>
                  <input type="text" name="skype" value="<?php echo @$dados['skype'] ?>" class="form-control form-control-sm">
                </div>
              </div>

              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <div class="form-group">
                  <label>Site/blog:</label>
                  <input type="url" name="site_blog" value="<?php echo @$dados['site_blog'] ?>" class="form-control form-control-sm">
                </div>
              </div>
            <div class="w-100"></div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                      <?php

$sqlArea = "SELECT * FROM " . BD_AREA_SERVICOS . " where 1=1 group by area";
$queryArea = $wpdb->get_results($sqlArea);
?>
                      <label>Cargo Pretendido:</label>

                        <select name="id_area" class="form-control form-control-sm" id="id_area">
                          <option value="0">Selecione um cargo</option>
                          <?php foreach ($queryArea as $k => $v) {?>
                              <option value="<?php echo $v->id ?>" <?php echo @$dados['id_area'] == $v->id ? "selected" : ""; ?> ><?php echo $v->area ?></option>
                          <?php }?>
                          <?php if ($dadosOp['new_area_ex'] == "1") {?>
                        <option value="outro">Outro</option>
                        <?php }?>
                        </select>

                    </div>
                </div>
                <div class="col-12 col-md-6">

                    <div class="input-group input-group-sm" id="campoArea" style="display:none;" >
                      <label for="area">Escreva seu cargo:</label>
                      <div class="w-100"></div>
                      <input type="text" class="form-control" name="area" id="area" />
                    </div>

                </div>
<div class="w-100"></div>
              <div class="col-12 col-md-4">

                <div class="form-group">
                  <label>Pretenção Salarial:</label>
                  <input type="text" name="remuneracao" value="<?php echo @$dados['remuneracao'] ?>" class="form-control form-control-sm">

                </div>
              </div>

                <div class="col-12 col-md-4">
                    <div class="form-group">
                      <label>Login:</label>
                      <input type="text" name="login" value="<?php echo @$dados['login'] ?>" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <div class="form-group">
                      <label>Senha:</label>
                      <input type="password" name="senha" value="" class="form-control form-control-sm">
                    </div>
                </div>

                <div class="col-12 col-md-4">
                  <div class="input-group input-group-sm">
                    <label for="wpcvpcpf">CPF</label>
                    <div class="w-100"></div>
                    <input type="text" class="form-control" name="cpf" id="wpcvpcpf" value="<?php echo @$dados['cpf'] ?>">
                  </div>
                </div>
                <div class="col-12 col-md-4">
                  <div class="form-group">
                    <label>CEP:</label>
                    <input type="text" name="cep" value="<?php echo @$dados['cep'] ?>" class="form-control form-control-sm" id="wpcvpcep" />
                  </div>
                </div>


                <div class="col-12 col-md-10">
                    <div class="form-group">
                    <label>Endereço:</label>
                    <input type="text" name="rua" id="rua" value="<?php echo @$dados['rua'] ?>" class="form-control form-control-sm" />
                  </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group">
                      <label>Nº:</label>
                      <input type="text" name="numero" id="numero" value="<?php echo @$dados['numero'] ?>" class="form-control form-control-sm" />
                    </div>
                </div>

              <div class="col-12">

                <div class="form-group">
                  <label>Bairro:</label>
                  <input type="text" name="bairro" id="bairro" value="<?php echo @$dados['bairro'] ?>" class="form-control form-control-sm" />
                </div>
              </div>

                <div class="col-12 col-md-10">
                    <div class="form-group cidade">
                      <label>Cidade:</label>
                        <input type="text" name="cidade" id="wpcvpcidade" value="<?php echo @$dados['cidade'] ?>" class="form-control form-control-sm" />
                    </div>
                </div>
                <div class="col-12 col-md-2">
                    <div class="form-group estado">
                      <label>Estado:</label>
                      <input type="text" name="estado" id="estado" value="<?php echo @$dados['estado'] ?>" class="form-control form-control-sm" />
                    </div>
                </div>

              <div class="col-12">
                <div class="form-group">
                  <label>Resumo Profissional:</label>
                  <textarea class="form-control form-control-sm" name="descricao" rows="5"><?php echo @$dados['descricao'] ?></textarea>
                </div>
              </div>
              <div class="col-12 col-md-2">
                <div class="card mt-2 pt-2 pr-2 pb-2 pl-2">
                    <?php if ($dados['foto']) {?>
                        <input type="hidden" name="fotoCar" value="<?php echo @$dados['foto']; ?>" />
                        <img src="<?php echo content_url('uploads/fotocurriculo/' . @$dados['foto']); ?>" width="100" />
                    <?php } else {?>
                        <img id="fotoCurriculo" src="<?php echo plugins_url('img/sem-foto.png', __FILE__) ?>" width="100" />
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

            <?php if ($dados['curriculo']) {?>

                <div class="col-12 mt-3">
                  <input type="hidden" name="curriculoCar" value="<?php echo @$dados['curriculo']; ?>" />
                  <div class="container-fluid">
                      <label class="control-label">Arquivo já salvo:</label>
                      <div class="well">
                          <a href="<?php echo content_url('uploads/curriculos/' . @$dados['curriculo']); ?>" target="_blank" > <?php echo @$_SESSION['curriculo'] ?></a>
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

            </div>
            <div class="clearfix"></div>
        </div>

    <?php if ($id_cadastro) {?>
    <button type="submit" id="cadastrar" name="cadastrar" class="btn btn-success tbCadastrarSite float-left mt-3">
      <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Atualizar</button>
    <?php } else {?>
    <button type="submit" id="cadastrar" name="cadastrar" class="btn btn-success tbCadastrarSite float-left mt-3">
      <span class="glyphicon glyphicon-floppy-disk" aria-hidden="true"></span> Cadastrar</button>
    <?php }?>

    </form>
  </div>
