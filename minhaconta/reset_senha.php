<?php

require '../functions/registro.php';

if(isset($_POST['email'])){
	enviaEmailResetSenha($_POST['email']);
	$_SESSION['msg_sucesso'] = "Quase lá, verifique seu e-mail para recuperar sua senha.";
	header('Location: index.php');
}

if(isset($_SESSION['verification_code']) && isset($_SESSION['email']) && isset($_POST['senha'])){
	verificaResetSenha($_SESSION['email'],$_SESSION['verification_code'],
						$_POST['senha'],$_POST['confirma_senha']);

if(isset($_SESSION['erros'])){
		header('Location: reset_pass.php?email='.$_SESSION['email'].'&verification_code='.$_SESSION['verification_code']);
	} else {
	unset($_SESSION['email']);
	unset($_SESSION['verification_code']);
	header('Location: index.php');
	}
}