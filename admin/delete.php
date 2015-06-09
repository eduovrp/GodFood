<?php
require 'functions/functions.php';

if($_POST){

	/* Exclui categoria */
	
	if(isset($_POST['excluir_categoria'])){

		if(isset($_SESSION['restaurante'])){
			$verifica = verifica_categoria($_POST['excluir_categoria'],$_SESSION['restaurante']);

				if($verifica != null ){
					exclui_categoria($_POST['excluir_categoria'],$_SESSION['restaurante']);
					header('Location: categorias.php');
				} else{
					$_SESSION['erros'] = "Essa categoria não pertence ao seu restaurante, por favor, pare de alterar o input type hidden";
					header('Location: categorias.php');
				}
			} else{
				$_SESSION['erros'] = "Restaurante não selecionado, por favor, selecione o restaurante";
				header('Location: restaurantes.php');
			}
	}

	var_dump($_POST);
	var_dump($_SESSION);

	/* Exclui Produto */
	
	if(isset($_POST['excluirProduto'])){
		$verifica = verificaProdutoVendido($_POST['id_produto']);

		if($verifica == true){
			$_SESSION['erros'] = "Você não pode excluir um produto que ja foi vendido, desculpe.";
			header('Location: produtos.php');
		} else {
			excluiProduto($_POST['id_produto'],$_SESSION['restaurante']);
			$_SESSION['msg_sucesso'] = "Produto excluido com sucesso";
			header('Location: produtos.php');
		}
	}

}