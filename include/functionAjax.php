<?php

#######################################################################################################
#Adicionando funções para executar scripts em AJAX

add_action('wp_ajax_wpcvp_checkCpf', 'wpcvp_checkCpf');
add_action('wp_ajax_nopriv_wpcvp_checkCpf', 'wpcvp_checkCpf');

add_action('wp_ajax_wpcvp_checkArea', 'wpcvp_checkArea');
add_action('wp_ajax_nopriv_wpcvp_checkArea', 'wpcvp_checkArea');

add_action('wp_ajax_wpcvp_carregar_cidade', 'wpcvp_carregar_cidade');
add_action('wp_ajax_nopriv_wpcvp_carregar_cidade', 'wpcvp_carregar_cidade');

add_action('wp_ajax_wpcvp_carregar_bairro', 'wpcvp_carregar_bairro');
add_action('wp_ajax_nopriv_wpcvp_carregar_bairro', 'wpcvp_carregar_bairro');

add_action('wp_ajax_wpcvp_verificarArquivo', 'wpcvp_verificarArquivo');
add_action('wp_ajax_nopriv_wpcvp_verificarArquivo', 'wpcvp_verificarArquivo');

add_action('wp_ajax_wpcvp_editArea', 'wpcvp_editArea');
add_action('wp_ajax_nopriv_wpcvp_editArea', 'wpcvp_editArea');

add_action('wp_ajax_wpcvp_lightBoxCurAdmin', 'wpcvp_lightBoxCurAdmin');
add_action('wp_ajax_nopriv_wpcvp_lightBoxCurAdmin', 'wpcvp_lightBoxCurAdmin');

add_action('wp_ajax_wpcvp_listCurriculoAdmin', 'wpcvp_listCurriculoAdmin');
add_action('wp_ajax_nopriv_wpcvp_listCurriculoAdmin', 'wpcvp_listCurriculoAdmin');

add_action('wp_ajax_wpcvp_autoCidade', 'wpcvp_autoCidade');
add_action('wp_ajax_nopriv_wpcvp_autoCidade', 'wpcvp_autoCidade');

add_action('wp_ajax_wpcvp_autoCidade', 'wpcvp_autoCidade');
add_action('wp_ajax_nopriv_wpcvp_autoCidade', 'wpcvp_autoCidade');

add_action('wp_ajax_wpcvp_autoBairro', 'wpcvp_autoBairro');
add_action('wp_ajax_nopriv_wpcvp_autoBairro', 'wpcvp_autoBairro');

add_action('wp_ajax_wpcvp_cadastro_curriculo', 'wpcvp_cadastro_curriculo');
add_action('wp_ajax_nopriv_wpcvp_cadastro_curriculo', 'wpcvp_cadastro_curriculo');

#######################################################################################################
#Funções dos scripts AJAX

function wpcvp_autoCidade() {
	global $wpdb;
	global $_POST;

	$cidade = strtolower($_POST['cidade']);

	$return = '';
	$sql = "SELECT cidade FROM " . BD_CURRICULO . " where lower(cidade) like '%" . $cidade . "%' group by cidade";
	$query = $wpdb->get_results($sql);
	foreach ($query as $key => $value) {
		$return .= '' . $value->cidade . '
         ,';
	}

	$return = substr($return, 0, strlen($return) - 1);

	echo $return;
}

function wpcvp_autoBairro() {
	global $wpdb;
	global $_POST;

	$bairro = strtolower($_POST['bairro']);

	$return = '';
	$sql = "SELECT bairro FROM " . BD_CURRICULO . " where lower(bairro) like '%" . $bairro . "%' group by bairro";
	$query = $wpdb->get_results($sql);
	foreach ($query as $key => $value) {
		$return .= '' . $value->bairro . '
         ,';
	}

	$return = substr($return, 0, strlen($return) - 1);

	echo $return;
}

function wpcvp_cadastro_curriculo() {
	global $wpdb;
	global $_POST;
}

// Cria o lightbox para mostrar as informações do currículo no admin
function wpcvp_lightBoxCurAdmin() {

	global $wpdb;
	global $wpcvp;
	global $_POST;

	$id = $_POST['id'];

	$sql = "SELECT a.*,
				   b.area

						FROM " . BD_CURRICULO . " a

			left join " . BD_AREA_SERVICOS . " b
					on a.id_area = b.id

			WHERE a.id = " . $id;

	$dados = $wpdb->get_row($sql, ARRAY_A);

	if ($dados['estado_civil'] == 1) {
		$civil = "Solteiro(a)";
	} elseif ($dados['estado_civil'] == 2) {
		$civil = "Viuvo(a)";
	} elseif ($dados['estado_civil'] == 3) {
		$civil = "Casado(a)";
	} elseif ($dados['estado_civil'] == 4) {
		$civil = "Divorciado(a)";
	} elseif ($dados['estado_civil'] == 5) {
		$civil = "Amigável";
	}

	$descrInte = '

        <h3><center>' . $dados['nome'] . '</center></h3>
        <strong>Dados Pessoais:</strong>
        <hr style="margin-top:0px; border-top: 1px solid #000;" />

        <p>
            <strong>Nome:</strong> ' . $dados['nome'] . '<br />
            <strong>Telefone:</strong> ' . $dados['telefone'] . '
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';

	if ($dados['celular']) {
		$descrInte .= '<strong>Celular:</strong> ' . $dados['celular'] . '<br />';
	}

	if ($dados['email']) {
		$descrInte .= '<strong>E-mail:</strong> ' . $dados['email'] . '<br />';
	}

	if ($dados['site_blog']) {
		$descrInte .= '<strong>Site/Blog:</strong> ' . $dados['site_blog'] . '<br />';
	}

	if ($dados['skype']) {
		$descrInte .= '<strong>Skype:</strong> ' . $dados['skype'] . '<br />';
	}

	if ($civil) {
		$descrInte .= '<strong>Estado cívil:</strong> ' . $civil . '
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	}

	if ($dados['idade']) {
		$descrInte .= '<strong>Idade:</strong> ' . $wpcvp->dataHora($dados['idade'], 6) . '<br />';
	}

	if ($dados['area']) {
		$descrInte .= '<strong>Área pretendida:</strong> ' . $dados['area'] . '<br />';
	}

	if ($dados['remunerecao']) {
		$descrInte .= '<strong>Remuneração:</strong> R$ ' . $dados['remunerecao'];
	}

	$descrInte .= '</p>

        <p>
            <strong>Endereço:</strong>
            ' . $dados['rua'] . ', ' . $dados['numero'] . '<br />
            ' . $dados['bairro'] . ' - ' . $dados['cidade'] . ' - ' . $dados['estado'] . '<br />
            <strong>CEP:</strong> ' . $dados['cep'] . '
        </p>';

	if ($dados['descricao']) {
		$descrInte .= '<p>
	        	<strong>Descrição:</strong><br/>
	            ' . $dados['descricao'] . '
	        </p>';
	}

	$descrInte .= '

        <a href="mailto:' . $dados['email'] . '" target="_blank">
            <img src="' . plugins_url('../img/email.png', __FILE__) . '" width="16" height="16" alt="' . $dados['email'] . '" /> ' . $dados['email'] . '
        </a><br />';
	if (isset($dados['curriculo']) && $dados['curriculo'] != '' && $dados['curriculo'] != null) {
		$descrInte .= '<a href="' . content_url('uploads/curriculos/' . $dados['curriculo']) . '" target="_blank" >Veja o currículo</a>
    ';
	}

	echo $descrInte;

}

// Cria a listagem dos currículos no admin
function wpcvp_listCurriculoAdmin() {
	echo "funcionou";
}

function wpcvp_checkCpf() {

	/*
		Função verifica se o número do CPF existe, se sim retorna um valor, se não volta zero.
	*/

	global $wpdb;
	global $_POST;

	$cpf = $_POST['cpf'];

	$sqlCheckCpf = "SELECT cpf FROM " . BD_CURRICULO . " where cpf = '" . $cpf . "'";
	$queryCheckCpf = $wpdb->get_results($sqlCheckCpf);
	$rowsCpf = $wpdb->num_rows;

	if ($rowsCpf > 0) {
		echo "achou";
	} else {
		echo $rowsCpf;
	}

}

function wpcvp_checkArea() {

	global $wpdb;
	global $_POST;

	$area = $_POST['area'];

	$sqlCheckArea = "SELECT area FROM " . $wpdb->prefix . "wls_areas where LCASE(area) = '" . strtolower($area) . "'";
	$queryCheckArea = $wpdb->get_results($sqlCheckArea);
	$rowsAreas = $wpdb->num_rows;

	if ($rowsAreas > 0) {
		echo "achou";
	} else {
		echo $rowsAreas;
	}
	//echo $rowsAreas;

}

function wpcvp_carregar_cidade() {

	/*
		Função que retorna uma listagem de cidades em cima do estado que está recebendo.
	*/

	global $wpdb;
	global $_POST;

	$estado = $_POST['estado'];

	$optionCidade = "";
	$optionCidade .= "<option value=\"\">Selecione a cidade</option>";

	$sqlCidade = "SELECT cidade FROM " . BD_CURRICULO . " where 1=1 and estado = '" . $estado . "' group by cidade";
	$queryCidade = $wpdb->get_results($sqlCidade);
	foreach ($queryCidade as $kC => $vC) {
		$optionCidade .= "<option value=\"" . $vC->cidade . "\">" . $vC->cidade . "</option>";
	}

	echo $optionCidade;

}

function wpcvp_carregar_bairro() {

	/*
		Função que retorna uma listagem de bairro em cima da cidade que está recebendo.
	*/

	global $wpdb;
	global $_POST;

	$estado = $_POST['estado'];
	$cidade = $_POST['cidade'];

	$optionBairro = "";
	$optionBairro .= "<option value=\"\">Selecione o bairro</option>";

	$sqlBairro = "SELECT bairro FROM " . BD_CURRICULO . " where 1=1 and estado = '" . $estado . "' and cidade = '" . $cidade . "' group by bairro";
	$queryBairro = $wpdb->get_results($sqlBairro);
	foreach ($queryBairro as $kB => $vB) {
		$optionBairro .= "<option value=\"" . $vB->bairro . "\">" . $vB->bairro . "</option>";
	}

	echo $optionBairro;

}

function wpcvp_verificarArquivo() {

	/*
		Função que verifica se arquivo do registro existe.
	*/

	global $wpdb;
	global $_POST;

	$arquivo = $_POST['arquivo'];

	$array = explode("\\", $arquivo);
	$ext = explode(".", $array[count($array) - 1]);

	#print_r($array);
	echo $ext[count($ext) - 1];

}

function wpcvp_editArea() {

	/*
		Função que faz a edição do nome do registro.
		Quando clicado no nome do registro irá aparecer o nome dentro de um input,
		com a possibilidade de redigitar o nome, e quando clicado na imagem de ok,
		será atualizado em banco.
	*/

	global $wpdb;
	global $_POST;

	$id = $_POST['rel'];
	$texto = $_POST['texto'];

	$var = array('area' => $texto);

	// Guardar os valores na tabela
	$qry = $wpdb->update(BD_AREA_SERVICOS, $var, array('id' => $id), $format = null, $where_format = null);

	if ($qry == false && $qry != 0) {

		$wpdb->show_errors();

		$wpdb->print_error();

		exit;

	} else {
		echo 1;
		echo $id;
		echo $texto;
	}

}

?>