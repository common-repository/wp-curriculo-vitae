<?php

include('../../../wp-config.php');

// conecta ao banco de dados
$con = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or trigger_error(mysqli_error(),E_USER_ERROR);
// seleciona a base de dados em que vamos trabalhar
mysqli_select_db($con, DB_NAME);

$wls_curriculo_options 	= $table_prefix . 'wls_curriculo_options';

$sql = "SELECT * FROM ".$wls_curriculo_options." where id=1";

header("Content-type: text/css");

$query = mysqli_query($con,$sql) or die(mysql_error());
//if(isset($query) && $query != ''){
while($dados = mysqli_fetch_assoc($query)){
  echo $dados['css'];
}
//}
?>
