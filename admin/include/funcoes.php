<?php


function delete_wpcvp($id, $tabela=""){
	
	global $wpdb;
	
	$proto = strtolower(preg_replace('/[^a-zA-Z]/','',$_SERVER['SERVER_PROTOCOL'])); //pegando só o que for letra 
	$location = $proto.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	
	$array_url = explode("&", $location);

	$path = removemsg_wpcvp($location).'&msg=3';
	
	$path = $array_url[0];
	
	#$delete = "DELETE FROM ".$tabela. " WHERE id = ".$id." ";
	
	$wpdb->query("DELETE FROM ".$tabela. " WHERE id = ".$id." ");

	echo "<script>location.href='".$path."'</script>";
}

function deleteSub($id, $tabela=""){
	
	global $wpdb;
	
	$proto = strtolower(preg_replace('/[^a-zA-Z]/','',$_SERVER['SERVER_PROTOCOL'])); //pegando só o que for letra 
	$location = $proto.'://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	
	$array_url = explode("&", $location);

	$path = removemsg_wpcvp($location).'&msg=3';
	
	$path = $array_url[0];
	
	$delete = "DELETE FROM ".$tabela. " WHERE id_cadastro = ".$id." ";
	
	$wpdb->query($delete);
	
}

function removemsg_wpcvp($link){
	$return  = str_replace('&msg=1','', str_replace('&msg=2','', str_replace('&msg=3','', str_replace('&msg=4','', str_replace('&naoLogado=2','', str_replace('&logout=1','', str_replace('logout=1','', str_replace('naoLogado=2','', str_replace('&&','', $link)))))))));
	
	return $return;
}

function datahora_wpcvp($dataHora, $tipo){
	/*
		tipo = 1 igual dia/mês/ano às hora:min:seg
		tipo = 2 igual dia/mês/ano
		tipo = 3 igual hora:min:seg
		tipo = 4 igual dia/mês/ano às hora:min
	*/
	
	$array = explode(" ", $dataHora);
	
	
	
	if($tipo==5 || $tipo==6){
		
		$dataArray = explode("/", $array[0]);
		
		$ano = $dataArray[2];
		$mes = $dataArray[1];
		$dia = $dataArray[0];
		
	}else{
		
		$dataArray = explode("-", $array[0]);
		
		$ano = $dataArray[0];
		$mes = $dataArray[1];
		$dia = $dataArray[2];
		
	}
	
	$horaArray = explode(":", $array[1]);
	
	$hora 	= $horaArray[0];
	$min 	= $horaArray[1];
	$seg 	= $horaArray[2];
	
	$diaAtual = date("d");
	$mesAtual = date("m");
	$anoAtual = date("Y");
	
	switch($tipo){
		case 1:{
			
			$data = $dia . "/" . $mes . "/" . $ano;
			$horario = $hora . ":"  . $min;
			
			$return = $data . " &agrave;s "  . $horario . " hrs";
			
			break;
		}
		case 2:{
			
			$data = $dia . "/" . $mes . "/" . $ano;
			$return = $data;
			
			break;
		}
		case 3:{
			
			$horario = $hora . ":"  . $min . " hrs";
			$return = $data . " &agrave;s "  . $horario;
			
			break;
		}
		case 4:{
			
			$data = $dia . "/" . $mes . "/" . str_replace("20", "", $ano);
			$horario = $hora . ":"  . $min;
			
			$return = $data . "<br/>"  . $horario . " hrs";
			
			break;
		}
		case 5:{
			
			$data = $ano . "-" . $mes . "-" . $dia;
			$return = $data;
			break;
		}
		case 6:{
			
			if($mesAtual >= $mes){
				if($diaAtual >= $dia){
					$data = $anoAtual - $ano;
				}else{
					$data = ($anoAtual - $ano) - 1;
				}
			}else{
				$data = ($anoAtual - $ano) - 1;
			}
			
			
			
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

function zerarEdit($tabela, $id){
	
	global $wpdb;
	$qtde = count($id);
	
	for($i=0;$i<$qtde;$i++){
	
		$sql 	= "SELECT * FROM ".$tabela." where id = ".$id[$i]."";
		$query 	= $wpdb->get_results( $sql );
		
		foreach($query as $k => $v){			
			  $dados = $v;
		
		
			  if($dados->edit){
				  $var = array(
					  'edit' 	=> 0,
							
				  );
			  }
			  
			  $wpdb->update( $tabela, $var, array('id' => @$v->id), $format = null, $where_format = null );
		}		
		
	}
	
	$sql 	= "SELECT * FROM ".$tabela." where edit = 1";
	$query 	= $wpdb->get_results( $sql );
	
	foreach($query as $k => $v){
		$wpdb->query( $wpdb->prepare( "DELETE FROM ".$tabela." WHERE id = %d" , array('edit' => $v->id) ) );
	}
	
	$sql 	= "SELECT * FROM ".$tabela." where 1=1";
	$query 	= $wpdb->get_results( $sql );
	
	foreach($query as $k => $v){
		
		$var = array(
			'edit' 	=> 0,
				  
		);

		$wpdb->update( $tabela, $var, array('id' => @$v->id), $format = null, $where_format = null );
	}
	
}

function deletarZero($tabela, $qtde){
	
	global $wpdb;
	
	for ($i=0; $i<$qtde; $i++) { 

		$wpdb->query( $wpdb->prepare( "DELETE FROM ".$tabela." WHERE edit = %d" , array('edit' => 0) ) );
		
	}
}

?>