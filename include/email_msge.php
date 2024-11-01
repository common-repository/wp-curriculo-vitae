<?php

// Variáveis aceito pelo pelo plugin para envio de email.

$msge = str_replace('@login', $dadosCurriculo['login'], $msge);
$msge = str_replace('@senha', $dadosCurriculo['senha'], $msge);
$msge = str_replace('@nome', $dadosCurriculo['nome'], $msge);
$msge = str_replace('@email', $dadosCurriculo['email'], $msge);
$msge = str_replace('@cpf', $dadosCurriculo['cpf'], $msge);
$msge = str_replace('@cep', $dadosCurriculo['cep'], $msge);
$msge = str_replace('@rua', $dadosCurriculo['rua'], $msge);
$msge = str_replace('@bairro', $dadosCurriculo['bairro'], $msge);
$msge = str_replace('@cidade', $dadosCurriculo['cidade'], $msge);
$msge = str_replace('@estado', $dadosCurriculo['estado'], $msge);
$msge = str_replace('@numero', $dadosCurriculo['numero'], $msge);
$msge = str_replace('@telefone', $dadosCurriculo['telefone'], $msge);
$msge = str_replace('@celular', $dadosCurriculo['celular'], $msge);
$msge = str_replace('@site_blog', $dadosCurriculo['site_blog'], $msge);
$msge = str_replace('@skype', $dadosCurriculo['skype'], $msge);


?>
