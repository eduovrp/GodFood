<?php
if(!isset($_SESSION))
{
  session_start();
}
require 'functions/functions.php';

if($_POST){

	/* Cadastra a Categoria */

	if(isset($_SESSION['restaurante']) && isset($_POST['nome_categoria'])) {

		if(isset($_POST['2sabores'])){
			if($_POST['2sabores'] == 1){
				$doisSabor = 'Sim';
			} else {
				$doisSabor = 'Não';
			}
		} else {
			$doisSabor = 'Não';
		}
		
		cadastra_categoria($_POST['nome_categoria'],$_SESSION['restaurante'],$doisSabor);
		$_SESSION['msg_sucesso'] = "Categoria cadastrada com sucesso";
		header('Location: ./categorias');
	}

	/* Cadastra Produto */

	if(isset($_POST['nome']) && isset($_POST['valor']) && isset($_POST['descricao'])) {
		if(isset($_SESSION['restaurante']) && isset($_POST['categoria'])){

			if($_POST['categoria'] > 0) {
				if(strlen($_POST['descricao']) < 5){
					$desc = '-';
				} else {
					$desc = $_POST['descricao'];
				}

			$_SESSION['categoria'] = $_POST['categoria'];
				$valor = str_replace(",",".", $_POST['valor']);
			 	cadastra_produto($_POST['nome'], $valor, $desc,
			 						 $_SESSION['restaurante'],$_POST['categoria'],$_POST['status']);

			 	$_SESSION['msg_sucesso'] = "Produto cadastrado com sucesso";
			 	header('Location: ./gerenciar/produtos');
			 	} else{
					$_SESSION['mensagem'] = "Categoria Não Selecionada, por favor, selecione a categoria";
	 				header('Location: ./gerenciar/produtos');
			 	}
	 		} else{
	 			$_SESSION['mensagem'] = "Categoria Não Selecionada, por favor, selecione a categoria";
	 			header('Location: ./restaurantes');
	 		}
	 	}

	/* Cadastra Cidade de Entrega */

	if(isset($_POST['cidade']) && isset($_POST['taxa'])){
		$taxa = str_replace(",",".", $_POST['taxa']);
		if(isset($_SESSION['restaurante'])){

		$verifica = verificaCidadeEntrega($_POST['cidade'],$_SESSION['restaurante']);

		if($verifica == false){
			$_SESSION['mensagem'] = "A cidade escolhida já está cadastrada.";
	 		header('Location: ./gerenciar/cidade-entrega');
		} else{

			cadastra_cidade_entrega($_POST['cidade'],$_SESSION['restaurante'], $taxa);
			$_SESSION['msg_sucesso'] = "Cidade cadastrada com sucesso";
			header('Location: ./gerenciar/cidade-entrega');
		}

		} else {
			$_SESSION['mensagem'] = "Restaurante Não Selecionado, por favor, selecione a restaurante desejado";
	 		header('Location: ./restaurantes');
	 	}
	}

	/* Cadastra Restaurante */
	
	if(isset($_POST['cadastrarRestaurante'])){
		$compra_min = str_replace(",",".", $_POST['compra_min']);
		cadastraRestaurante($_POST['razao'],
							$_POST['tipo'],
							$_POST['cnpj'],
							$_POST['fone'],
							$_POST['nome_fantasia'],
							$_POST['tempo_entrega'],
							$_POST['logradouro'],
							$_POST['numero'],
							$_POST['bairro'],
							$_POST['cidade'],
							$_POST['hora_abert'],
							$_POST['hora_fech'],
							$compra_min
							);
		$_SESSION['msg_sucesso'] = "Restaurante cadastrado com sucesso!";
		header('Location: ./gerenciar/restaurantes');
	}

	/* Cadastra Funcionario */

	if(isset($_POST['cadastrarFuncionario'])){
		cadastraFuncionario($_POST['nome'],
							 $_POST['cpf'],
							 $_POST['telefone'],
							 $_POST['nivel'],
							 $_POST['usuario'],
							 $_POST['senha'],
							 $_SESSION['restaurante']);
		header('Location: ./gerenciar/funcionarios');
	}

	/* Cadastra Adicional */

		if(isset($_POST['adicional'])){
			if(isset($_SESSION['restaurante']) && isset($_POST['categoria'])){

			if($_POST['categoria'] > 0) {

			$_SESSION['categoria'] = $_POST['categoria'];

				$valor = str_replace(",",".", $_POST['valor']);

			 	cadastraAdicional($_POST['nome'], $valor, $_POST['categoria'], $_POST['status']);

			 		$_SESSION['categoria'] = $_POST['categoria'];
			 		$_SESSION['msg_sucesso'] = "Adicional cadastrado com sucesso";
			 		
			 	header('Location: ./adicionais');
			 	} else{
					$_SESSION['mensagem'] = "Categoria Não Selecionada, por favor, selecione a categoria";
	 				header('Location: ./adicionais');
			 	}
	 		} else{
	 			$_SESSION['mensagem'] = "Por favor, escolha um restaurante para cadastrar o adicional";
	 			header('Location: ./restaurantes');
	 		}
	 	}

	 	/* Cadastra Borda */

		if(isset($_POST['bordas'])){
			if(isset($_SESSION['restaurante']) && isset($_POST['categoria'])){

			if($_POST['categoria'] > 0) {

			$_SESSION['categoria'] = $_POST['categoria'];

				$valor = str_replace(",",".", $_POST['valor']);

			 	cadastraBorda($_POST['nome'], $valor, $_POST['categoria'],$_POST['status']);

			 		$_SESSION['categoria'] = $_POST['categoria'];
			 		$_SESSION['msg_sucesso'] = "Borda recheada cadastrado com sucesso";
			 		
			 	header('Location: ./bordas');
			 	} else{
					$_SESSION['mensagem'] = "Categoria Não Selecionada, por favor, selecione a categoria";
	 				header('Location: ./bordas');
			 	}
	 		} else{
	 			$_SESSION['mensagem'] = "Por favor, escolha um restaurante para cadastrar o adicional";
	 			header('Location: ./restaurantes');
	 		}
	 	}

	 	/* Cadastra Cidade */
	 	
	 	if(isset($_POST['cadastrarCidade'])){
	 		if($_SESSION['id_nivel'] == 5){
	 			cadastraCidade($_POST['cidade'],$_POST['cep']);
	 			header('Location: ./cadastrar-cidade');
	 		} else {
	 			$_SESSION['mensagem'] = "Você não tem permissão para acessar essa pagina!";
	 			header('Location: ./');
	 		}
	 	}
	

} else {
	header('Location: ./');
}