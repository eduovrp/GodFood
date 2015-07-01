<?php
header("Content-Type: text/html; charset=utf-8", true);

require 'config.php';

require '../minhaconta/classes/Login.php';

$login = new Login();
	$current_url = base64_encode($url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	$_SESSION['return_url'] = $current_url;
	
// ... verifica se o usuario está logado
if ($login->usuarioLogado() == true) {
	include 'views/resumo.php';
} else {
    include 'views/login.php';
}
?>
