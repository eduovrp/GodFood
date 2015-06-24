<?php

require '../functions/registro.php';

$return_url = base64_decode($_SESSION["return_url"]);
        unset($_SESSION['return_url']);

if(isset($_POST)){

		if(strlen($_POST['senha']) >= 1 && strlen($_POST['senha']) < 6 
			|| strlen($_POST['confirma_senha']) >= 1 && strlen($_POST['confirma_senha']) < 6){

			$_SESSION['mensagem'] = "A senha precisa ter 6 ou mais caracteres";
			header('Location: alterarDadosCadastrais.php');

		} elseif(strlen($_POST['senha']) >= 6 && strlen($_POST['confirma_senha']) >= 6){
			
			if($_POST['senha'] != $_POST['confirma_senha']){
				$_SESSION['erros'] = "As senhas não conferem, verifique";
				header('Location: alterarDadosCadastrais.php');
			} else{
			alteraSenhaUsuario($_POST['senha'], $_SESSION['cod_usuario']);
			atualizaDadosCadastrais($_POST['nome'], $_POST['celular'],
			$_POST['telefone'],$_SESSION['cod_usuario']);
			$_SESSION['msg_sucesso'] = "Dados cadastrais alterados com sucesso! <br> Senha alterada com sucesso!";
			header('Location: ../minhaconta/');
		}
	} elseif(strlen($_POST['senha']) < 1 && strlen($_POST['confirma_senha'] < 1)){
		atualizaDadosCadastrais($_POST['nome'], $_POST['celular'],
		$_POST['telefone'],$_SESSION['cod_usuario']);
		$_SESSION['msg_sucesso'] = "Dados Alterados com Sucesso, Obrigado.";
		header('Location: ../minhaconta/');
	} else{
		$_SESSION['erros'] = "Ocorreu algum erro que eu não faço ideia do que seja, desculpa.";
		header('Location: alterarDadosCadastrais.php');
	}

}