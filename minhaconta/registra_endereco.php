<?php
if(!isset($_SESSION))
{
  session_start();
}
header("Content-Type: text/html; charset=utf-8", true);

if(isset($_SESSION['return_url'])){

    $return_url = base64_decode($_SESSION["return_url"]);
    unset($_SESSION['return_url']);

}else{
    $return_url = "../minhaconta/";
}

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
	$_SESSION['msg_sucesso'] = "Endereço cadastrado com sucesso.";
	header('Location: '.$return_url);
} else {
	$_SESSION['erros'] = 'Erro ao inserir endereço';
	header('Location: '.$return_url);
}