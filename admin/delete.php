<?php
require 'functions/functions.php';

	/* Exclui categoria */
	
	if(isset($_POST['excluir_categoria'])){

		if(isset($_SESSION['restaurante'])){
			$verifica = verifica_categoria($_POST['excluir_categoria'],$_SESSION['restaurante']);

				if($verifica != null ){
					exclui_categoria($_POST['excluir_categoria'],$_SESSION['restaurante']);
					header('Location: ./categorias');
				} else{
					$_SESSION['erros'] = "Essa categoria não pertence ao seu restaurante, por favor, pare de alterar o input type hidden";
					header('Location: ./categorias');
				}
			} else{
				$_SESSION['erros'] = "Restaurante não selecionado, por favor, selecione o restaurante";
				header('Location: ./restaurantes');
			}
	}

	/* Exclui Produto */
	
	if(isset($_POST['excluirProduto'])){
		$verifica = verificaProdutoVendido($_POST['id_produto']);

		if($verifica == true){
			$_SESSION['erros'] = "Você não pode excluir um produto que ja foi vendido, desculpe.";
			header('Location: ./gerenciar/produtos');
		} else {
			excluiProduto($_POST['id_produto'],$_SESSION['restaurante']);
			$_SESSION['msg_sucesso'] = "Produto excluido com sucesso";
			header('Location: ./gerenciar/produtos');
		}
	}


	 	/* Deleta Cidade */
	 	
	 	if(isset($_GET['id_cidade'])){
	 		if($_SESSION['id_nivel'] == 5){
	 			deletaCidadeEntrega($_GET['id_cidade']);
	 			$_SESSION['msg_sucesso'] = "Cidade excluida com sucesso";
	 			header('Location: ./cadastrar-cidade');
	 		} else {
	 			$_SESSION['mensagem'] = "Você não tem permissão para acessar essa pagina!";
	 			header('Location: ./');
	 		}
	 	}