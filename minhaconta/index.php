<?php
header("Content-Type: text/html; charset=utf-8", true);
require 'classes/Login.php';

if(!isset($login)){
$login = new Login();
}

// ... verifica se o usuario está logado
if ($login->usuarioLogado() == true) {
	include 'views/logado.php';
} else {
    include 'views/login.php';
}

