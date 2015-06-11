<?php

require '../functions/registro.php';
require 'includes/valida-cpf.php';

$return_url = base64_decode($_SESSION["return_url"]);
        unset($_SESSION['return_url']);

if(isset($_POST)){
	if(valida_cpf($_POST['cpf'])){

		atualizaDadosCadastrais($_POST['nome'], $_POST['celular'],
			$_POST['telefone'],$_SESSION['cod_usuario']);

		$_SESSION['msg_sucesso'] = "Dados Alterados com Sucesso, Obrigado.";
		header('Location: index.php');
} else {
	$_SESSION['erros'] = "O CPF digitado é invalido, verifique e tente novamente";
	header('Location: '.$return_url);
}
}