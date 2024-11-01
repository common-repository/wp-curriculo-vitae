<?php

$subject = str_replace('@login', $dadosCurriculo['login'], $subject);
$subject = str_replace('@senha', $dadosCurriculo['senha'], $subject);
$subject = str_replace('@nome', $dadosCurriculo['nome'], $subject);
$subject = str_replace('@email', $dadosCurriculo['email'], $subject);
$subject = str_replace('@cpf', $dadosCurriculo['cpf'], $subject);
$subject = str_replace('@cep', $dadosCurriculo['cep'], $subject);
$subject = str_replace('@rua', $dadosCurriculo['rua'], $subject);
$subject = str_replace('@bairro', $dadosCurriculo['bairro'], $subject);
$subject = str_replace('@cidade', $dadosCurriculo['cidade'], $subject);
$subject = str_replace('@estado', $dadosCurriculo['estado'], $subject);
$subject = str_replace('@numero', $dadosCurriculo['numero'], $subject);
$subject = str_replace('@telefone', $dadosCurriculo['telefone'], $subject);
$subject = str_replace('@celular', $dadosCurriculo['celular'], $subject);
$subject = str_replace('@site_blog', $dadosCurriculo['site_blog'], $subject);
$subject = str_replace('@skype', $dadosCurriculo['skype'], $subject);

?>
