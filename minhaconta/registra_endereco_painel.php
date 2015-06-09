<?php
if(!isset($_SESSION))
{
  session_start();
}
header("Content-Type: text/html; charset=utf-8", true);
require '../functions/registro.php';
if(isset($_POST) && isset($_SESSION['id_usuario'])){

	insere_endereco($_POST['logradouro'],
					$_POST['numero'],
					$_POST['bairro'],
					$_POST['complemento'],
					$_POST['referencia'],
					$_POST['estado'],
					$_POST['cidade'],
					$_POST['cep'],
					$_SESSION['id_usuario']
					);
	$_SESSION['msg_sucesso'] = "Endereço Cadastrado com Sucesso.";
	header('Location: insere_enderecos.php');
} else {
	$_SESSION['erros'] = 'Erro ao inserir endereço';
	header('Location: index.php');
}