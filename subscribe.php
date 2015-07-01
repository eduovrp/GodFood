<?php
header("Content-Type: text/html; charset=utf-8", true);
require 'functions/account.php';

if(isset($_SESSION['return_url'])){

    $return_url = base64_decode($_SESSION["return_url"]);
    unset($_SESSION['return_url']);

}else{
    $return_url = "https://www.godfood.com.br";
}

if ($_POST['email'])
{
		insere_subscribe($_POST['email']);
		echo ("<SCRIPT LANGUAGE='JavaScript'>
	    window.alert('E-mail cadastrado com sucesso, não se preocupe, a gente só vai mandar coisas legais o/')
	    window.location.href='".$return_url."';
	    </SCRIPT>");
} else {
	echo ("<SCRIPT LANGUAGE='JavaScript'>
	    window.alert('Ocorreu um erro por aqui, desculpe pelo incoveniente')
	    window.location.href='".$return_url."';
	    </SCRIPT>");
}

?>