<?php
header("Content-Type: text/html; charset=utf-8", true);
require 'functions/registro.php';
if ($_POST['email'])
{
		insere_subscribe($_POST['email']);
			header("Location: index.php");
} else {
	header("Location: index.php");
}

?>