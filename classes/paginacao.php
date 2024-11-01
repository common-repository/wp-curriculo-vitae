
<nav>
      <ul class="pagination pagination-sm justify-content-center">
<?php
$quant_pg = ceil($quantreg / $numreg);
$quant_pg++;

// $server = $_SERVER['SERVER_NAME'];
// $endereco = $_SERVER['REQUEST_URI'];
//$endereco = str_replace(strstr($endereco, '?'),"",$endereco) ;
// $uri = URI::base();

// var_dump($server);
// var_dump($endereco);
// var_dump($PHP_SELF);
// var_dump($uri);
// exit;

$pos = strpos($endereco, "?");

// $parametro = $server . $endereco;


if($pos === false){
$parametro = "?";
}else{
  $parametro = "&";
}


$page     = isset($_GET['page'])?"page=" . $_GET['page']:"";
$page_id  = isset($_GET['page_id'])?"page_id=" . $_GET['page_id']:"";
$pg       = isset($_GET['pg'])?$_GET['pg']:0;


if ($_GET['page']) {
	$parametro .= $page . "&";
}

if ($_GET['page_id']) {
	$parametro .= $page_id . "&";
}

if ($_GET['pg']) {
	$parametro .= $pg . "&";
}


$active = $i_pg2 == @$pg ? "class=\" disabled active \"" : "";

// Verifica se esta na primeira página, se nao estiver ele libera o link para anterior
if ($pg > 0) {

	echo "<li class='page-item'><a href='" . $PHP_SELF . @$parametro . "pg=" . ($pg - 1) . "'class='page-link pg'>&laquo; anterior</a></li>";
} else {
	echo "<li class=\"page-item disabled active\"><a class='page-link' href='#'>&laquo; anterior</a></li>";
}

// Faz aparecer os numeros das página entre o ANTERIOR e PROXIMO
for ($i_pg = 1; $i_pg < $quant_pg; $i_pg++) {
// Verifica se a página que o navegante esta e retira o link do número para identificar visualmente
	if ($pg == ($i_pg - 1)) {
    // $pg_last = $i_pg;
		echo "<li class=\"page-item disabled active\"><a class='page-link' href='#'>$i_pg</a></li>";
	} else {
		$i_pg2 = $i_pg - 1;
		echo "<li class='page-item'><a class='page-link' href=\" " . $PHP_SELF . @$parametro . "pg=$i_pg2 \">$i_pg</a></li>";
	}
}

// Verifica se esta na ultima página, se nao estiver ele libera o link para próxima
if (($pg + 2) < $quant_pg) {
	echo "<li class='page-item'><a class='page-link' href=" . $PHP_SELF . @$parametro . "pg=" . ($pg_last + 1) . ">próximo &raquo;</a></li>";
} else {
	echo "<li class=\"page-item disabled active\"><a class='page-link' href='#'>próximo &raquo;</a></li>";
}
?>
</ul>
    </nav>
