<?php
header("Content-Type: text/html; charset=utf-8", true);

require 'config.php';

require '../minhaconta/classes/Login.php';

$login = new Login();

// ... verifica se o usuario está logado
if ($login->usuarioLogado() == true) {
	include 'views/resumo.php';
} else {
    include 'views/login.php';
}
?>
