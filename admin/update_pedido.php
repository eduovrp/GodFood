<?php
require 'functions/timeline.php';
date_default_timezone_set('America/Sao_Paulo');
if($_POST){
	if($_POST['confirmaPedido']){
	atualizaPedidoRecebido($_POST['idPedido']);
		header('Location: ./pedidos');
	}
	if($_POST['confirmaPreparo']){
		atualizaPedidoParaEntrega($_POST['idPedido']);
		header('Location: ./pedidos');
	}
	if($_POST['confirmaEntrega']){
	atualizaPedidoSucesso($_POST['idPedido']);
		header('Location: ./pedidos');
	}
} else{
		header('Location: ./');
	}