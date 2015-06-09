<?php
require '../functions/registro.php';
require 'includes/valida-cpf.php';

$valida = valida_cpf($_POST['cpf']);
if($valida == true){

if (isset($_POST["nome"]) && isset($_POST['cpf']) && isset($_POST['email'])
 && isset($_POST['usuario']) && isset($_POST['senha']) && isset($_POST['confirma_senha']))
 {
	registra_usuario($_POST['nome'],
                     $_POST['cpf'],
                     $_POST['email'],
                     $_POST['telefone'],
                     $_POST['celular'],
                     $_POST['usuario'],
                     $_POST['senha'],
                     $_POST['confirma_senha']
                    );

if($_POST['checkbox'] == 'on'){
    insere_subscribe($_POST['email']);
}

	$_SESSION['cep'] = $_POST['cep'];
}

if(isset($_SESSION['erros'])){
    deleta_usuario_invalido($_SESSION['id_usuario']);
    header('Location: cadastrar.php');
        } elseif(verificaCadastrado() == true) {
	       header('Location: cadastrar_enderecos.php');
            } else {
                header('Location: cadastrar.php');
}
} else {
    $_SESSION['erros'][] = "O CPF digitado é invalido, verifique e tente novamente.";
    header('Location: cadastrar.php');
}