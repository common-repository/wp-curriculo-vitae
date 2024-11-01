<?php

function removeMsg2($link){
	$return  = str_replace('&msg=1','', str_replace('&msg=2','', str_replace('&msg=3','', str_replace('&msg=4','', str_replace('&naoLogado=2','', str_replace('&logout=1','', str_replace('logout=1','', str_replace('naoLogado=2','', str_replace('&&','', $link)))))))));
	
	return $return;
}

?>