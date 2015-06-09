<?php
require 'functions/timeline.php';
date_default_timezone_set('America/Sao_Paulo');
if($_POST){
	if($_POST['confirmaPedido']){
	atualizaPedidoRecebido($_POST['idPedido']);
		header('Location: timeline.php');
	}
	if($_POST['confirmaPreparo']){
		atualizaPedidoParaEntrega($_POST['idPedido']);
		header('Location: timeline.php');
	}
	if($_POST['confirmaEntrega']){
	atualizaPedidoSucesso($_POST['idPedido']);
		header('Location: timeline.php');
	}
var_dump($_POST);
} else{
		header('Location: index.php');
	}