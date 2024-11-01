<?php

class WpWls {

	public $id;
	public $table;
	public $link;
	public $tipo;
	public $qtde;

	static $subTables;

	public function deleteTable($id, $table = "", $subTables = array()) {
		global $wpdb;

		/*print "<pre>";
			print_r($subTables);
			print "</pre>";
			echo count($subTables);
		*/

		$proto = strtolower(preg_replace('/[^a-zA-Z]/', '', $_SERVER['SERVER_PROTOCOL'])); //pegando só o que for letra
		$location = $proto . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

		$array_url = explode("&", $location);

		$path = $this->removeMsg($location) . '&msg=3';

		$path = $array_url[0];

		foreach ($id as $regExcl) {

			$deleteTable = "DELETE FROM " . $table . " WHERE id = " . $regExcl . " ";
			$wpdb->query($deleteTable);

			for ($i = 0; $i < count($subTables); $i++) {
				$deleteSub = "DELETE FROM " . $subTables[$i] . " WHERE id_cadastro = " . $regExcl . " ";
				$wpdb->query($deleteSub);
			}

		}
		$msg = '&msg=3';
		echo "<script>location.href='" . $path . "" . $msg . "'</script>";
	}

	public function deleteSub($id, $table = "") {
		global $wpdb;

		$proto = strtolower(preg_replace('/[^a-zA-Z]/', '', $_SERVER['SERVER_PROTOCOL'])); //pegando só o que for letra
		$location = $proto . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

		$array_url = explode("&", $location);

		$path = $this->removeMsg($location) . '&msg=3';

		$path = $array_url[0];

		foreach ($id as $regExcl) {

		}

		echo "<script>location.href='" . $path . "" . $msg . "'</script>";

	}

	public function removeMsg($link) {
		$return = str_replace('&msg=1', '', str_replace('&msg=2', '', str_replace('&msg=3', '', str_replace('&msg=4', '', $link))));
		return $return;
	}

	public function dataHora($dataHora, $tipo) {
		/*
			tipo = 1 igual dia/mês/ano às hora:min:seg
			tipo = 2 igual dia/mês/ano
			tipo = 3 igual hora:min:seg
			tipo = 4 igual dia/mês/ano às hora:min
		*/

		$array = explode(" ", $dataHora);

		if (strpos($array[0], "") > 0) {

			//if ($tipo == 5 || $tipo == 6) {

			$dataArray = explode("/", $array[0]);

			$ano = (int) $dataArray[2];
			$mes = (int) $dataArray[1];
			$dia = (int) $dataArray[0];

		}
		if (strpos($array[0], "-") > 0) {

			$dataArray = explode("-", $array[0]);

			$ano = (int) $dataArray[0];
			$mes = (int) $dataArray[1];
			$dia = (int) $dataArray[2];

		}

		$horaArray = explode(":", $array[1]);

		$hora = (int) $horaArray[0];
		$min = (int) $horaArray[1];
		$seg = (int) $horaArray[2];

		$anoAtual = date("Y");

		switch ($tipo) {
		case 1:{

				$data = $dia . "/" . $mes . "/" . $ano;
				$horario = $hora . ":" . $min;

				$return = $data . " &agrave;s " . $horario . " hrs";

				break;
			}
		case 2:{

				$data = $dia . "/" . $mes . "/" . $ano;
				$return = $data;

				break;
			}
		case 3:{

				$horario = $hora . ":" . $min . " hrs";
				$return = $data . " &agrave;s " . $horario;

				break;
			}
		case 4:{

				$data = $dia . "/" . $mes . "/" . str_replace("20", "", $ano);
				$horario = $hora . ":" . $min;

				$return = $data . "<br/>" . $horario . " hrs";

				break;
			}
		case 5:{

				$data = $ano . "-" . $mes . "-" . $dia;
				$return = $data;
				break;
			}
		case 6:{

				$data = (int) $anoAtual - (int) $ano;
				$return = $data;
				break;
			}
		default:{

				$return = $dataHora;

				break;
			}
		}

		return $return;
	}

	public function zerarEdit($table, $id_cadastro) {

		global $wpdb;

		$sql = "SELECT * FROM " . $table . " where id_cadastro = '" . $id_cadastro . "'";
		$query = $wpdb->get_results($sql);

		foreach ($query as $k => $v) {
			$var = array(
				'edit' => 0,

			);

			$wpdb->update($table, $var, array('id' => @$v->id), $format = null, $where_format = null);
		}

	}

	public function deletarZero($table, $id_cadastro) {

		global $wpdb;
		$iT = 0;

		for ($iT == 0; $iT < count($table); $iT++) {

			$sqlCT = "SELECT * FROM " . $table[$iT] . " where id_cadastro = '" . $id_cadastro . "' and edit = 0";
			$queryCT = $wpdb->get_results($sqlCT);

			foreach ($queryCT as $kCT => $vCT) {
				$wpdb->get_row("DELETE FROM " . $table[$iT] . " WHERE edit = 0", ARRAY_A);
				#$wpdb->query( $wpdb->prepare( "DELETE FROM ".$tabela." WHERE edit = %d" , array('edit' => 0) ) );
			}

		}

	}

	public function selectWP($tabela, $where = "1=1") {
		global $wpdb;

		$sql = "SELECT * FROM " . $tabela . " where 1=1 $where";

		$query = $wpdb->get_results($sql);
		$rows = $wpdb->num_rows;
		return $rows;

	}

	public function trimm($str) {
		$str = preg_replace('/[áàãâä]/ui', 'a', $str);
		$str = preg_replace('/[éèêë]/ui', 'e', $str);
		$str = preg_replace('/[íìîï]/ui', 'i', $str);
		$str = preg_replace('/[óòõôö]/ui', 'o', $str);
		$str = preg_replace('/[úùûü]/ui', 'u', $str);
		$str = preg_replace('/[ç]/ui', 'c', $str);
		// $str = preg_replace('/[,(),;:|!"#$%&/=?~^><ªº-]/', '_', $str);
		$str = preg_replace('/[^a-z0-9]/i', '_', $str);
		$str = preg_replace('/_+/', '_', $str); // ideia do Bacco :)
		return $str;
	}

}

?>