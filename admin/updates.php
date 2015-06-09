<?php
if(!isset($_SESSION))
{
  session_start();
}
if($_POST){
require 'functions/functions.php';

	if(isset($_POST['nome_categoria'])){
		if(isset($_SESSION['restaurante'])){

			$verifica = verifica_categoria($_POST['id_categoria'],$_SESSION['restaurante']);

				if($verifica != null ){
					altera_categoria($_POST['nome_categoria'],$_POST['id_categoria'],$_SESSION['restaurante']);
					$_SESSION['msg_sucesso'] = "Categoria alterada com sucesso!";
					header('Location: categorias.php');

				} else{
					$_SESSION['erros'] = "Essa categoria não pertence ao seu restaurante, por favor, pare de alterar o input type hidden";
					header('Location: categorias.php');
				}
		} else {
			$_SESSION['erros'] = "Restaurante não selecionado, por favor, selecione o restaurante";
			header('Location: restaurantes.php');
		}
	}

	/* Abre restaurante */

	if(isset($_POST['abrirRestaurante'])){

		$return_url = base64_decode($_SESSION["return_url"]);
        unset($_SESSION['return_url']);

			alteraStatusAberto($_POST['id_restaurante']);
			header('Location: '.$return_url.'');
	}

	/* Fecha restaurante */

	if(isset($_POST['fecharRestaurante'])){

		$return_url = base64_decode($_SESSION["return_url"]);
        unset($_SESSION['return_url']);

			alteraStatusFechado($_POST['id_restaurante']);
			header('Location: '.$return_url.'');
	}

	/* Altera dados do restaurante */

	if(isset($_POST['alterarDadosRestaurante'])){
		$compra_min = str_replace(",",".", $_POST['compra_min']);
		$taxa_servico = str_replace(",",".", $_POST['taxa_servico']);
	if(isset($_POST['taxa_adm'])){
		$taxa_adm = str_replace(",",".", $_POST['taxa_adm']);
	} else {
		$tarifas = buscaTarifasRestauranteAdmin($_SESSION['restaurante']);
		$taxa_adm = $tarifas['taxa_adm'];
	}

	var_dump($taxa_adm);

		if(isset($_POST['fav'])){
			$fav = 1;
		} else {
			$fav = 0;
		}

		alterarDadosRestaurante($_POST['razao'],
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
							$taxa_servico,
							$compra_min,
							$fav,
							$_SESSION['restaurante'],
							$taxa_adm
							);
		$_SESSION['msg_sucesso'] = "Alteração concluida com sucesso!";
		header('Location: gerenciaRestaurantes.php');
	}

	/* Altera dados do funcionario */

	if(isset($_POST['alterarDadosFuncionario'])){
		if(strlen($_POST['senha']) >= 1 && strlen($_POST['senha']) <= 5){
			$_SESSION['erros'] = "A senha precisa ter 6 ou mais caracteres";
		} else {
			alteraSenhaFuncionario($_SESSION['id_funcionario'],$_POST['senha'],$_SESSION['restaurante']);
		}

		alteraDadosFuncionario($_POST['nome'],
							   $_POST['telefone'],
							   $_POST['nivel'],
							   $_SESSION['id_funcionario'],
							   $_SESSION['restaurante']);

		$_SESSION['msg_sucesso'] = "Dados Alterados com Sucesso!";
		unset($_SESSION['id_funcionario']);
		header('Location: gerenciaFuncionarios.php');
	}

	/* Altera dados do Produto */

	if(isset($_POST['alterarDadosProduto'])){
		$valor = str_replace(",",".", $_POST['valor']);

		alteraDadosProduto($_POST['nome'],
						   $_POST['categoria'],
						   $valor,
						   $_POST['descricao'],
						   $_SESSION['id_produto']);
		$_SESSION['msg_sucesso'] = "Produto alterado com sucesso!";
		unset($_SESSION['id_produto']);
		header('Location: produtos.php');
	}
	
	/* Alterar Dados da Borda */

	if(isset($_POST['alterarDadosBorda'])){
		$valor = str_replace(",",".", $_POST['valor']);

		alteraDadosBorda($_SESSION['id_borda'],
						 $_POST['nome'],
						 $_POST['categoria'],
						 $valor);
		$_SESSION['msg_sucesso'] = "Borda recheada alterada com sucesso!";
		unset($_SESSION['id_borda']);
		header('Location: bordas.php');
	}
	
	/* Alterar Dados da Borda */

	if(isset($_POST['alterarDadosAdicional'])){
		$valor = str_replace(",",".", $_POST['valor']);

		alteraDadosAdicional($_SESSION['id_adicional'],
						 $_POST['nome'],
						 $_POST['categoria'],
						 $valor);
		$_SESSION['msg_sucesso'] = "Adicional alterado com sucesso!";
		unset($_SESSION['id_adicional']);
		header('Location: adicionais.php');
	}

} else {
	header('Location: index.php');
}
