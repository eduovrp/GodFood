<?php
if(!isset($_SESSION))
{
  session_start();
}
if($_POST){
require 'functions/functions.php';
		
	/* Altera Categoria */
	
	if(isset($_POST['nome_categoria'])){
		if(isset($_SESSION['restaurante'])){

			$verifica = verifica_categoria($_POST['id_categoria'],$_SESSION['restaurante']);

				if($verifica != null ){
					if(isset($_POST['2sabores'])){
						$DoisSabor = 'Sim';
					} else {
						$DoisSabor = 'Não';
					}

					altera_categoria($_POST['nome_categoria'],$_POST['id_categoria'],$_SESSION['restaurante'],$DoisSabor);
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
						   $_SESSION['id_produto'],
						   $_POST['status']);
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
						 $valor,
						 $_POST['status']);
		$_SESSION['msg_sucesso'] = "Alterações realizadas com sucesso!";
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

	/* Altera Status do Produto usando o campo de pesquisa de produtos.php */

	if(isset($_POST['alteraStatus'])){
		if($_POST['status'] == 1){
			$status = 'Ativados';
		} else {
			$status = 'Desativados';
		}

		if(strlen($_POST['pesquisaProduto']) > 1){
			alteraStatusVariosProdutos($_POST['pesquisaProduto'], $_POST['status'], $_SESSION['restaurante']);
			$_SESSION['msg_sucesso'] = "Todos os produtos com o termo <strong>".$_POST['pesquisaProduto']."</strong> foram <strong>".$status."</strong>";
			header('Location: produtos.php');
		} else {
			$_SESSION['mensagem'] = "Para ativar/desativar varios produtos você precisa pesquisar pelo nome, categoria ou descrição no campo de pesquisa. Para alterar o status de apenas um produto clique em EDITAR na linha do produto desejado.";
			header('Location: produtos.php');
		}
	}

	/* Altera Status da Borda usando o campo de pesquisa de bordas.php */

	if(isset($_POST['alteraStatusBorda'])){
		if($_POST['status'] == 1){
			$status = 'Ativados';
		} else {
			$status = 'Desativados';
		}
		
		if(strlen($_POST['pesquisaBorda']) > 1){
			alteraStatusVariasBordas($_POST['pesquisaBorda'], $_POST['status'], $_SESSION['restaurante']);
			$_SESSION['msg_sucesso'] = "Todos os itens com o termo <strong>".$_POST['pesquisaBorda']."</strong> foram <strong>".$status."</strong>";
			header('Location: bordas.php');
		} else {
			$_SESSION['mensagem'] = "Para ativar/desativar varios itens você precisa pesquisar pelo nome ou categoria no campo de pesquisa abaixo. Para alterar o status de apenas um item clique em EDITAR na linha do item desejado.";
			header('Location: bordas.php');
		}
	}
	
} else {
	header('Location: index.php');
}
